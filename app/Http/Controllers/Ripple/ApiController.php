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
    /*$this->middleware(function (Request $request, $next) {
      //the admin rippler is the owner of the site making the api call
      //we need to verify that the admin rippler has already registered his foreign domnain name on our service before allowing him access
      $adminRippler = User::findOrfail(request()->route('admin_id'));
      $httpHosts = unserialize($adminRippler->http_hosts);
      foreach ($httpHosts as $host) {
        if (Hash::check(request()->getHost(), $host)) {
          return $next($request);
        }
      }
      return response()->json([
        "status" => "error",
        "message" => "This host has not been registered,please inform admin to register this host name in Ripple Dashboard",
        "host_name" => request()->getHost(),
      ]);
    });*/
    $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(),
      [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        //'password' => 'required|string|min:8|confirmed',
      ]);

    if ($validator->fails()) {
      return response()->json($validator->errors()->getMessages());
    }

    $newUser = User::create([
      'rippler_id' => request('rippler_id'),
      'name' => request('name'),
      'email' => request('email'),
      "password" => "0",
      'email_verified_at' => now(),
    ]);

    if ($newUser) {
      return response()->json([
        "status" => "success",
        "message" => "Account successful created"
      ]);
    }
  }

  public function sendRipple(RippleController $controller) {
    return $controller->create(new Request, new Ripple);
  }

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
  
  public function getEncryptedUrl(){
    $encrypted_url = Url::select('encrypted_url')->where('url','=',request('url'))->first();
    return response()->json([
      'encrypted_url' => $encrypted_url,
      ]);
  }
  
}