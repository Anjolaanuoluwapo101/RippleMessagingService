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
      return view('Ripple.dashboard');
      //return response('You have successfully logged in');
      //return redirect()->to(RouteServiceProvider::HOME);
    } else {
      return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
      ]); //manually specify the errors that should be returned to the initial sign in page....you can implement same for RegisterController
    }
  }
}