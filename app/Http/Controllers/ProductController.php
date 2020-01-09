<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            Product::with(['brand:name,id', 'category:name,id'])
                ->orderByDesc('id')
                ->get(),
            200
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255|unique:products',
            'brand_id' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
        ]);
        Product::create($attributes);

        return response([
            'message' => 'Product Created Successfully!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response($product, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'name' => "required|max:255|unique:products,name,{$product->id}",
            'brand_id' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($attributes);
        return response([
            'message' => 'Product updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response([
            'message' => 'Product Deleted Successfully!',
            'check' => true
        ]);
    }
}
