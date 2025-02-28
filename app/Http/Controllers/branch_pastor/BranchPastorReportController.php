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
        $inflow = [];
        $services = [];
        $members = [];
        $tithes = [];
        $expenditures = [];
        $balance = [];
        $rows = 0;

        // Contextualizing
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();
        $serviceCategories = ServiceCategory::where('church_id', $currentChurch->id)->get();

        // Filtering
        $services = Service::where('service_category_id', $request->serviceCategory)
            ->whereBetween('date', [$request->start, $request->end])
            ->get();

        $finance = Finance::where('church_id', $currentChurch->id)
            ->whereBetween('date', [$request->start, $request->end])
            ->get();

        $rows = $finance->count();


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
            'inflow' => $inflow,
            'services' => $services,
            'members' => $members,
            'tithes' => $tithes,
            'balance' => $balance,
            'expenditures' => $expenditures,
            'rows' => $rows
        ]);
    }
}
