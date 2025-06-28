<?php

// database/seeders/RbacSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RbacSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = [
            'admin',
            'editor',
            'viewer',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create permissions
        $permissions = [
            'create_user',
            'delete_user',
            'view_logs',
            'edit_article',
            'publish_article',
            'view_article',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign permissions to roles
        Role::where('name', 'admin')->first()?->permissions()->sync(
            Permission::whereIn('name', ['create_user', 'delete_user', 'view_logs'])->pluck('id')
        );

        Role::where('name', 'editor')->first()?->permissions()->sync(
            Permission::whereIn('name', ['edit_article', 'publish_article'])->pluck('id')
        );

        Role::where('name', 'viewer')->first()?->permissions()->sync(
            Permission::whereIn('name', ['view_article'])->pluck('id')
        );

        // Assign role ke user
        $user = User::first();
        if ($user) {
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole) {
                $user->roles()->syncWithoutDetaching([$adminRole->id]);
            }
        }
    }
}

