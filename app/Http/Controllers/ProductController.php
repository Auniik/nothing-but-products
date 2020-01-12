<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @param Request $request
     * @return Response
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
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return response($product, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
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
            'message' => 'Product updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
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
