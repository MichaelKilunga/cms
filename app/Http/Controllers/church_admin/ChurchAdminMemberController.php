<?php

namespace App\Http\Controllers\church_admin;


use App\Models\User;
use App\Models\Branch;
use App\Models\Church;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Egulias\EmailValidator\EmailParser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChurchAdminMemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $currentChurch = auth::user()->church->first();
        $members = Member::where('church_id', $currentChurch->id)->with(['user', 'branch', 'church'])->get();
        return view('church_admin.members.index', compact('members'));
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
        $request['email'] = (trim($request['name']) . '@cms.com');
        $validated = null;
        try {
            $validated = $request->validate([
                // 'user_id' => 'required|exists:users,id',
                'name' => 'required|string|max:255|unique:users,name',
                'branch_id' => 'required|exists:branches,id',
                'church_id' => 'required|exists:churches,id',
                // 'status' => 'nullable|string|max:255',
                // 'description' => 'nullable|string',
                // 'date_of_birth' => 'nullable|date',
                // 'phone_number' => 'nullable|string|max:15',
                'gender' => 'nullable|in:male,female',
            ]);
            
            
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make('password'),
            ]);
            // Assign default role & permission
            $user->assignRole('member');
            
            $request['user_id'] = $user->id;
            
            // dd($request->all());

            Member::create($request->all());

            return redirect()->back()->with('success', 'Member added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($validated)->with('error', $e->getMessage());
        }
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
