<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    /**
     * Getting All Brands.
     * @return JsonResponse | array
     */
    public function index()
    {
        if (\request()->wantsJson()){
            return response()->json(
                Brand::latest()->pluck('name', 'id'), 200
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
            'name' => 'required|max:255|unique:brands'
        ]);

        Brand::create($attributes);

        return response()->json([
            'message' => 'Brand Created Successfully!'
        ], 200);
    }
}
