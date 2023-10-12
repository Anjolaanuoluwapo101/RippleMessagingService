<?php

namespace App\Http\Controllers\Ripple;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Url;
use App\Models\Ripple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use App\Http\Controllers\Ripple\RippleController;

class ApiController extends Controller
{
  public function __construct() {
    $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(),
      [
        'rippler_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        //'password' => 'required|string|min:8|confirmed',
      ]);

    if ($validator->fails()) {
      return response()->json($validator->errors()->getMessages());
    }

    $newUser = User::create([
      'rippler_id' => request()->input('rippler_id'),
      'name' => request()->input('name'),
      'email' => request()->input('email'),
      "password" => "",//since this account is an indirect one being created by an api admin(who is just a user taking advantage of the api functionality)
      'email_verified_at' => now(),
    ]);

    if ($newUser) {
      return response()->json([
        "status" => "success",
        "message" => "Account successfully created"
      ]);
    }
  }

  public function sendRipple(RippleController $controller) {
    return $controller->create(new Request, new Ripple);
  }  
  
  //this allows the api admin add create an encrypted url(code) for a post 
  public function addUrl(Request $request) {
    $validator = Validator::make($request->all(), [
      'url' => 'required|max:255|unique:urls',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors()->getMessages());
      //return redirect()->back()->withErrors($validator->errors()->getMessages())->withInput();
    }
    //next we create a new record
    $url = Url::create([
      'rippler_id' => request()->route('rippler_id'),
      'url' => request('url'),
      'encrypted_url' => Str::random(14),
    ]);
    
    if($url){
      return response()->json([
        "status" => "success",
        "message" => "url successful added and encrypted_url(code) generated for it"
      ]);
    }
  }
  
  //get encrypted_url(code) for a  post/ content
  public function getEncryptedUrl(){
    $encrypted_url = Url::select('encrypted_url')->where('url','=',request()->input('url'))->first();
    return response()->json([
      'encrypted_url' => $encrypted_url,
      ]);
  }
  
}