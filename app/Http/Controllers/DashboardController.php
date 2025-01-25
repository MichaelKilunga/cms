<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        if (Gate::allows('manage system')) {
            if (!Gate::allows('manage system')) {
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
        if (Gate::allows('manage church')) {

            $totalBranches = 0;
            $totalMembers = 0;
            $totalServices = 0;
            $totalFinances = 0;
            $totalServiceCategories = 0;

            $church = Church::where('administrator_id', Auth::user()->id);

            if ($church->count() == 0) {
                $branches = Branch::where('church_id', 100000)->get();
                session(['guest_church_admin' => 'true']);
                return view('church_admin.dashboard', compact(
                    'totalBranches',
                    'totalMembers',
                    'totalServices',
                    'totalFinances',
                    'totalServiceCategories',
                    'branches',
                ))->with('info', 'Create a church to continue!');
            } else {
                $branches = Branch::where('church_id', $church->first()->id)->get();

                session(['church_id' => $church->first()->id]);
                session(['guest_church_admin' => '']);

                if (!Gate::allows('manage church')) {
                    abort(403, 'You do not have the required permissions.');
                }

                $totalBranches = Branch::where('church_id', $church->first()->id)->count();
                $totalMembers = Member::where('church_id', $church->first()->id)->count();
                $totalServices = Service::where('church_id', $church->first()->id)->count();
                $totalFinances = Finance::where('church_id', $church->first()->id)->count();
                $totalServiceCategories = ServiceCategory::where('church_id', $church->first()->id)->count();

                return view('church_admin.dashboard', compact(
                    'totalBranches',
                    'totalMembers',
                    'totalServices',
                    'totalFinances',
                    'totalServiceCategories',
                ));
            }
        }
        if (Gate::allows('manage branch')) {

            // $totalBranches = 0;
            $totalMembers = 0;
            $totalServices = 0;
            $totalFinances = 0;
            // $totalServiceCategories = 0;

            $currentMember = Member::where('user_id', Auth::user()->id)->first();
            $church = Church::where('id', $currentMember->church_id);
            $branch = Branch::where('id', $currentMember->branch_id);

            dd($church->first());

            session(['church_id' => $church->first()->id]);
            session(['guest_church_admin' => '']);

            if (!Gate::allows('manage branch')) {
                abort(403, 'You do not have the required permissions.');
            }

            $totalMembers = Member::where('church_id', $church->first()->id)->where('branch_id',  $currentMember->branch_id)->count();
            $totalServices = Service::where('church_id', $church->first()->id)->where('branch_id',  $currentMember->branch_id)->count();
            $totalFinances = Finance::where('church_id', $church->first()->id)->where('branch_id',  $currentMember->branch_id)->count();

            return view('branch_admin.dashboard', compact(
                'totalMembers',
                'totalServices',
                'totalFinances',
            ));
        }
    }
}
