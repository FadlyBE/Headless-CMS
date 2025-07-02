<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

#[Layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads, AuthorizesRequests;
    public $isOpen = false;
    public $content;
    public $postId;
    public $title, $slug, $excerpt, $status = 'draft', $published_at;
    public $image;
    public $selectedCategories = [];


    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function updatedImage()
    {
        // Reset image lama dari DB agar tidak muncul dobel
        if ($this->image instanceof \Livewire\TemporaryUploadedFile) {
            $this->image = $this->image; // ini trigger tetap simpan image baru
        }
    }

    public function store()
    {
        $this->authorize('create_post');

        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->image ? $this->image->store('images', 'public') : null;

        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'image' => $imagePath,
            'status' => $this->status,
            'published_at' => $this->status === 'published' ? now() : null,
        ]);

        $post->categories()->sync($this->selectedCategories);

         session()->flash('success', 'Post created successfully!');
         $this->resetInput();
         $this->isOpen = false;

        $this->emit('resetTrix');

        return redirect()->route('admin.posts');
    }

    public function render()
    {
        return view('livewire.admin.post.create', [
            'categories' => Category::all()
        ]);
    }
}
