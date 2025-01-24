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
            'manage system',
            'manage church',
            'bishop church',    
            'hof church',
            'manage branch',
            'pastor branch',
            'hof branch',
            'member',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign Permissions to Roles
        $roles = [
            'super admin' => ['manage system'],
            'church admin' => ['manage church'],
            'church bishop' => ['bishop church'],
            'church hof' => ['hof church'],
            'branch admin' => ['manage branch'],
            'branch pastor' => ['pastor branch'],
            'branch hof' => ['hof branch'],
            'member' => ['member'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}

