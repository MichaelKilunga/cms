<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Branch;
use App\Models\Church;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $members = Member::with(['user', 'branch', 'church'])->get();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        $users = User::all();
        $branches = Branch::all();
        $churches = Church::all();
        return view('members.create', compact('users', 'branches', 'churches'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'church_id' => 'required|exists:churches,id',
            'status' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|in:male,female,other',
        ]);

        Member::create($request->all());

        return redirect()->route('members')->with('success', 'Member added successfully.');
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member)
    {
        $users = User::all();
        $branches = Branch::all();
        $churches = Church::all();
        return view('members.edit', compact('member', 'users', 'branches', 'churches'));
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'church_id' => 'required|exists:churches,id',
            'status' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|in:male,female,other',
        ]);

        $member->update($request->all());

        return redirect()->route('members')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members')->with('success', 'Member deleted successfully.');
    }
}
