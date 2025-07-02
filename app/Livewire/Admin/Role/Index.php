<?php

namespace App\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination, AuthorizesRequests;

    public $showForm = false;
    public $editMode = false;
    public $roleId;

    protected $listeners = ['roleSaved' => 'hideForm'];

    public function create()
    {
        $this->authorize('create_role');
        $this->reset(['roleId', 'editMode']);
        $this->showForm = true;
    }

    public function edit($id)
    {
       
        $this->authorize('edit_role');
        $this->roleId = $id;
        $this->editMode = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        $this->authorize('delete_role');
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

     // $this->authorize('create_role');

        // $this->authorize('edit_role');
}

