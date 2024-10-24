<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Branch $branch)
    {
        $users = $branch->users()->with('roles')->get(); // Load users with their roles
        return view('branches.users.index', compact('branch', 'users'));
    }

    public function create(Branch $branch)
    {
        $roles = Role::all(); // Fetch all roles
        return view('branches.users.create', compact('branch', 'roles'));
    }

    public function store(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array', // Ensure roles is an array
        ]);

        // Create the user and associate with branch
        $user = $branch->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign roles to the user
        if ($request->has('roles')) {
            $roleIds = Role::whereIn('name', $request->roles)->pluck('id');
            $user->roles()->sync($roleIds);
        }

        return redirect()->route('branches.users.index', $branch)->with('alert_success', 'User created successfully.');
    }

    public function edit(Branch $branch, User $user)
    {
        $roles = Role::all(); // Fetch all roles
        return view('branches.users.edit', compact('branch', 'user', 'roles'));
    }

    public function update(Request $request, Branch $branch, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array', // Ensure roles is an array
        ]);

        // Update the user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        // Sync roles
        if ($request->has('roles')) {
            $roleIds = Role::whereIn('name', $request->roles)->pluck('id');
            $user->roles()->sync($roleIds);
        }

        return redirect()->route('branches.users.index', $branch)->with('alert_success', 'User updated successfully.');
    }

    public function destroy(Branch $branch, User $user)
    {
        $user->delete();
        return redirect()->route('branches.users.index', $branch)->with('alert_success', 'User deleted successfully.');
    }
}
