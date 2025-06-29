<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


#[Layout('layouts.app')]

class Index extends Component
{
    use WithFileUploads, WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'tailwind';
    public $image;
    public $image_upload;
    public $title, $slug, $content, $excerpt, $status = 'draft', $published_at;
    public $postId;
    public bool $isOpen = false;

    // Field untuk form create
    public array $selectedCategories = [];

    public function mount()
    {
        $this->categories = Category::all();
    }


    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function create()
    {
        $this->authorize('create_post');
        $this->resetInput();
        $this->openModal();
    }

    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }

    public function resetInput()
    {
        $this->title = $this->slug = $this->content = $this->excerpt = '';
        $this->status = 'draft';
        $this->published_at = null;
        $this->postId = null;
    }
    

    public function store()
    {
        $this->authorize($this->postId ? 'edit_post' : 'create_post');
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);
    
        $imagePath = $this->image_upload
            ? $this->image_upload->store('images', 'public')
            : $this->image;
    
        $post=Post::updateOrCreate(
            ['id' => $this->postId],
            [
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'content' => $this->content,
                'excerpt' => $this->excerpt,
                'status' => $this->status,
                'published_at' => $this->published_at,
                'image' => $imagePath,
            ]
        );
    
        $post->categories()->sync($this->selectedCategories);
        session()->flash('message', $this->postId ? 'Post updated successfully' : 'Post created successfully');
    
        $this->resetInput();
        $this->closeModal();
    }
    

    public function edit($id)
    {
        $this->authorize('edit_post');
        $post = Post::findOrFail($id);
        $this->selectedCategories = $post->categories->pluck('id')->map(fn($id) => (string) $id)->toArray();
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->excerpt = $post->excerpt;
        $this->status = $post->status;
        $this->published_at = $post->published_at;
        $this->image = $post->image;
    
        $this->isOpen = true;
    }
    

    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::with('categories')->latest()->paginate(5),
            'categories' => Category::all(),
        ]);
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

    
    // public function save()
    // {
    //     $this->validate([
    //         'title' => 'required',
    //         'slug' => 'required|unique:posts,slug',
    //         'content' => 'required',
    //         'image' => 'nullable|image|max:2048',
    //     ]);

    //     $imagePath = $this->image ? $this->image->store('images', 'public') : null;

    //     $post = Post::create([
    //         'title' => $this->title,
    //         'slug' => $this->slug,
    //         'content' => $this->content,
    //         'excerpt' => $this->excerpt,
    //         'image' => $imagePath,
    //         'status' => $this->status,
    //         'published_at' => $this->status === 'published' ? now() : null,
    //     ]);

    //     $post->categories()->sync($this->selectedCategories);

    //     session()->flash('success', 'Post created successfully!');
    //     $this->showCreateModal = false;
    // }
}
