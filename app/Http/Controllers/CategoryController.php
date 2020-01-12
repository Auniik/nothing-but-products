<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Get All Brands.
     * @return JsonResponse | array
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()){
            return response()->json(
                Category::latest()->pluck('name', 'id'), 200
            );
        }
        return [];
    }


    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
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
