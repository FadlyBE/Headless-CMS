<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;

    protected $paginationTheme = 'tailwind';

    public function delete($id)
    {
        Page::findOrFail($id)->delete();
        session()->flash('success', 'Page berhasil dihapus.');
    }

    public function render()
    {
        $pages = Page::latest()->paginate($this->perPage);
        return view('livewire.admin.pages.index', compact('pages'));
    }
}
