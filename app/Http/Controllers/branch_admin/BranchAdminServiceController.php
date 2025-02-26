<?php

namespace App\Http\Controllers\branch_admin;

use App\Models\Service;
use App\Models\Branch;
use App\Models\Church;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Member;

class BranchAdminServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();
        $serviceCategories = ServiceCategory::where('church_id', $currentChurch->id)->get();
        $services = Service::where('church_id', $currentChurch->id)->where('branch_id', $currentBranch->id)->with(['user', 'branch', 'church','service_category'])->get();
        return view('branch_admin.services.index', compact('services', 'serviceCategories'));
    }

    public function show(Service $service)
    {
        return view('branch_admin.services.show', compact('service'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        // dd("nipo hapa");
        $currentMember = Member::where('user_id', Auth::user()->id)->first();
        $currentChurch = Church::where('id', $currentMember->church_id)->first();
        $currentBranch = Branch::where('id', $currentMember->branch_id)->first();
        $serviceCategories = ServiceCategory::where('church_id', $currentChurch->id)->get();
        // dd($serviceCategories);
        return view('branch_admin.services.create', compact('currentBranch', 'currentChurch', 'serviceCategories'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'service_category_id' => 'required|exists:service_categories,id',
                'date' => 'required|date',
                'message' => 'required|string|max:255',
                'minister' => 'required|string|max:255',
                'women' => 'nullable|integer|min:0',
                'men' => 'nullable|integer|min:0',
                'children' => 'nullable|integer|min:0',
                'cars' => 'nullable|integer|min:0',
                'baptism_water' => 'nullable|integer|min:0',
                'baptism_spirit' => 'nullable|integer|min:0',
                'new_birth' => 'nullable|integer|min:0',
                'first_timers' => 'nullable|integer|min:0',
                'user_id' => 'required|exists:users,id',
                'branch_id' => 'required|exists:branches,id',
                'church_id' => 'required|exists:churches,id',
            ]);

            // dd($validatedData);

            // If validation succeeds, proceed with your logic
            Service::create($validatedData);
            return redirect()->route('branch_admin.services')->with('success', 'Service report created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);

            // Redirect back with error messages
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified service. 
     */
    public function edit(Service $service)
    {
        $branches = Branch::where('church_id',$service->church_id)->get();
        $churches = Church::where('id',$service->church_id)->get();
        $serviceCategories = ServiceCategory::all();
        return view('branch_admin.services.edit', compact('service', 'branches', 'churches', 'serviceCategories'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'service_category_id' => 'required|exists:service_categories,id',
                'date' => 'required|date',
                'message' => 'required|string|max:255',
                'minister' => 'required|string|max:255',
                'women' => 'nullable|integer|min:0',
                'men' => 'nullable|integer|min:0',
                'children' => 'nullable|integer|min:0',
                'cars' => 'nullable|integer|min:0',
                'baptism_water' => 'nullable|integer|min:0',
                'baptism_spirit' => 'nullable|integer|min:0',
                'new_birth' => 'nullable|integer|min:0',
                'first_timers' => 'nullable|integer|min:0',
                'user_id' => 'required|exists:users,id',
                'branch_id' => 'required|exists:branches,id',
                'church_id' => 'required|exists:churches,id',
            ]);

            // dd($validatedData);

            // If validation succeeds, proceed with your logic
            $service->update($validatedData);
            return redirect()->route('branch_admin.services')->with('success', 'Service report updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            // Redirect back with error messages
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        try{
        $service->delete();
        return redirect()->route('branch_admin.services')->with('success', 'Service report deleted successfully.');
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
