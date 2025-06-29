<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Index extends Component
{
    protected $listeners = ['userSaved' => 'closeModal', 'closeModal' => 'closeModal'];

    use WithPagination;
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
        $this->reset(['selectedUserId', 'name', 'email', 'role', 'permissions']);
        $this->openModal();
    }

    public function edit($id)
    {
        $user = User::with(['roles', 'permissions'])->findOrFail($id);

        $this->selectedUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('name')->first(); // Ambil satu role
        $this->permissions = $user->permissions->pluck('name')->toArray(); // Ambil array nama permission

        $this->openModal();
    }


    public function render()
    {
        return view('livewire.admin.user.index', [
            'users' => User::with(['roles', 'permissions'])->paginate(10),
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function save()
    {
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

        // Set default password saat create
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
