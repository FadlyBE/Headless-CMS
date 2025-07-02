<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination, AuthorizesRequests;

    protected $paginationTheme = 'tailwind';

    public $pageId;
    public $title, $slug, $body, $status = 'draft';
    public $isOpen = false;

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function create()
    {
        $this->authorize('create_page');
        $this->resetInput();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $this->authorize('edit_page');

        $page = Page::findOrFail($id);
        $this->pageId = $page->id;
        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->body = $page->body;
        $this->status = $page->status;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->authorize('create_page');

        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        Page::updateOrCreate(
            ['id' => $this->pageId],
            [
                'title' => $this->title,
                'slug' => $this->slug,
                'body' => $this->body,
                'status' => $this->status,
            ]
        );

        session()->flash('message', $this->pageId ? 'Page updated.' : 'Page created.');
        $this->resetInput();
        $this->isOpen = false;
    }

    public function delete($id)
    {
        $this->authorize('delete_page');

        Page::findOrFail($id)->delete();
        session()->flash('message', 'Page deleted.');
    }

    public function resetInput()
    {
        $this->pageId = null;
        $this->title = '';
        $this->slug = '';
        $this->body = '';
        $this->status = 'draft';
    }

    public function render()
    {
        return view('livewire.admin.pages.index', [
            'pages' => Page::latest()->paginate(10),
        ]);
    }
}
