<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Form extends Component
{
    public $name;
    public $permissionId;
    public $editMode = false;

    public function mount($id = null)
    {
        if ($id) {
            $permission = Permission::findOrFail($id);
            $this->permissionId = $permission->id;
            $this->name = $permission->name;
            $this->editMode = true;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:permissions,name,' . $this->permissionId,
        ]);

        Permission::updateOrCreate(
            ['id' => $this->permissionId],
            ['name' => $this->name]
        );

        session()->flash('success', $this->editMode ? 'Permission updated!' : 'Permission created!');
        return redirect()->route('admin.permissions.index');
    }

    public function render()
    {
        return view('livewire.admin.permission.form');
    }
}

