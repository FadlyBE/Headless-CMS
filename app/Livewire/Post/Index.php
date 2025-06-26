<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::with('categories')->latest()->paginate(10)
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
}
