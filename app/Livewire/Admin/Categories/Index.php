<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Index extends Component
{
    use WithPagination;

    public $name;
    public $categoryId = null;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|min:3',
    ];

    public function save()
    {
        $this->validate();

        if ($this->isEditing && $this->categoryId) {
            $category = Category::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
            session()->flash('success', 'Category added successfully.');
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
            session()->flash('success', 'Category added successfully.');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->isEditing = true;
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('success', 'Category deleted successfully.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->categoryId = null;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.admin.categories.index', [
            'categories' => Category::latest()->paginate(10)
        ]);
    }
}
