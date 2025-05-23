<?php

namespace App\Http\Controllers\branch_pastor;


use App\Models\User;
use App\Models\Branch;
use App\Models\Church;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Egulias\EmailValidator\EmailParser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BranchPastorMemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();
        $members = Member::where('church_id', $currentChurch->id)->where('branch_id', $currentBranch->id)->with(['user','church','branch'])->get();

        //get all   roles
        $roles = \Spatie\Permission\Models\Role::all();
        return view('branch_pastor.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        $users = User::all();
        $branches = Branch::all();
        $churches = Church::all();
        return view('branch_pastor.members.create', compact('users', 'branches', 'churches'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        // generate email from the first part of the name apended with @cms.com
        $request['email'] = strtolower(str_replace(' ', '', $request['name'])) . '@cms.com';        

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

            return redirect()->route('branch_pastor.members')->with('success', 'Member added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($validated)->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member)
    {
        // $users = User::all();
        // $branches = Branch::all();
        // $churches = Church::all();
        return view('branch_pastor.members.edit', compact('member'));
    }

    public function show(Member $member)
    {
        return view('branch_pastor.members.show', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validatedData = null;
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'email' => 'required|email',
                'name' => 'required|string|max:255',
                'branch_id' => 'required|exists:branches,id',
                'church_id' => 'required|exists:churches,id',
                'status' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'date_of_birth' => 'nullable|date',
                'phone_number' => 'nullable|string|max:15',
                'gender' => 'nullable|in:male,female,other',

                // validate roles collected in roles[], member must have atleast one role
                'roles' => 'required|array|min:1',
                'roles.*' => 'required|exists:roles,name',  // validate each role in roles[]
            ]);

            // dd($validatedData);

            // update user
            $user = User::find($validatedData['user_id']);
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);

            //update roles
            $user->syncRoles($validatedData['roles']);            
            
            //update member
            $member->update($validatedData);

            return redirect()->route('branch_pastor.members')->with('success', 'Member updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($validatedData)->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        try{
        $member->delete();

        //delete associated user too
        $user = User::find($member->user_id);
        $user->delete();

        return redirect()->route('branch_pastor.members')->with('success', 'Member deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //function to assignRole to a member
    public function assignRole(Request $request)
    {
        // dd($request->all());
        $validatedData = null;
        try {
            $validatedData = $request->validate([
                'role' => 'required|exists:roles,name',
                'member_id' => 'required|exists:members,id',
            ]);

            // dd($validatedData);

            $member = Member::find($validatedData['member_id']);
            $user = User::find($member->user_id);
            $user->assignRole($validatedData['role']);

            return redirect()->route('branch_pastor.members')->with('success', 'Role assigned successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($validatedData)->with('error', $e->getMessage());
        }
    }
}
