<?php

namespace App\Http\Controllers\branch_pastor;

use App\Models\Finance;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Church;
use App\Models\Member;
use Livewire\Attributes\Validate;

class BranchPastorReportController extends Controller
{

    public function index()
    {

        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();
        $serviceCategories = ServiceCategory::where('church_id', $currentChurch->id)->get();
        return view('branch_pastor.reports.index', compact('serviceCategories'));
    }

    public function filter(Request $request)
    {


        try {
            $request->validate([
                'start' => 'required|date',
                'end' => 'required|date',
                'category' => 'required|in:inflow,services,members,tithes,expenditures',
                'serviceCategory' => 'required|integer',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        $averageAttendance = 0;
        $totalInflow = 0;
        $totalExpenditures = 0;
        $totalBalance = 0;
        $finances = [];
        $services = [];
        $members = [];
        $tithes = [];
        $expenditures = [];
        $totalBalance = [];
        $rows = 0;

        // Contextualizing
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        // $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();
        // $serviceCategories = ServiceCategory::where('church_id', $currentChurch->id)->get();

        // Filtering
        try {
            /* SERVICES
        Get all services within the given range, for a particular branch
        */
            $services = Service::where('branch_id', $currentBranch->id)
                ->whereBetween('date', [$request->start, $request->end])
                    ->with('service_category')
                    ->get();

            /* FINANCES
        Get all finances within the given range, for a particular branch
        */
            $finances = Finance::where('branch_id', $currentBranch->id)
                ->whereBetween('date', [$request->start, $request->end])
                    ->with('service')
                    ->get();

            /* MEMBERS
        Get all members for a particular branch
        */
            $members = Member::where('branch_id', $currentBranch->id)
                ->get();

            /* TITHES
        Get all tithes within the given range, for a particular branch
        */
            $tithes = Finance::where('branch_id', $currentBranch->id)
                ->where('type', 'tithe')
                ->whereBetween('date', [$request->start, $request->end])
                    ->with('service')
                    ->get();

            /* calculate the average attendance for the sum of 
        'women',
        'men', and
        'children' devided over the number of services within the given range
        */
            if ($services->count() > 0) {
                $averageAttendance = $services->sum(function ($service) {
                    return $service->women + $service->men + $service->children;
                }) / $services->count();
            }

            /* calculate the total inflow as the sum of 'worship_offering', 'tithe_offering', 'thanksgiving_offering',
        'project_offering', 'special_offering', 'firstfruits_offering', 'children_offering',
        'cds_dvd_tapes', and 'books_and_stickers' from all finances within the given range, for a particular branch
        */

            $totalInflow = $finances->sum(function ($finance) {
                return $finance->worship_offering + $finance->tithe_offering + $finance->thanksgiving_offering + $finance->project_offering + $finance->special_offering + $finance->firstfruits_offering + $finance->children_offering + $finance->cds_dvd_tapes + $finance->books_and_stickers;
            });

            /* calculate the total totalBalance as a totalInflow by now
        */
            $totalBalance = $totalInflow;

            /* SERVICE CATEGORIES
            check the service category, if is not equal to "0", then update all the data above with considering the service category
            */
            $serviceCategoryId = $request['serviceCategory'];
            if ($serviceCategoryId != 0) {

                $services = Service::where('branch_id', $currentBranch->id)
                    ->whereBetween('date', [$request->start, $request->end])
                    ->where('service_category_id', $serviceCategoryId)
                    ->with('service_category')
                    ->get();

                $finances = Finance::where('branch_id', $currentBranch->id)
                    ->whereBetween('date', [$request->start, $request->end])
                    ->whereHas('service', function ($query) use ($serviceCategoryId) {
                        $query->where('service_category_id', $serviceCategoryId);
                    })
                    ->with('service')
                    ->get();

                $tithes = Finance::where('branch_id', $currentBranch->id)
                ->where('type', 'tithe')
                ->whereBetween('date', [$request->start, $request->end])
                ->whereHas('service', function ($query) use ($serviceCategoryId) {
                        $query->where('service_category_id', $serviceCategoryId);
                    })
                    ->with('service')
                    ->get();

                /* calculate the average attendance for the sum of
                'women',
                'men', and
                'children' devided over the number of services within the given range
                */

                if ($services->count() > 0) {
                    $averageAttendance = $services->sum(function ($service) {
                        return $service->women + $service->men + $service->children;
                    }) / $services->count();
                }
                /* calculate the total inflow as the sum of 'worship_offering', 'tithe_offering', 'thanksgiving_offering',
                'project_offering', 'special_offering', 'firstfruits_offering', 'children_offering',
                'cds_dvd_tapes', and 'books_and_stickers' from all finances within the given range, for a particular branch
                */

                $totalInflow = $finances->sum(function ($finance) {
                    return $finance->worship_offering + $finance->tithe_offering + $finance->thanksgiving_offering + $finance->project_offering + $finance->special_offering + $finance->firstfruits_offering + $finance->children_offering + $finance->cds_dvd_tapes + $finance->books_and_stickers;
                });

                /* calculate the total totalBalance as a totalInflow by now
                */
                $totalBalance = $totalInflow;
            }

            /* set number of rows in "rows" variable based on the category
            */
            if ($request->category == 'tithe') {
                $rows = $tithes->count();
            }
            if ($request->category == 'inflow') {
                $rows = $finances->count();
            }
            if ($request->category == 'service') {
                $rows = $services->count();
            }            
            if ($request->category == 'members') {
                $rows = $members->count();
            }            

            return response()->json([
                'success' => true,
                'start' => $request->start,
                'end' => $request->end,
                'category' => $request->category,
                'serviceCategory' => $request->serviceCategory,
                'averageAttendance' => $averageAttendance,
                'totalInflow' => $totalInflow,
                'totalExpenditures' => $totalExpenditures,
                'totalBalance' => $totalBalance,
                'inflow' => $finances,
                'services' => $services,
                'members' => $members,
                'tithes' => $tithes,
                'totalBalance' => $totalBalance,
                'expenditures' => $expenditures,
                'rows' => $rows
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
