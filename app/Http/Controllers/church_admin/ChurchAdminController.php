<?php

namespace App\Http\Controllers\church_admin;

use App\Models\Church;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChurchAdminController extends Controller
{
    /**
     * Display a listing of the churches.
     */
    public function index()
    {
        $churches = Church::with('administrator')->get();
        return view('churches.index', compact('churches'));
    }

    public function show(Church $church)
    {
        return view('churches.show', compact('church'));
    }

    /**
     * Show the form for creating a new church.
     */
    public function create()
    {
        $users = User::all(); // Get all users to assign as administrators
        return view('churches.create', compact('users'));
    }

    /**
     * Store a newly created church in storage.
     */
    public function store(Request $request)
    {
        // $request['administrator_id'] = Auth::user()->id;
        try {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'motto' => 'nullable|string|max:255',
            'administrator_id' => 'required|exists:users,id|unique:churches,administrator_id,' . Auth::user()->id ?? null,
        ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        // dd($request->all());
        $logoPath = null;

        try {
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
            }
            Church::create([
                'name' => $request->name,
                'logo' => $logoPath,
                'motto' => $request->motto,
                'administrator_id' => $request->administrator_id,
            ]);
            return redirect()->back()->with('success', 'Church created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified church.
     */
    public function edit(Church $church)
    {
        $users = User::all();
        return view('churches.edit', compact('church', 'users'));
    }

    /**
     * Update the specified church in storage.
     */
    public function update(Request $request, Church $church)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'motto' => 'nullable|string|max:255',
            'administrator_id' => 'required|exists:users,id|unique:churches,administrator_id,' . Auth::user()->id ?? null,
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $church->update(['logo' => $logoPath]);
        }

        $church->update([
            'name' => $request->name,
            'motto' => $request->motto,
            'administrator_id' => $request->administrator_id,
        ]);

        return redirect()->route('churches')->with('success', 'Church updated successfully.');
    }

    /**
     * Remove the specified church from storage.
     */
    public function destroy(Church $church)
    {
        $church->delete();
        return redirect()->route('churches')->with('success', 'Church deleted successfully.');
    }
}
