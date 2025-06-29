<?php

namespace App\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $showForm = false;
    public $editMode = false;
    public $roleId;

    protected $listeners = ['roleSaved' => 'hideForm'];

    public function create()
    {
        $this->reset(['roleId', 'editMode']);
        $this->showForm = true;
    }

    public function edit($id)
    {
        $this->roleId = $id;
        $this->editMode = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
    }

    public function hideForm()
    {
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.admin.role.index', [
            'roles' => Role::latest()->paginate(10),
        ]);
    }
}

