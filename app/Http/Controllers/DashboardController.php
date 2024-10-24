<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        
         $user = Auth::user();

         if ( $user->hasRole( 'super-admin' ) ) {
             return redirect()->route( 'super' );
         }
         if ( $user->hasRole( 'admin' ) ) {
             return redirect()->route( 'admin' );
         }
        //  if ( $user->hasRole( 'pastor' ) ) {
        //      return redirect()->route( 'pastor' );
        //  }
        //  if ( $user->hasRole( 'hof' ) ) {
        //      return redirect()->route( 'hof' );
        //  }
    }
}
