<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
  public function show() {
    return view('auth.login');
  }

  public function handle() {

    $success = auth()->attempt([
      'email' => request('email'),
      'password' => request('password')
    ], request()->has('remember')); //checks the db for a row that has the following

    if ($success) {
      //store some of the user data in a session
      request()->session()->put('rippler_id',auth()->user()->rippler_id);
      return view('ripple.dashboard');
    } else {
      return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
      ]); //manually specify the errors that should be returned to the initial sign in page....you can implement same for RegisterController
    }
  }
}