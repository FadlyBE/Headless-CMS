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
use App\Livewire\Admin\Role\Index as RoleIndex;
use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\Admin\Permission\Index as PermissionIndex;
use App\Livewire\Admin\Permission\Form as PermissionForm;
use App\Livewire\Admin\User\Form;
use App\Livewire\Admin\User\Index;
use App\Livewire\Admin\Gallery\Gallery;



Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Halaman umum
// Route::view('/', 'welcome');
Route::redirect('/', '/login');

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

    //roles
    Route::get('/roles', RoleIndex::class)->name('roles.index');

    //permission

    Route::get('/permissions', PermissionIndex::class)->name('permissions.index');
    Route::get('/permissions/create', PermissionForm::class)->name('permissions.create');
    Route::get('/permissions/edit/{id}', PermissionForm::class)->name('permissions.edit');

    Route::get('/users/create', Form::class)->name('users.create');
    Route::get('/users/{id}/edit', Form::class)->name('users.edit');
    Route::get('/users', Index::class)->name('users.index');

    Route::get('/gallery', Gallery::class)->name('gallery');



});

Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'id'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return back();
})->name('locale.switch');

