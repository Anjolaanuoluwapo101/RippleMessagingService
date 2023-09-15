<?php

namespace App\Http\Controllers\Ripple;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\RipplerInformation;
use App\Mail\SampleMail;


class RegisterRipplerController extends Controller
{
  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'rippler_name' => 'required|string|max:255|unique:rippler_information',
      'rippler_email' => 'required|email|max:255|unique:rippler_information',
      'password' => 'required|string|min:8|confirmed',
    ]);
    
    //manually generate uuid
    $ripplerId = Str::uuid();

    $newRippler = RipplerInformation::make([
      'rippler_name' => request('rippler_name'),
      'rippler_email' => request('rippler_email'),
      'password' => Hash::make(request('password')),
      'rippler_id' => $ripplerId, //normally the table should generate a uuid itself by making it the primary key..will do that later
    ]);
    
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors()->getMessages())->withInput();
    }else{
      $hashedRipplerName = Hash::make(request('rippler_name'));
      $emailCheck = $this->sendEmailVerificationLink($ripplerId,$hashedRipplerName);
      if($emailCheck == true){
        //echo "Email Sent";
        $newRippler->save();
        return response("Please Check Your Email To Confirm Your Registration");
      }
    }
  }

  public function sendEmailVerificationLink($ripplerId,$hashedRipplerName):bool {
    Mail::to(request('rippler_email'))->send( 
        new Samplemail(
        fromAddress:'anjolaakinsoyinu@gmail.com',
        fromName:'Ripple',
        theSubject:'Ripple Verification Link',
        theMessage:url("verify-rippler-account/$ripplerId?n=$hashedRipplerName"),
        recipientName:request('rippler_name'),
        )
    );
    return true;
  }
  
  public function verifyAccount(){
    //echo request()->route('rippler_id');
    $ripplerAccount = RipplerInformation::where('rippler_id','=',request()->route('rippler_id'))->first();
    if(Hash::check($ripplerAccount['rippler_name'],request()->get('n'))){
      $ripplerAccount->is_verified = 1;
      $ripplerAccount->save();
      echo "Account Verified";
      
    }else{
      abort(404);
    }
  }
  
  public function login(Request $request){
    $validator = Validator::make($request->all(), [
      'rippler_email' => 'required|email|max:255|unique:rippler_information',
      'password' => 'required|string|min:8',
    ]);
  }
}