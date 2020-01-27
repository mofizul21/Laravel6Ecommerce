<?php

namespace App\Http\Controllers\Auth;

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


    protected $redirectTo = '/';
    // protected $redirectTo = RouteServiceProvider::HOME; // original


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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

        $user = User::where('email', $request->email)->first();

        if ($user->status == 1) {
            # Login user
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                return redirect('/');
            } else {
                session()->flash('error', 'Invalid login');
                return redirect()->route('login');
            }
        } else {
            // Send him a token again
            if (!is_null($user)) { // if user in this email
                $user->notify(new VerifyRegistration($user));

                session()->flash('success', 'A NEW confirmation mail has been sent to your email inbox. Please open the mail and click on the confirmation link');
                return redirect('/');
            } else {
                session()->flash('error', 'Please registration first');
                return redirect()->route('register');
            }
        }
    }
}

