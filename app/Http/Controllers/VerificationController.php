<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($token){
        $user = User::where('remember_token', $token)->first();
        if (!is_null($user)) {        
            $user->status = 1;
            $user->remember_token = NULL;
            $user->save();

            session()->flash('success', 'You are now registered successfully! Login now.');
            return redirect('login');
        }else{
            session()->flash('error', 'Your token is wrong!');

            return redirect('/');
        }
    }
}
