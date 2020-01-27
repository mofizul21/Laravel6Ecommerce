<?php

namespace App\Http\Controllers;

use App\User;
use App\District;
use App\Division;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        return view('pages.users.dashboard', compact('user'));
    }

    public function profile()
    {
        $divisions = Division::orderBy('priority', 'ASC')->get();
        $districts = District::orderBy('id', 'ASC')->get();
        $user = Auth::user();
        return view('pages.users.profile', compact('user', 'divisions', 'districts'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'alpha_dash', 'max:255', 'unique:users,username,'.$user->id], // Preventing to display 'username already exist'
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id], // Preventing to display 'email already exist'
            'phone_no' => ['required', 'max:15', 'unique:users,phone_no,'.$user->id], // Preventing to display 'phone_no already exist'
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'street_address' => ['required', 'max:100'],
        ]);

        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->phone_no = $request->phone_no;
        $user->street_address = $request->street_address;
        $user->shipping_address = $request->shipping_address;
        if ($request->password != NULL | $request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->ip_address = request()->ip();

        $user->save();

        session()->flash('success', 'User profile updated successfully!');

        return back();
    }
}
