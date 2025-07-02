<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // default password
            ]
        );

        // Hapus cache permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar permission
        $permissions = [
            'create_user', 'delete_user', 'view_logs',
            'edit_article', 'publish_article', 'view_article',
            'create_post', 'edit_post', 'delete_post',
            'edit_user', 'create_category', 'edit_category',
            'delete_category', 'create_role', 'edit_role',
        ];

        // Buat permission
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role dan beri permission
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions(Permission::all());

        $editor = Role::firstOrCreate(['name' => 'Editor']);
        $editor->givePermissionTo(['edit_article', 'publish_article']);

        $viewer = Role::firstOrCreate(['name' => 'Viewer']);
        $viewer->givePermissionTo(['view_article']);

        $user->assignRole($admin);
    }
}
