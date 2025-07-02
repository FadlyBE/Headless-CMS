<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;

class PageController extends Controller
{
    public function index()
    {

        try {
            $pages = Page::where('status', 'published')->get();

            return response()->json([
                'status' => true,
                'message' => 'Pages retrieved successfully.',
                'data' => PageResource::collection($pages),
            ]);
        } catch (\Throwable $e) {
            \Log::error('Failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve pages.',
                'data' => [],
            ], 500);
        }
    }

    public function show($slug)
    {
        try {
            $page = Page::where('slug', $slug)
                ->where('status', 'published')
                ->firstOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Pages retrieved successfully.',
                'data' => new PageResource($page)
            ]);

        } catch (\Throwable $e) {
            
            \Log::error('Failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve pages.',
                'data' => [],
            ], 500);
        }
    }
}
