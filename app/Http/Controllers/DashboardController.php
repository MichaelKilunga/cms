<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Church;
use App\Models\Branch;
use App\Models\Member;
use App\Models\Service;
use App\Models\Finance;
use App\Models\ServiceCategory;


class DashboardController extends Controller
{
    function index()
    {
        if (auth::user()->can('manage system')) {
            if (!Auth::user()->can('manage system')) {
                abort(403, 'You do not have the required permissions.');
            }
            $totalChurches = Church::count();
            $totalBranches = Branch::count();
            $totalMembers = Member::count();
            $totalServices = Service::count();
            $totalFinances = Finance::count();
            $totalServiceCategories = ServiceCategory::count();

            $recentChurches = Church::latest()->take(5)->get()->pluck('name')->join(', ');
            $recentBranches = Branch::latest()->take(5)->get()->pluck('name')->join(', ');
            $recentMembers = Member::latest()->take(5)->get()->pluck('id')->join(', ');

            return view('super_admin.dashboard', compact(
                'totalChurches',
                'totalBranches',
                'totalMembers',
                'totalServices',
                'totalFinances',
                'totalServiceCategories',
                'recentChurches',
                'recentBranches',
                'recentMembers'
            ));
        }
        if (auth::user()->can('manage church')) {

            $church = Church::where('administrator_id', Auth::user()->id)->first();
            if (!$church->id) {
                return view('church_admin.dashboard')->with('guest_church_admin', true);
            } else {
                // dd($church->id);
                session(['church_id' => $church->id]);
                session(['guest_church_admin' => '']);
                // session()->destroy('guest_church_admin');
                if (!Auth::user()->can('manage church')) {
                    abort(403, 'You do not have the required permissions.');
                }
                // $totalChurches = Church::count();
                $totalBranches = Branch::where('church_id',$church->id)->count();
                $totalMembers = Member::where('church_id',$church->id)->count();
                $totalServices = Service::where('church_id',$church->id)->count();
                $totalFinances = Finance::where('church_id',$church->id)->count();
                $totalServiceCategories = ServiceCategory::where('church_id',$church->id)->count();
    
                // $recentChurches = Church::latest()->take(5)->get()->pluck('name')->join(', ');
                $recentBranches = Branch::where('church_id',$church->id)->latest()->take(5)->get()->pluck('name')->join(', ');
                $recentMembers = Member::where('church_id',$church->id)->latest()->take(5)->get()->pluck('id')->join(', ');
    
                return view('church_admin.dashboard', compact(
                    'totalBranches',
                    'totalMembers',
                    'totalServices',
                    'totalFinances',
                    'totalServiceCategories',
                    'recentBranches',
                    'recentMembers'
                ));
            }
        }
    }
}
