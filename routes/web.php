<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController
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
