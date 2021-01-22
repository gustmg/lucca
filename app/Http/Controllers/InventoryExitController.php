<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia;
use Auth;
use App\Models\InventoryExit;
use App\Models\Product;
use App\Models\ProductExit;
use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;

class InventoryExitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia\Inertia::render('Exits');
    }

    public function fetchExits()
    {
        $exits = InventoryExit::all();

        return response()->json([
            "inventory_exits" => $exits,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $exits = InventoryExit::all();

        if($exits->isEmpty()){
            $exit_id=1;
        }
        else{
            $exit_id = DB::table('exits')->latest('created_at')->first()->exit_id+1;
        }
        return Inertia\Inertia::render('NewExit', [
            'products' => $products,
            'exit_id' => $exit_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exit=new InventoryExit;
        $exit->exit_brand_id=$request->exit_brand_id;
        $exit->exit_user_id=Auth::user()->id;
        $exit->save();

        $product_exit=new ProductExit;
        $product_exit->insert($request->exits);

        
        foreach($request->exits as $key => $exit){
            $product_stock=ProductStock::where('product_id', $exit['product_id'])
            ->where('color_id', $exit['color_id'])
            ->where('size_id', $exit['size_id'])->get();


            $product_amount= $product_stock[0]->product_amount - $exit['product_exit_amount'];
            

            $product_stock_updated=ProductStock::where('product_id', $exit['product_id'])
            ->where('color_id', $exit['color_id'])
            ->where('size_id', $exit['size_id'])
            ->update([
                'product_amount' => $product_amount
            ]);
        }

        return response()->json([
            "messagge" => "Salida registrada correctamente. Redireccionando...",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exit=InventoryExit::find($id);
        return Inertia\Inertia::render('ShowExit', [
            'exit' => $exit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
