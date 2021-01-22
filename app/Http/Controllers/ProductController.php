<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia;
use Auth;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductColor;
use App\Models\ProductSize;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia\Inertia::render('Products');
    }

    public function fetchProducts()
    {
        $products = Product::all();

        return response()->json([
            "products" => $products,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia\Inertia::render('NewProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product=new Product;
        $product->product_model=$request->product_model;
        $product->product_description=$request->product_description;
        $product->product_category_id=$request->product_category_id;
        $product->product_gender_id=$request->product_gender_id;
        $product->product_brand_id=$request->product_brand_id;
        $product->user_id=Auth::user()->id;
        $product->save();

        
        foreach ($request->product_colors as $key => $color_id) {
            $product->product_colors()->attach($color_id);
        }

        foreach ($request->product_sizes as $key => $size_id) {
            $product->product_sizes()->attach($size_id);
        }

        foreach ($request->product_colors as $key => $color_id) {
            foreach ($request->product_sizes as $key => $size_id) {
                $product_stock=new ProductStock;
                $product_stock->product_id=$product->product_id;
                $product_stock->color_id=$color_id;
                $product_stock->size_id=$size_id;
                $product_stock->save();
            }
        }

        return response()->json([
            "messagge" => "Producto registrado correctamente. Redireccionando...",
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return Inertia\Inertia::render('EditProduct', [
            'product' => $product
        ]);
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
        $product=Product::find($id);
        $product->product_model=$request->product_model;
        $product->product_description=$request->product_description;
        $product->product_category_id=$request->product_category_id;
        $product->product_gender_id=$request->product_gender_id;
        $product->product_brand_id=$request->product_brand_id;
        $product->user_id=Auth::user()->id;
        $product->save();

        $remove_product_colors=ProductColor::where('product_id', $id)->delete();
        $remove_product_sizes=ProductSize::where('product_id', $id)->delete();
        
        foreach ($request->product_colors as $key => $color_id) {
            $product->product_colors()->attach($color_id);
        }

        foreach ($request->product_sizes as $key => $size_id) {
            $product->product_sizes()->attach($size_id);
        }

        foreach ($request->product_colors as $key => $color_id) {
            foreach ($request->product_sizes as $key => $size_id) {
                $search_stock=ProductStock::where('product_id', $id)
                ->where('color_id', $color_id)
                ->where('size_id', $size_id)
                ->get();

                if($search_stock->isEmpty()){
                    $product_stock=new ProductStock;
                    $product_stock->product_id=$product->product_id;
                    $product_stock->color_id=$color_id;
                    $product_stock->size_id=$size_id;
                    $product_stock->save();
                }

            }
        }

        foreach($request->product_colors_to_remove as $key=>$color_to_remove){
            $delete_stock_by_product_color=ProductStock::where('product_id', $id)
            ->where('color_id', $color_to_remove['color_id'])
            ->delete();
        }

        foreach($request->product_sizes_to_remove as $key=>$size_to_remove){
            $delete_stock_by_product_size=ProductStock::where('product_id', $id)
            ->where('size_id', $size_to_remove['size_id'])
            ->delete();
        }

        return response()->json([
            "messagge" => "Producto registrado correctamente. Redireccionando...",
        ], 200);
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
