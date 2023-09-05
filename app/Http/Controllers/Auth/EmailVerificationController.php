<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }
    
    public function request()
    {
        auth()->user()->sendEmailVerificationNotification();

        //return back()->with('success', 'Verification link sent!');
        return response('Email Link Sent');
    }
    
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        
        return response('Email surely verified');
        //return redirect()->to('/home'); // <-- change this to whatever you want
    }
}
