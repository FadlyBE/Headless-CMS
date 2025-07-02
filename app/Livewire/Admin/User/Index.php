<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Index extends Component
{
    protected $listeners = ['userSaved' => 'closeModal', 'closeModal' => 'closeModal'];

    use WithPagination, AuthorizesRequests;
    public $selectedUserId;
    public $name;
    public $email;
    public $role;
    public $allRoles;
    public $allPermissions = [];
    public $permissions = [];

    public $showModal = false;

    public function mount()
    {
        $this->allRoles = Role::pluck('name', 'id')->toArray();
        $this->allPermissions = Permission::pluck('name')->toArray();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->reset(['selectedUserId', 'name', 'email', 'role', 'permissions']);
        $this->showModal = false;
    }

    public function create()
    {
        $this->authorize('create_user');
        $this->reset(['selectedUserId', 'name', 'email', 'role', 'permissions']);
        $this->openModal();
    }

    public function edit($id)
    {
        $this->authorize('edit_user');
        $user = User::with(['roles', 'permissions'])->findOrFail($id);

        $this->selectedUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('name')->first();
        $this->permissions = $user->permissions->pluck('name')->toArray();

        $this->openModal();
    }


    public function render()
    {
        return view('livewire.admin.user.index', [
            'users' => User::with(['roles', 'permissions'])->paginate(10),
        ]);
    }

    public function delete($id)
    {
        $this->authorize('delete_user');
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function save()
    {
        $this->authorize('create_user');
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->selectedUserId,
            'role' => 'required',
            'permissions' => 'array',
        ];

        $validated = $this->validate($rules);

        $user = $this->selectedUserId ? User::findOrFail($this->selectedUserId) : new User();
        $user->name = $this->name;
        $user->email = $this->email;

       
        if (! $user->exists) {
            $user->password = bcrypt('password');
        }

        $user->save();
        $user->syncRoles([$this->role]);
        $user->syncPermissions($this->permissions);

        $this->dispatch('userSaved');
        session()->flash('success', 'User saved successfully.');
    }
}
