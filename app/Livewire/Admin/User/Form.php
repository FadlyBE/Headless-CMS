<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Form extends Component
{
    public $userId;
    public $name;
    public $email;
    public $role;
    public $roles;
    public $permissions = [];
    public $allRoles = [];
    public $allPermissions = [];
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'nullable|min:6',
        'role' => 'required',
        'permissions' => 'array',
    ];

    protected $listeners = ['createUser' => 'create', 'editUser' => 'edit'];

    public function mount($userId = null)
    {
        $this->allRoles = Role::pluck('name')->toArray();
        $this->allPermissions = Permission::pluck('name')->toArray();

        if ($userId) {
            $user = User::with('roles', 'permissions')->findOrFail($userId);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->roles->pluck('name')->first();
            $this->permissions = $user->permissions->pluck('name')->toArray();
        }
    }

    public function create()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'role', 'permissions']);
        $this->dispatch('open-modal', 'user-form-modal');
    }

    public function render()
    {
        return view('livewire.admin.user.form');
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required',
            'permissions' => 'array',
        ]);

        $user = $this->userId ? User::find($this->userId) : new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        $user->syncRoles([$this->role]);
        $user->syncPermissions($this->permissions);

        $this->dispatch('userSaved'); // untuk nutup modal dari luar

        session()->flash('message', 'User saved successfully.');
    }
}
