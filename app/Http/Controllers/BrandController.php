<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    /**
     * Getting All Brands.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(
            Brand::orderByDesc('id')->pluck('name', 'id'), 200
        );
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255|unique:brands'
        ]);

        Brand::create($attributes);

        return response()->json([
            'message' => 'Brand Created Successfully!'
        ], 200);
    }
}
