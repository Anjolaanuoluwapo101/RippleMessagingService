<?php

// app/Http/Controller/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  public function show() {
    return view('auth.register');
  }

  public function handle(Request $request) {
    /*request()->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'max:255'],
      'password' => ['required', 'string', 'min:8', 'confirmed']
    ]);*/
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'password' => 'required|string|min:8|confirmed',
    ]);
    if ($validator->fails()) {
      /*
      $t = fopen('data.txt','w');
      fwrite($t,serialize($validator->errors()->getMessages()));
      fclose($t);
      */
      //$errors = $validator->errors()->getMessages();
      //return redirect('/')->withErrors($validator)->withInput();
      //session()->put('old',$request->all());
      //session($validator->errors()->getMessages());
      //$request->session()->put('key', 'value');
      return redirect()->back()->withErrors($validator->errors()->getMessages())->withInput();
    }


    $user = User::create([
      'name' => request('name'),
      'email' => request('email'),
      'password' => Hash::make(request('password'))
    ]);


    event(new Registered($user));
    /*
    return back()->withErrors([
      'confirm_password'=>'Password doesn\'t match',
      ]);*/
    //Auth::login($user);
    return response('Your account have been created,please check your email for verification link')->header('Content-Type', 'text/plain');
    //return redirect()->to(RouteServiceProvider::HOME);
  }
}