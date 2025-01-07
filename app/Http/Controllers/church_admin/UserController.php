<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
// use Laravel\Jetstream\Rules\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }
    
    public function show(User $user){
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'permissions' => 'nullable|array',
        ]);

        $user = User::create(['name' => $request->name]);
        $user->syncPermissions($request->permissions);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('id')->toArray();

        return view('users.edit', compact('user', 'permissions', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|unique:users,name,' . $user->id,
            'permissions' => 'nullable|array',
        ]);

        $user->update(['name' => $request->name]);
        $user->syncPermissions($request->permissions);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
