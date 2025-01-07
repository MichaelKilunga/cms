<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Church;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the branches.
     */
    public function index()
    {
        $branches = Branch::with('church')->get();
        return view('branches.index', compact('branches'));
    }
    public function show(Branch $branch)
    {
        return view('branches.show', compact('branch'));
    }

    /**
     * Show the form for creating a new branch.
     */
    public function create()
    {
        $churches = Church::all(); // Fetch all churches
        return view('branches.create', compact('churches'));
    }

    /**
     * Store a newly created branch in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:branches',
            'location' => 'nullable|string|max:255',
            'church_id' => 'required|exists:churches,id',
        ]);

        Branch::create($request->all());

        return redirect()->route('branches')->with('success', 'Branch created successfully.');
    }

    /**
     * Show the form for editing the specified branch.
     */
    public function edit(Branch $branch)
    {
        $churches = Church::all();
        return view('branches.edit', compact('branch', 'churches'));
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

        return redirect()->route('branches')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified branch from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches')->with('success', 'Branch deleted successfully.');
    }
}
