<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyRegistration;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/admin';
    // protected $redirectTo = RouteServiceProvider::HOME; // original


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    /**
     * @override login() function
     */
    public function login(Request $request)
    {

        $request->validate([
            'email'      => 'required|email',
            'password'   => 'required',
        ]);

        //$admin = Admin::where('email', $request->email)->first();

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('admin.index'));
        } else {
            session()->flash('error', 'Invalid login');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('admin.login');
    }

}

