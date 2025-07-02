<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $postId;
    public $title;
    public $slug;
    public $content;
    public $excerpt;
    public $published_at;
    public $status = 'draft';
    public $post;
    public $categories = [];
    public $allCategories = [];
    public $image, $newImage;
    public $imageUpload;
    public $isOpen = false;
    public $selectedCategories = [];


    public function mount($postId = null)
    {
        $this->categories = Category::all();
        if ($postId) {
            $post = Post::with('categories')->findOrFail($postId);
            $this->post = $post;
            $this->postId = $post->id;
            $this->title = $post->title;
            $this->slug = $post->slug;
            $this->content = $post->content;
            $this->status = $post->status;
            $this->excerpt = $post->excerpt;
            $this->categories = $post->categories->pluck('id')->toArray();
            $this->image = $post->image;
        }
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function updatedImage()
    {
        // Reset image lama dari DB agar tidak muncul dobel
        if ($this->image instanceof \Livewire\TemporaryUploadedFile) {
            $this->image = $this->image; // ini trigger tetap simpan image baru
        }
    }

    public function render()
    {
        return view('livewire.admin.post.index', [
            'posts' => Post::with('categories')->latest()->paginate(10),
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        $this->resetInput(); // Ini sudah bagus
        $this->postId = null;
        $this->image = null;
        $this->isOpen = true;

        $this->dispatch('resetTrix');
    }

    public function cancel()
    {
        $this->resetInput();
        $this->reset(['image', 'postId', 'isOpen']);
        $this->dispatch('resetTrix');
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


        return redirect()->route('admin.posts');
    }

    public function edit($id)
    {

        $this->image = null;
        $this->resetInput();
        $post = Post::findOrFail($id);
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->status = $post->status;
        $this->excerpt = $post->excerpt;
        $this->image = $post->image;
        $this->isOpen = true;

        $this->dispatch('updateTrixContent', content: $post->content);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image && \Storage::disk('public')->exists($post->image)) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        session()->flash('success', 'Post berhasil dihapus.');
    }

    private function resetInput()
    {
        $this->reset([
            'postId',
            'title',
            'slug',
            'excerpt',
            'status',
            'published_at',
            'content',
            'image',
            'selectedCategories',
        ]);
        $this->status = 'draft';
    }
}
