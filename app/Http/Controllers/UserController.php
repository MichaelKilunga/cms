<?php

namespace App\Http\Controllers;
// use Laravel\Jetstream\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index() {
        $users = User::with( 'roles' )->get();
        return view( 'admin.users.index', compact( 'users' ) );
    }

    public function create() {
        $roles = Role::all();
        // Get all roles from the database
        return view( 'admin.users.create', compact( 'roles' ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array', // Ensure roles is an array
        ] );

        // Create the user
        $user = User::create( [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password ),
        ] );

        // Assign roles to the user if any are selected
        if ( $request->has( 'roles' ) ) {
            // Fetch role IDs based on selected role names
            $roleIds = Role::whereIn( 'name', $request->roles )->pluck( 'id' );

            // Sync roles with user
            $user->roles()->sync( $roleIds );
        }

        return redirect()->route( 'users' )->with( 'alert_success', 'User created successfully.' );
    }

    public function update( Request $request, User $user ) {
        $user->syncRoles( $request->roles );
        return redirect()->route( 'users' )->with( 'alert_success', 'User roles updated successfully.' );
    }

    public function edit( $id ) {
        $user = User::find( $id );
        $roles = Role::all();
        return view( 'admin.users.edit', compact( 'user', 'roles' ) );
    }

    public function destroy( User $user ) {
        $user->delete();

        return redirect()->route( 'users' )->with( 'alert_success', 'User deleted successfully.' );
    }
}
