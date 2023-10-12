<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordConfirmationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;

//for Ripple
use App\Http\Controllers\Ripple\RippleController;
use App\Http\Controllers\Ripple\LogicController;
use App\Models\Ripple;

 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
**/

//These routes take care of managing messages (sending messages/ripples(comment/reply) , displaying them etc)
 Route::controller(RippleController::class)->group(function () {
 //this sends a ripple(message) to the backend..exempted from csrf check.
 Route::post('send-ripple/{encrypted_url}','create');
 //to get all related nest level 0 ripples(messages) for a url(basically a reply to a comment,a reply to a reply etc)
 Route::get('get-ripples/{encrypted_url}','getRipplesForUrl')->middleware('auth');
 /**
  * ___To get the immediate related ripples to a particular ripple,that are non quotes___(ignore non quotes )
  * The none quote ripples are normal replies to a ripple.
  * You dont need to worry about quote ripples tho..it was put there just in case this was to become a social media backend
  **/
 Route::get('get-related-ripples/{encrypted_url}/{ripple_id}','getRelatedRipples');
 });
 
 //To search for a keyword in the ripple database...not in use 
 Route::get('/search-keyword/{keyword}', function (string $keyword){
   $keywords = array();
   $keywords[] = $keyword;
   return Ripple::searchForRelatedRipples($keywords);
 });
 
 
 
//Ripple dashboard after signing in,this opens the dashboard that an authenticated user can use
Route::get('/dashboard',function(){
  return view('ripple.dashboard');
})->middleware('auth')->name('dashboard');
 
 /**
  * LogicController class deals with request from a users dashboard
  * 
  **/
Route::controller(LogicController::class)->group(function () {
//registers a url to a post/or content from another site
Route::post('add-url','addUrl');
//removes a url to a particular post/or content
Route::post('remove-url','removeUrl');
//loads all the registered urls registered by a particular user(account)
Route::get('load-urls','loadUrls');
//get the encrypted url for a particular link(url of the post/content)
Route::get('get-encrypted-url','getEncryptedURL');
//Required for the api feature to work
Route::post('add-host','addHost'); 
});




//Welcome page for users/guests
Route::get('/', function (){
  return view('ripple.docs'); //contains the docs that shows clients how to use this service also signing in/up functionality
});

Route::get('/test', function(){
 //return view('test');
 return http_host();
});


//for registration
Route::get('/register', [RegisterController::class, 'show'])->name('register'); 
Route::post('/register', [RegisterController::class, 'handle'])->name('register');//handles registration form

//for email verification
//displays page that allows user request for an email verification 
Route::get('/verify-email', [EmailVerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice'); // <-- don't change the route name
//listens to the user,if he/she clicks the form and sends an email Validation link to the User's email
Route::post('/verify-email/request', [EmailVerificationController::class, 'request'])
    ->middleware('auth')
    ->name('verification.request');
 //helps verify the user email
 Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed']) // <-- don't remove "signed"
    ->name('verification.verify'); // <-- don't change the route name

//for signing in...
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'handle'])->name('login');//handles login form


//for logout
Route::get('/logout', [LogoutController::class, 'show'])->name('logout');
Route::post('/logout', [LogoutController::class, 'handle'])->name('logout');//handles logging out


/**
 * for password confirmation
 * Imagine you have a particular functionality in your the app but you want you 
 * make a confirmation that this person who wants to access such is a user..basically 
 * you're trying to prevent unauthorized access towards this page that contains the functionality
 *E.g Before a user can delete his account,he has to type in his password then he can access the page were he/she goes on to delete the account
 **/
 
 Route::get('/confirm-password', [PasswordConfirmationController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', [PasswordConfirmationController::class, 'handle'])
    ->middleware('auth')
    ->name('password.confirm');
    
    
//for password reset
//opens the password reset form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request'); //you can add the guest middleware if you want authenticated users to be redirected somewhere else..this would prevent them from changing password tho except they log out
//
Route::post('/forgot-password', [PasswordResetController::class,'send'])->name('password.email'); //you can add the guest middleware if you want authenticated users to be redirected somewhere else..this would prevent them from changing password tho except they log out
//
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset'); //you can add the guest middleware if you want authenticated users to be redirected somewhere else..this would prevent them from changing password tho except they log out

//
Route::post('/reset-password', [PasswordResetController::class,'change'])->name('password.update');// //you can add the guest middleware if you want authenticated users to be redirected somewhere else..this would prevent them from changing password tho except they log out
