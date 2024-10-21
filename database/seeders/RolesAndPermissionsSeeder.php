<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Create Permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'view dashboard']);

        // Assign Permissions to Roles
        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(['edit articles', 'view dashboard']);
        $user->givePermissionTo('view dashboard');
    }
}
