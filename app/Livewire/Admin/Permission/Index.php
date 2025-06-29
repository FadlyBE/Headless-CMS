<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public $permissions;

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.admin.permission.index');
    }
}
