<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear Cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            'manage users',
            'manage branches',
            'view reports',
            'file reports',
            'approve reports',
            'send notifications',
            'manage departments',
            'view finances',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign Permissions to Roles
        $roles = [
            'Church Board' => ['manage users', 'view reports', 'approve reports', 'view finances'],
            'Branch Admin' => ['manage users', 'view reports', 'file reports', 'manage departments'],
            'Resident Pastor' => ['view reports', 'approve reports'],
            'Member' => ['file reports', 'view reports'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}

