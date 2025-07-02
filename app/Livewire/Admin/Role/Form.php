<?php

namespace App\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    public $name;
    public $roleId;
    public $editMode = false;
    public $permission_ids = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'permission_ids' => 'array',
    ];

    public function mount($roleId = null, $editMode = false)
    {
        $this->roleId = $roleId;
        $this->editMode = $editMode;

        if ($editMode && $roleId) {
            $role = Role::findOrFail($roleId);
            $this->name = $role->name;
            $this->permission_ids = $role->permissions()->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $this->authorize('create_role');

        $this->validate();

        $role = Role::updateOrCreate(
            ['id' => $this->roleId],
            ['name' => $this->name]
        );
        $permissionNames = Permission::whereIn('id', $this->permission_ids)->pluck('name')->toArray();
        // $role->syncPermissions($this->permission_ids);
        $role->syncPermissions($permissionNames);

        $this->dispatch('roleSaved');
        session()->flash('message', 'Role berhasil disimpan.');
        return redirect()->route('admin.roles.index');
    }

    public function render()
    {
        return view('livewire.admin.role.form', [
            'permissions' => Permission::all()
        ]);
    }
}
