<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * Get All Brands.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(
            Category::orderByDesc('id')->pluck('name', 'id'), 200
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
            'name' => 'required|max:255|unique:categories'
        ]);

        $category = Category::create($attributes);

        return response()->json([
            'message' => 'Category Created Successfully!',
            'category' => $category
        ], 200);
    }
}
