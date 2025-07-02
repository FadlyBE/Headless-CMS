<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


#[Layout('layouts.app')]

class Edit extends Component
{
    use WithFileUploads, AuthorizesRequests;

    public $post;
    public $title, $slug, $content, $excerpt, $status, $published_at;
    public $image, $newImage;
    public $selectedCategories = [];


    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->authorize('create_post');

        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->post->id,
            'content' => 'required',
            'newImage' => 'nullable|image|max:2048',
        ]);

        if ($this->newImage) {
            $this->image = $this->newImage->store('images', 'public');
        }

        $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'image' => $this->image,
            'status' => $this->status,
            'published_at' => $this->status === 'published' ? now() : null,
        ]);

        $this->post->categories()->sync($this->selectedCategories);

        session()->flash('success', 'Post updated successfully!');
        $this->resetInput();

        return redirect()->route('admin.posts');
    }

    public function render()
    {
        return view('livewire.admin.post.edit', [
            'categories' => Category::all()
        ]);
    }
}
