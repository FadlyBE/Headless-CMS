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
        return CategoryResource::collection(Category::all());
    }

    public function posts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return PostResource::collection(
            $category->posts()->where('status', 'published')->get()
        );
    }
}
