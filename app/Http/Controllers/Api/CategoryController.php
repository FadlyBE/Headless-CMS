<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;

class CategoryController extends Controller
{
    public function index()
    {
         try {

            $category= CategoryResource::collection(Category::all());
            return response()->json([
                'status' => true,
                'message' => 'Category retrieved successfully.',
                'data' => $category
            ]);

        } catch (\Throwable $e) {
            \Log::error('Failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve category.',
                'data' => [],
            ], 500);
        }
    }

    public function show($id)
    {

        try {
            $category = Category::where('id', $id)->firstOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Category retrieved successfully.',
                'data' => $category
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve category.',
                'data' => [],
            ], 500);
        }
        
    }
}
