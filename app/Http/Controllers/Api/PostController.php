<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(
            Post::with('categories')
                ->where('status', 'published')
                ->latest('published_at')
                ->get()
        );
    }

    public function show($slug)
    {
        $post = Post::with('categories')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return new PostResource($post);
    }
}
