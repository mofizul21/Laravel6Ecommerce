<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $divisions = Division::orderBy('priority', 'ASC')->get();
        return view('admin.pages.division.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.pages.division.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name.required' =>  'Please provide a division name',
                'priority.required' =>  'Please provide a division priority',
            ]
        );

        $division = new Division();
        $division->name = $request->name;
        $division->priority = $request->priority;

        $division->save();

        return redirect()->route('admin.divisions.index')->with('success', 'Division created successfully.');
    }

    public function edit($id)
    {
        $divisions = Division::find($id);
        if (!is_null($divisions)) {
            return view('admin.pages.division.edit', compact('divisions'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name.required' =>  'Please provide a brand name'
            ]
        );

        $division = Division::find($id);
        $division->name = $request->name;
        $division->priority = $request->priority;

        $division->save();

        return redirect()->route('admin.divisions.index')->with('success', 'Division name updated successfully.');
    }

    public function delete($id)
    {
        $division = Division::find($id);

        if (!is_null($division)) {
            // Delete all the districts under the division
            $districts = District::where('division_id', $division->id)->get();
            foreach($districts as $district){
                $district->delete();
            }
            $division->delete();
        }

        return back()->with('success', 'The division has been deleted successfully');
    }
}
