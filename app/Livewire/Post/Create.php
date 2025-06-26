<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads;

    public $title, $slug, $content, $excerpt, $status = 'draft', $published_at;
    public $image;
    public $selectedCategories = [];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
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
        return redirect()->route('admin.posts');
    }

    public function render()
    {
        return view('livewire.post.create', [
            'categories' => Category::all()
        ]);
    }
}
