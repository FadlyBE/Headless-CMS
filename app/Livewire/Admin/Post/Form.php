<?php

namespace App\Livewire\Admin\Post;

use App\Models\Post;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public Post $post;
    public $categories = [];
    public $selectedCategories = [];
    public $image;

    public $isEdit = false;

    protected function rules()
    {
        return [
            'post.title' => 'required|string|max:255',
            'post.slug' => 'required|string|unique:posts,slug,' . ($this->post->id ?? 'NULL') . ',id',
            'post.content' => 'nullable|string',
            'post.excerpt' => 'nullable|string',
            'post.status' => 'required|in:draft,published',
            'post.published_at' => 'nullable|date',
            'image' => 'nullable|image|max:1024', // 1MB
            'selectedCategories' => 'array'
        ];
    }

    public function mount(Post $post = null)
    {
        $this->categories = Category::all();

        if ($post && $post->exists) {
            $this->post = $post;
            $this->isEdit = true;
            $this->selectedCategories = $post->categories->pluck('id')->toArray();
        } else {
            $this->post = new Post();
        }
    }

    public function updatedPostTitle($value)
    {
        $this->post->slug = \Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $this->post->image = $this->image->store('posts', 'public');
        }

        $this->post->save();

        // Sync categories to pivot table
        $this->post->categories()->sync($this->selectedCategories);

        session()->flash('success', 'Post saved successfully.');
        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.post.form')
        ->layout('layouts.app'); // ganti dari components.layouts.app
    }
}
