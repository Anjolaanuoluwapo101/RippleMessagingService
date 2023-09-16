<?php

namespace App\Http\Controllers\Ripple;

use App\Models\Url;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class LogicController extends Controller
{
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
      static $processedUrls = array();
      $processedUrls[] = url('get-ripples').'/'.$key->encrypted_url;
    }
    //return auth()->user()->rippler_id;
    return response()->json($processedUrls);
  }

  public function removeUrl() {}
}