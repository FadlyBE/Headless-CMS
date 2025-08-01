<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


#[Layout('components.layouts.app')]
class Edit extends Component
{
    use AuthorizesRequests;
    public $categoryId;
    public $name;

    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
    }

    protected $rules = [
        'name' => 'required|min:3',
    ];

    public function update()
    {
        $this->authorize('update_category');

        $this->validate();

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('success', 'Data updated');
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.edit');
    }
}
