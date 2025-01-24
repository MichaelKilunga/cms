<?php

namespace App\Http\Controllers\church_admin;

use App\Models\Service;
use App\Models\Branch;
use App\Models\Church;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ChurchAdminServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::with(['user', 'branch', 'church','service_category'])->get();
        // $category = ServiceCategory::all();
        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        // dd("nipo hapa");
        $branches = Branch::all();
        $churches = Church::all();
        $serviceCategories = ServiceCategory::all();
        return view('services.create', compact('branches', 'churches', 'serviceCategories'));
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
            return redirect()->back()->with('success', 'Service report created successfully.');
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
        $branches = Branch::all();
        $churches = Church::all();
        $serviceCategories = ServiceCategory::all();
        return view('services.edit', compact('service', 'branches', 'churches', 'serviceCategories'));
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
                // 'user_id' => 'required|exists:users,id',
                'branch_id' => 'required|exists:branches,id',
                'church_id' => 'required|exists:churches,id',
            ]);

            $validatedData['user_id'] = Auth::user()->id;

            // If validation succeeds, proceed with your logic
            $service->update($validatedData);
            return redirect()->route('services')->with('success', 'Service report created successfully.');
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
        $service->delete();
        return redirect()->route('services')->with('success', 'Service report deleted successfully.');
    }
}
