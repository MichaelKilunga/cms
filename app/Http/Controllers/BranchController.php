<?php
namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller {
    public function index() {
        $branches = Branch::all();
        return view( 'branches.index', compact( 'branches' ) );
    }

    public function create() {
        return view( 'branches.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required|unique:branches|max:255',
            'location' => 'nullable|max:255',
        ] );

        Branch::create( $request->all() );

        return redirect()->route( 'branches' )->with( 'alert_success', 'Branch created successfully.' );
    }

    // Show the form for editing the specified branch

    public function edit( Branch $branch ) {
        return view( 'branches.edit', compact( 'branch' ) );
    }

    // Update the specified branch in storage

    public function update( Request $request, Branch $branch ) {
        $request->validate( [
            'name' => 'required|max:255|unique:branches,name,' . $branch->id,
            'location' => 'required|max:255',
        ] );

        $branch->update( $request->all() );

        return redirect()->route( 'branches' )->with( 'alert_success', 'Branch updated successfully.' );
    }

    // Remove the specified branch from storage

    public function destroy( Branch $branch ) {
        $branch->delete();

        return redirect()->route( 'branches' )->with( 'alert_success', 'Branch deleted successfully.' );
    }
}