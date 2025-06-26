<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class Edit extends Component
{
    use WithFileUploads;

    public $post;
    public $title, $slug, $content, $excerpt, $status, $published_at;
    public $image, $newImage;
    public $selectedCategories = [];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->excerpt = $post->excerpt;
        $this->status = $post->status;
        $this->published_at = $post->published_at;
        $this->image = $post->image;
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
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
        return redirect()->route('admin.posts');
    }

    public function render()
    {
        return view('livewire.post.edit', [
            'categories' => Category::all()
        ]);
    }
}
