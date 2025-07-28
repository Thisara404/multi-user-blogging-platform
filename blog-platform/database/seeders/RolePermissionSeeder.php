<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $readerRole = Role::firstOrCreate(['name' => 'reader', 'guard_name' => 'web']);

        // Create permissions
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'manage users',
            'moderate comments',
            'view posts',
            'comment on posts',
            'like posts',
            'save posts',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions($permissions);

        $editorRole->syncPermissions([
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'moderate comments',
            'view posts',
            'comment on posts',
            'like posts',
            'save posts',
        ]);

        $readerRole->syncPermissions([
            'view posts',
            'comment on posts',
            'like posts',
            'save posts',
        ]);
    }
}
