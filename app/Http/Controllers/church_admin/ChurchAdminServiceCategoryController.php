<?php

namespace App\Http\Controllers\church_admin;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChurchAdminServiceCategoryController extends Controller
{
    /**
     * Display a listing of the service categories.
     */
    public function index()
    {
        $categories = ServiceCategory::all();
        return view('service_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new service category.
     */
    public function create()
    {
        return view('service_categories.create');
    }

    /**
     * Store a newly created service category in storage.
     */
    public function store(Request $request)
    {
        try{
        // Data = ['name','description', 'status','church_id','branch_id','user_id']
        
        $validatedData = $request->validate([
            'name' => 'required|unique:service_categories,name',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
            'church_id' => 'required|exists:churches,id',
            'branch_id' => 'required|exists:branches,id',
            'user_id' => 'required|exists:users,id',  
        ]);

        // dd($validatedData);

        ServiceCategory::create($validatedData);
        return redirect()->back()->with('success', 'Service category created successfully.');
        }catch(\Exception $e){
            return redirect()->back()->withErrors($request)->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified service category.
     */
    public function show(ServiceCategory $serviceCategory)
    {
        return view('service_categories.show', compact('serviceCategory'));
    }

    /**
     * Show the form for editing the specified service category.
     */
    public function edit(ServiceCategory $serviceCategory)
    {
        return view('service_categories.edit', compact('serviceCategory'));
    }

    /**
     * Update the specified service category in storage.
     */
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $request->validate([
            'name' => 'required|unique:service_categories,name,' . $serviceCategory->id,
            'status' => 'required|in:active,inactive',
        ]);

        $serviceCategory->update($request->all());
        return redirect()->route('service_categories')->with('success', 'Service category updated successfully.');
    }

    /**
     * Remove the specified service category from storage.
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('service_categories')->with('success', 'Service category deleted successfully.');
    }
}
