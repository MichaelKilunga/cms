<?php

namespace App\Http\Controllers;
// use Laravel\Jetstream\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
    public function index() {
        $users = User::with( 'roles' )->get();
        return view( 'admin.users.index', compact( 'users' ) );
    }
    

    public function update( Request $request, User $user ) {
        $user->syncRoles( $request->roles );
        return redirect()->route( 'users' )->with( 'success', 'User roles updated successfully.' );
    }

    public function edit( $id ) {
        $user = User::find( $id );
        $roles = Role::all();
        return view( 'admin.users.edit', compact( 'user','roles' ) );
    }
}
