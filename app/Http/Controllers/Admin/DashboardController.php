<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DashboardController extends Controller
{
    public function index()
    {
        $postCount = Post::count();
        $pageCount = Page::count();
        $categoryCount = Category::count();

        return view('dashboard', compact('postCount', 'pageCount', 'categoryCount'));
    }
}
