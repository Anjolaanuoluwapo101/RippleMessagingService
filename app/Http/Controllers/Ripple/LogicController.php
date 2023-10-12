<?php

namespace App\Http\Controllers\Ripple;

use App\Models\Url;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

/**
*
* This controller only deals with requess routed from an authenticated user dashboard
**/

class LogicController extends Controller
{
 public function __construct() {
  //$this->middleware('auth');
 }

 public function addUrl(Request $request) {
  $validator = Validator::make($request->all(), [
   'url' => 'required|max:255|unique:urls',
   'password' => 'required|max:255',
  ]);

  if ($validator->fails()) {
   return redirect()->back()->withErrors($validator->errors()->getMessages())->withInput();
  } else {
   //lets check that password is valid
   if (!Hash::check(request('password'), auth()->user()->password)) {
    return redirect()->back()->withErrors([
     'password' => 'invalid password',
    ]);
   } else {
    //next we create a new record
    $url = Url::create([
     'rippler_id' => auth()->user()->rippler_id,
     'url' => request('url'),
     'encrypted_url' => Str::random(14),
    ]);

    if ($url) {
     //we tell the user that url has been added
     request()->session()->flash('url_added', true);
     return Redirect::away(url('/dashboard#form'));
    }
   }
  }
 }

 public function loadUrls() {
  $keys = Url::select('*')->where('rippler_id', '=', auth()->user()->rippler_id)->cursor();
  foreach ($keys as $key) {
   static $count = 0;
   static $processedUrls = array();
   $processedUrls[$count]["content_link"] = $key->url;
   $processedUrls[$count]["get_comments_link"] = url('get-ripples').'/'.$key->encrypted_url;
   $processedUrls[$count]["get_replies_to_a_comment_link"] = url('get-related-ripples').'/'.$key->encrypted_url.'/comment_id';
   $processedUrls[$count]["send_comment_or_reply_link"] = url('send-ripple').'/'.$key->encrypted_url;
   $count++;
  }
  //return auth()->user()->rippler_id;
  return response()->json($processedUrls);
 }

 public function removeUrl() {
  if (!empty(request()->input('encrypted_url'))) {
   $urlToBeDeleted = Url::where('encrypted_url','=', request('encrypted_url'))->first();
   if(!$urlToBeDeleted){
    return response()->json(["status"=>"failure","message"=>"encrypted_url doesn't exist"]);
   };
   if($urlToBeDeleted->delete()){
    return response()->json(["status"=>"success","message"=>"url deleted,and associated messages to url"]);
   }
  }else{
   return response()->json(["status"=>"failure","message"=>"encrypted_url not set "]);
  }
 }

//not in use ....
 public function addHost() {
  $ripplerDetails = User::findOrfail(auth()->user()->rippler_id);
  if (!empty(request('http_host'))) {
   $registeredHttpHosts = unserialize($ripplerDetails->http_hosts);
   $updatedRegisteredHttpHosts[] = Hash::make(request('http_host'));
   $ripplerDetails->http_hosts = serialize($updatedRegisteredHttpHosts);
   $ripplerDetails->save();
   request()->session()->flash('added_host', true);
   return Redirect::away(url('/dashboard#host_form'));
  } else {
   request()->session()->flash('failed_to_add_host', true);
   return redirect()->back()->withInput();
  }
 }
 
 public function getEncryptedURL(){
  if(!request()->filled('url')){
   return response()->json(["status"=>"failed","message"=>"please set 'url' query"]);
  }
  
  //next we fetch the encrypted_url(code) for that particular registered url
  $encryptedUrl = Url::select('encrypted_url')->where('url','=', request()->input('url'))->first();
  if(!$encryptedUrl){
   return response()->json(["status"=>"failed","message"=>"this url was never registered"]);
  }
  return $encryptedUrl;
 }
}