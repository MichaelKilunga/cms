<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    /**
     * Display a listing of the finances.
     */
    public function index()
    {
        $finances = Finance::with('service_category')->get();
        // $category = ServiceCategory::all();
        return view('finances.index', compact('finances'));
    }

    public function show(Finance $finance)
    {
        // $finance = Finance::with('service_category')->where('id',$finance->id)->get();

        // dd($finance->service_category->name);
        return view('finances.show', compact('finance'));
    }

    /**
     * Show the form for creating a new finance record.
     */
    public function create()
    {
        $services = Service::all();
        $serviceCategories = ServiceCategory::all();
        return view('finances.create', compact('services', 'serviceCategories'));
    }

    /**
     * Store a newly created finance record in storage.
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'service_category_id' => 'required|exists:service_categories,id',
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
                // 'user_id' => 'required|exists:users,id',
            ]);

            // dd($validatedData['tithe_offering']);
            $validatedData['user_id'] = Auth::user()->id;

            Finance::create($validatedData);

            return redirect()->route('finances')->with('success', 'Finance report created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            // Redirect back with error messages
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified finance record.
     */
    public function edit(Finance $finance)
    {
        // $services = Service::all();
        $service_categories = ServiceCategory::all();
        return view('finances.edit', compact('finance',  'service_categories'));
    }

    /**
     * Update the specified finance record in storage.
     */
    public function update(Request $request, Finance $finance)
    {

        try {
            $validatedData = $request->validate([
                'service_category_id' => 'required|exists:service_categories,id',
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
                // 'user_id' => 'required|exists:users,id',
            ]);


            $validatedData['user_id'] = Auth::user()->id;

            $finance->update($validatedData);

            return redirect()->route('finances')->with('success', 'Finance report updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the errors for debugging
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            // Redirect back with error messages
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified finance record from storage.
     */
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances')->with('success', 'Finance report deleted successfully.');
    }
}
