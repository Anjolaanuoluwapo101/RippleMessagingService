<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordConfirmationController;
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

//for signing in...
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'handle'])->name('login');//handles login form

//for logout
Route::get('/logout', [LogoutController::class, 'show'])->name('logout');
Route::post('/logout', [LogoutController::class, 'handle'])->name('logout');//handles logging out


//for password confirmation
/**
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
 