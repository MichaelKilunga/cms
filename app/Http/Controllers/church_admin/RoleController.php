<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function updateUserRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $role = Role::findByName($validated['role']);
        $user->syncRoles($role);

        return redirect()->back()->with('success', 'User role updated successfully!');
    }
}
