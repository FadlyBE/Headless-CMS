<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


#[Layout('components.layouts.app')]
class Create extends Component
{
    use AuthorizesRequests;
    public $name;

    protected $rules = [
        'name' => 'required|min:3',
    ];

    public function store()
    {
        $this->authorize('create_category');
        $this->validate();

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('success', 'Kategori berhasil ditambahkan!');
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.create');
    }
}
