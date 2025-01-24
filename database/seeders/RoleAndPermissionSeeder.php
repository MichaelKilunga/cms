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
        Permission::create(['name' => 'manage system']); // Super Admin
        Permission::create(['name' => 'manage church']); // Church Admin
        Permission::create(['name' => 'bishop church']); // Church Bishop
        Permission::create(['name' => 'hof church']); // Church Head of Finance
        Permission::create(['name' => 'manage branch']); // Branch Admin
        Permission::create(['name' => 'pastor branch']); // Branch Pastor
        Permission::create(['name' => 'hof branch']); // Branch Head of Finance
        Permission::create(['name' => 'member']); // Member

        // Define roles and assign permissions
        $superAdmin = Role::create(['name' => 'super admin']);
        $churchAdmin = Role::create(['name' => 'church admin']);
        $churchBishop = Role::create(['name' => 'church bishop']);
        $churchhof = Role::create(['name' => 'church hof']);
        $branchAdmin = Role::create(['name' => 'branch admin']);
        $residentPastor = Role::create(['name' => 'branch pastor']);
        $branchhof = Role::create(['name' => 'branch hof']);
        $member = Role::create(['name' => 'member']);

        $superAdmin->givePermissionTo('manage system');
        $churchAdmin->givePermissionTo('manage church');
        $churchBishop->givePermissionTo('bishop church');
        $churchhof->givePermissionTo('hof church');
        $branchAdmin->givePermissionTo('manage branch');
        $residentPastor->givePermissionTo('pastor branch');
        $branchhof->givePermissionTo('hof branch');
        $member->givePermissionTo('member');
    }
}
