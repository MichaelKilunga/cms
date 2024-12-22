<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class DashboardController extends Controller
{
    function index(){
        // if(Auth::user()->HasRoles('church board')){

        // }
        
        // if(Auth::user()->HasRoles('branch')){
    
        // }
        
        // if(Auth::user()->HasRoles('resident pastor')){
    
        // }
        
        // if(Auth::user()->HasRoles('member')){
    
        // }
        return view('dashboard');
    }    
}
