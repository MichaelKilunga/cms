<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members for a branch.
     */
    // public function index(Branch $branch)
    // {
    //     $members = $branch->members; // Assuming a relationship exists in Branch model
    //     dd($members);
    //     return view('branches.members.index', compact('members', 'branch'));
    // }
    public function index()
    {
        $members = Member::where('branch_id', auth()->user()->branch_id)->get();
        return view('branches.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create(Branch $branch)
    {
        // dd($branch);
        return view('branches.members.create', compact('branch'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
{
    dd($request);
    $data = $request->validate([
        'name' => 'required|string',
        'phone' => 'required|string',
        'location' => 'required|string',
        'occupation' => 'nullable|string',
        'dini_dhehebu' => 'nullable|string',
        'spiritual_status' => 'nullable|string',
        'description' => 'nullable|string',
        'branch_id' => 'required|exists:branches,id',
        'age_group' => 'required|string', // If this is part of the form
    ]);

    // Set the current user's ID as the added_by
    $data['added_by'] = auth()->id();

    // Create the member with the validated data
    Member::create($data);

    return redirect()->route('members.index')->with('success', 'Member added successfully.');
}


    /**
     * Show the form for editing the specified member.
     */
    public function edit(Branch $branch, Member $member)
    {
        return view('branches.members.edit', compact('branch', 'member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Branch $branch, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'dini_dhehebu' => 'nullable|string|max:255',
            'spiritual_status' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $member->update($request->all());

        return redirect()->route('member.index', $branch->id)
                         ->with('alert_success', 'Member updated successfully.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Branch $branch, Member $member)
    {
        $member->delete();

        return redirect()->route('member.index', $branch->id)
                         ->with('alert_success', 'Member deleted successfully.');
    }

    /**
     * Display the specified member's details.
     */
    public function show(Branch $branch, Member $member)
    {
        // dd($member->id);
        return view('branches.members.show', compact('branch', 'member'));
    }
}
