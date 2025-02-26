<?php

namespace App\Http\Controllers\church_admin;

use App\Models\Finance;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ChurchAdminFinanceController extends Controller
{
    /**
     * Display a listing of the finances.
     */
    public function index()
    {
        $currentChurch = auth::user()->church->first();
        $finances = Finance::where('church_id', $currentChurch->id)->with('service')->get();
        // dd($finances    );
        return view('church_admin.finances.index', compact('finances'));
    }

    public function show(Finance $finance)
    {
        // $finance = Finance::with('service_category')->where('id',$finance->id)->get();

        // dd($finance->service_category->name);
        return view('church_admin.finances.show', compact('finance'));
    }

    /**
     * Show the form for creating a new finance record.
     */
    public function create()
    {
        $currentChurch = auth::user()->church->first();
        $services = Service::where('church_id', $currentChurch->id)->get();
        // $serviceCategories = ServiceCategory::all();
        return view('church_admin.finances.create', compact('services',));
    }

    /**
     * Store a newly created finance record in storage.
     */
    public function store(Request $request)
    {
        $validatedData = null;
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'service_id' => 'required|exists:services,id|unique:finances,service_id',
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

            return redirect()->route('church_admin.finances')->with('success', 'Finance report created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            // Redirect back with error messages
            return redirect()->back()->withErrors($validatedData)->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified finance record.
     */
    public function edit(Finance $finance)
    {
        $currentChurch = auth::user()->church->first();
        $services = Service::where('church_id', $currentChurch->id)->get();
        return view('church_admin.finances.edit', compact('finance',  'services'));
    }

    /**
     * Update the specified finance record in storage.
     */
    public function update(Request $request, Finance $finance)
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

            $finance->update($validatedData);

            return redirect()->route('church_admin.finances')->with('success', 'Finance report updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            // Redirect back with error messages
            return redirect()->back()->withErrors($validatedData)->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified finance record from storage.
     */
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('church_admin.finances')->with('success', 'Finance report deleted successfully.');
    }
}
