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
use App\Models\Expenses;
use App\Models\Member;
use Livewire\Attributes\Validate;

class BranchPastorExpensesController extends Controller
{
    /**
     * Display a listing of the expenses.
     */
    public function index()
    {
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();

        $services = Service::where('church_id', $currentChurch->id)->where('branch_id', $currentBranch->id)->with(['user', 'branch', 'church', 'service_category'])->get();
        $expenses = Expenses::where('church_id', $currentChurch->id)->where('branch_id', $currentBranch->id)->with('service')->get();
        // dd($expenses    );
        return view('branch_pastor.expenses.index', compact('expenses', 'services'));
    }

    public function show(Finance $expense)
    {
        // $expense = Finance::with('service_category')->where('id',$expense->id)->get();

        // dd($expense->service_category->name);
        return view('branch_pastor.expenses.show', compact('expense'));
    }

    /**
     * Show the form for creating a new expense record.
     */
    public function create()
    {
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();

        $services = Service::where('church_id', $currentChurch->id)->where('branch_id', $currentBranch->id)->with(['user', 'branch', 'church', 'service_category'])->get();
        // $serviceCategories = ServiceCategory::all();
        return view('branch_pastor.expenses.create', compact('services', 'currentChurch', 'currentBranch'));
    }

    /**
     * Store a newly created expense record in storage.
     */
    public function store(Request $request)
    {
        $validatedData = null;
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'service_id' => 'required|exists:services,id|unique:expenses,service_id',
                'date' => 'required|date',
                'worship_offering' => 'nullable|numeric|min:0',
                'tithe_offering' => 'nullable|numeric|min:0',
                'thanksgiving_offering' => 'nullable|numeric|min:0',
                'project_offering' => 'nullable|numeric|min:0',
                'special_offering' => 'nullable|numeric|min:0',
                'firstfruits_offering' => 'nullable|numeric|min:0',
                'children_offering' => 'nullable|numeric|min:0',
                'cds_dvd_tapes' => 'nullable|numeric|min:0',
                'books_and_stickers' => 'nullable|numeric|min:0',
                'user_id' => 'required|exists:users,id',
                'church_id' => 'required|exists:churches,id',
                'branch_id' => 'required|exists:branches,id',
            ]);

            // dd($validatedData);

            Finance::create($validatedData);

            return redirect()->route('branch_pastor.expenses')->with('success', 'Finance report created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            // Redirect back with error messages
            return redirect()->back()->withErrors($validatedData)->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified expense record.
     */
    public function edit(Finance $expense)
    {
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();

        $services = Service::where('church_id', $currentChurch->id)->where('branch_id', $currentBranch->id)->with(['user', 'branch', 'church', 'service_category'])->get();

        return view('branch_pastor.expenses.edit', compact('expense',  'services', 'currentChurch', 'currentBranch'));
    }

    /**
     * Update the specified expense record in storage.
     */
    public function update(Request $request, Finance $expense)
    {
        $validatedData = null;

        try {
            $validatedData = $request->validate([
                'service_id' => 'required|exists:services,id',
                'date' => 'required|date',
                'worship_offering' => 'nullable|numeric|min:0',
                'tithe_offering' => 'nullable|numeric|min:0',
                'thanksgiving_offering' => 'nullable|numeric|min:0',
                'project_offering' => 'nullable|numeric|min:0',
                'special_offering' => 'nullable|numeric|min:0',
                'firstfruits_offering' => 'nullable|numeric|min:0',
                'children_offering' => 'nullable|numeric|min:0',
                'cds_dvd_tapes' => 'nullable|numeric|min:0',
                'books_and_stickers' => 'nullable|numeric|min:0',
                'user_id' => 'required|exists:users,id',
            ]);

            // dd($validatedData);

            $expense->update($validatedData);

            return redirect()->route('branch_pastor.expenses')->with('success', 'Finance report updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            // Redirect back with error messages
            return redirect()->back()->withErrors($validatedData)->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified expense record from storage.
     */
    public function destroy(Finance $expense)
    {
        $expense->delete();
        return redirect()->route('branch_pastor.expenses')->with('success', 'Finance report deleted successfully.');
    }

    public function approveFinanceReport(Request $request, $id)
    {
        // dd($id);
        try {
            $expense = Finance::findOrFail($id);
            $request->validate([
                'approve' => 'required|in:1,0',
                'reason' => 'required|string',
            ]);
            $expense->update(['status' => $request['approve'], 'approval_reason' => $request['reason'], 'approval_by' => Auth::user()->id]);
            return redirect()->back()->with('success', 'Approved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Not approved because: ' . $e->getMessage());
        }
    }
}
