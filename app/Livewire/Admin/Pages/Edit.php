<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Edit extends Component
{
    public $page;
    public $title;
    public $slug;
    public $body;
    public $status;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:pages,slug',
        'body' => 'required',
        'status' => 'required|in:draft,published',
    ];

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->body = $page->body;
        $this->status = $page->status;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'nullable|unique:pages,slug,' . $this->page->id,
            'body' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        $this->page->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Data updated.');
        return redirect()->route('admin.pages.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.edit');
    }
}
