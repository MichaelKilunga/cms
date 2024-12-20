<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'file reports']);
        Permission::create(['name' => 'approve reports']);

        // Define roles and assign permissions
        $churchBoard = Role::create(['name' => 'Church Board']);
        $branchAdmin = Role::create(['name' => 'Branch Admin']);
        $residentPastor = Role::create(['name' => 'Resident Pastor']);
        $member = Role::create(['name' => 'Member']);

        $churchBoard->givePermissionTo(['manage users', 'view reports', 'approve reports']);
        $branchAdmin->givePermissionTo(['manage users', 'view reports']);
        $residentPastor->givePermissionTo(['view reports', 'approve reports']);
        $member->givePermissionTo(['file reports']);
    }
}
