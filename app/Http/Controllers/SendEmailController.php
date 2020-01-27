<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index(){
        return view('pages.contact');
    }

    public function send(Request $request){
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|email',
            'subject'   =>  'required',
            'message'   =>  'required',
        ]);
        
        $data = array(
            'name'          =>  $request->name,
            'subject'       =>  $request->subject,
            'message'       =>  $request->message
        );

        Mail::to('mofizul21@gmail.com')->send(new SendMail($data));
        return back()->with('success', 'Your message has been sent. We will contact with you shortly.');
    }
}
