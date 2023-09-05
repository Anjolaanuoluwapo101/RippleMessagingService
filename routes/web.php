<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

//for registration
Route::get('/', [RegisterController::class, 'show'])->name('register'); 
Route::post('/register', [RegisterController::class, 'handle'])->name('register');//handles registration form

//for signing in...
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'handle'])->name('login');//handles login form

