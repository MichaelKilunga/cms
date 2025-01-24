<?php

namespace App\Http\Controllers\church_admin;

use App\Models\Branch;
use App\Models\Church;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChurchAdminBranchController extends Controller
{
    /**
     * Display a listing of the branches.
     */
    public function index()
    {
        $currentChurch = auth::user()->church->first();
        $branches = Branch::where('church_id', $currentChurch->id)->get();
        // dd($branches->all());
        return view('church_admin.branches.index', compact('branches'));
    }
    public function show(Branch $branch)
    {
        return view('church_admin.branches.show', compact('branch'));
    }

    /**
     * Show the form for creating a new branch.
     */
    public function create()
    {
        $churches = Church::all(); // Fetch all churches
        return view('church_admin.branches.create', compact('churches'));
    }

    /**
     * Store a newly created branch in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:branches',
                'location' => 'nullable|string|max:255',
                'church_id' => 'required|exists:churches,id',
            ]);

            Branch::create($request->all());
            return redirect()->back()->with('success', 'Branch created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified branch.
     */
    public function edit(Branch $branch)
    {
        $churches = Church::all();
        return view('church_admin.branches.edit', compact('branch', 'churches'));
    }

    /**
     * Update the specified branch in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'church_id' => 'required|exists:churches,id',
        ]);

        $branch->update($request->all());

        return redirect()->route('church_admin.branches')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified branch from storage.
     */
    public function destroy(Branch $branch)
    {
        try{
        $branch->delete();
        return redirect()->route('church_admin.branches')->with('success', 'Branch deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
