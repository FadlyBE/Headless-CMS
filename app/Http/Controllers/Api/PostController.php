<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::with('categories')
                ->where('status', 'published')
                ->latest('created_at')
                ->get();
    
            return response()->json([
                'status' => true,
                'message' => 'Posts retrieved successfully.',
                'data' => PostResource::collection($posts),
            ]);
        } catch (\Throwable $e) {
            \Log::error('Failed: ' . $e->getMessage());
    
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve posts.',
                'data' => [],
            ], 500);
        }
    }

    public function show($slug)
    {
        try {
        $post = Post::with('categories')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

         return response()->json([
                'status' => true,
                'message' => 'Posts retrieved successfully.',
                'data' => new PostResource($post),
            ]);

         } catch (\Throwable $e) {
    
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve posts.',
                'data' => [],
            ], 500);
        }
    }
}
