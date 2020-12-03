<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia;
use Auth;
use App\Models\Entry;
use App\Models\Product;
use App\Models\ProductEntry;
use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia\Inertia::render('Entries');
    }

    public function fetchEntries()
    {
        $entries = Entry::all();

        return response()->json([
            "entries" => $entries,
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
        $entries = Entry::all();

        if($entries->isEmpty()){
            $entry_id=1;
        }
        else{
            $entry_id = DB::table('entries')->latest('created_at')->first()->entry_id+1;
        }
        return Inertia\Inertia::render('NewEntry', [
            'products' => $products,
            'entry_id' => $entry_id
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
        $entry=new Entry;
        $entry->entry_brand_id=$request->entry_brand_id;
        $entry->entry_user_id=Auth::user()->id;
        $entry->save();

        $product_entry=new ProductEntry;
        $product_entry->insert($request->entries);

        
        foreach($request->entries as $key => $entry){
            $product_stock=ProductStock::where('product_id', $entry['product_id'])
            ->where('color_id', $entry['color_id'])
            ->where('size_id', $entry['size_id'])->get();


            $product_amount= $product_stock[0]->product_amount + $entry['product_entry_amount'];
            
            if($product_stock[0]->product_average_cost == 0){
                $product_average_cost= $product_stock[0]->product_average_cost+ $entry['product_unit_cost'];
            }
            else if($entry['product_unit_cost']!=0){
                $product_average_cost= ($product_stock[0]->product_average_cost + $entry['product_unit_cost'])/2;
            }
            else{
                $product_average_cost=$product_stock[0]->product_average_cost;
            }

            $product_stock_updated=ProductStock::where('product_id', $entry['product_id'])
            ->where('color_id', $entry['color_id'])
            ->where('size_id', $entry['size_id'])
            ->update([
                'product_amount' => $product_amount,
                'product_average_cost' => $product_average_cost
            ]);
        }


        return response()->json([
            "messagge" => "Entrada registrada correctamente. Redireccionando...",
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
        $entry=Entry::find($id);
        return Inertia\Inertia::render('ShowEntry', [
            'entry' => $entry
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
