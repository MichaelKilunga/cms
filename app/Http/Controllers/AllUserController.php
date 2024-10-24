<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Branch;

class AllUserController extends Controller {
    public function index() {
        $users = User::with( 'roles', 'branch' )->get();
        return view( 'super-admin.users.index', compact( 'users' ) );
    }

    public function create() {
        $roles = Role::all();
        $branches = Branch::all();
        // Get all roles from the database
        return view( 'super-admin.users.create', compact( 'roles',  'branches' ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'branch_id' => 'required|exists:branches,id',
            'roles' => 'array', // Ensure roles is an array
        ] );

        // Create the user
        $user = User::create( [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password ),
        ] );

        
        $user->branch_id = $request->branch_id;
        $user->save();

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
        
        // Validate the branch selection
        $request->validate( [
            'branch_id' => 'required|exists:branches,id',
        ] );
        $user->branch_id = $request->branch_id;
        $user->save();
        $user->syncRoles( $request->roles );
        return redirect()->route( 'users' )->with( 'alert_success', 'User roles updated successfully.' );
    }

    // public function update1( Request $request, $id ) {
    //     $user = User::find( $id );

    //     // Validate the branch selection
    //     $request->validate( [
    //         'branch_id' => 'required|exists:branches,id', // Ensure a valid branch is selected
    //     ] );

    //     // Update the user's branch assignment
    //     $user->branch_id = $request->branch_id;
    //     $user->save();
    
    //     // Optionally update roles or other fields
    //     // $user->syncRoles($request->roles);
    
    //     return redirect()->route('users.index')->with('success', 'User updated successfully.');
    // }
    

    public function edit( $id ) {
        $user = User::find( $id );
        $roles = Role::all();
        $branches = Branch::all();
        return view( 'super-admin.users.edit', compact( 'user', 'roles','branches' ) );
    }

    public function destroy( User $user ) {
        $user->delete();

        return redirect()->route( 'users' )->with( 'alert_success', 'User deleted successfully.' );
    }
}
