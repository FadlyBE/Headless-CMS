<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Post\Index as PostIndex;
use App\Livewire\Admin\Post\Create as PostCreate;
use App\Livewire\Admin\Post\Edit as PostEdit;
use App\Livewire\Admin\Pages\Index as PageIndex;
use App\Livewire\Admin\Pages\Create as PageCreate;
use App\Livewire\Admin\Pages\Edit as PageEdit;
use App\Livewire\Admin\Categories\Index as CategoryIndex;
use App\Livewire\Admin\Categories\Create as CategoryCreate;
use App\Livewire\Admin\Categories\Edit as CategoryEdit;

use App\Http\Controllers\Admin\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Halaman umum
Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


// ✅ Admin routes
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // Posts
    Route::get('/posts', PostIndex::class)->name('posts');
    Route::get('/posts/create', PostCreate::class)->name('posts.create');
    Route::get('/posts/{post}/edit', PostEdit::class)->name('posts.edit');

    // Pages
    Route::get('/pages', PageIndex::class)->name('pages.index');
    Route::get('/pages/create', PageCreate::class)->name('pages.create');
    Route::get('/pages/{page}/edit', PageEdit::class)->name('pages.edit');

    // Categories
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/categories/create', CategoryCreate::class)->name('categories.create');
    Route::get('/categories/{id}/edit', CategoryEdit::class)->name('categories.edit');
});
