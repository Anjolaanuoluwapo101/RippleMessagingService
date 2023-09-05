<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordConfirmationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;

 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

Route::get('/', function () {
    return view('welcome');
});
*/
;

//for registration
Route::get('/', [RegisterController::class, 'show'])->name('register'); 
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