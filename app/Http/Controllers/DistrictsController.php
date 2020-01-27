<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $districts = District::orderBy('id', 'ASC')->get();
        return view('admin.pages.district.index', compact('districts'));
    }

    public function create()
    {
        $divisions = Division::orderBy('priority', 'ASC')->get();
        return view('admin.pages.district.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name.required' =>  'Please provide a district name',
                'division_id.required' =>  'Please provide a district',
            ]
        );

        $district = new District();
        $district->name = $request->name;
        $district->division_id = $request->division_id;

        $district->save();

        return redirect()->route('admin.districts.index')->with('success', 'District created successfully.');
    }

    public function edit($id)
    {
        $districts = District::find($id);
        $divisions = Division::orderBy('priority', 'ASC')->get();
        if (!is_null($districts)) {
            return view('admin.pages.district.edit', compact('districts', 'divisions'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name.required' =>  'Please provide a district name',
                'division_id.required' =>  'Please provide a district',
            ]
        );

        $district = District::find($id);
        $district->name = $request->name;
        $district->division_id = $request->division_id;

        $district->save();

        return redirect()->route('admin.districts.index')->with('success', 'District name updated successfully.');
    }

    public function delete($id)
    {
        $district = District::find($id);

        if (!is_null($district)) {

            $district->delete();
        }

        return back()->with('success', 'The district has been deleted successfully');
    }
}
