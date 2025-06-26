<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Create extends Component
{
    public $title;
    public $slug;
    public $body;
    public $status = 'draft';

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:pages,slug',
        'body' => 'required',
        'status' => 'required|in:draft,published',
    ];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        $this->validate();

        Page::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Page berhasil dibuat.');
        return redirect()->route('admin.pages.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.create');
    }
}

