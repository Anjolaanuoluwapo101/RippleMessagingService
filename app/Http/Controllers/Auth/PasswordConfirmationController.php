<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class PasswordConfirmationController extends Controller
{
  public function show() {
    return view('auth.confirm-password');
  }

  public function handle() {
    if (!Hash::check(request()->password, auth()->user()->password)) {
      return back()->withErrors(['password' => 'The provided password does not match our records.']);
    }
    session()->passwordConfirmed();
    //return redirect()->intended();//to the important view that houses a functionality
    return response('This is the functionality!');
  }
}