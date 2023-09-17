<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ripple\ApiController;//api portion of Ripple service
use App\Http\Controllers\Api\AuthController;//for sanctum

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::prefix('')->group(function () {
  /**
   * admin_id here is the id of the owner of the site making an api request to this service
   */
    Route::get('add-rippler',[ApiController::class,'create']);
    Route::get('add-url/{rippler_id}',[ApiController::class,'addUrl']);
    Route::get('get-encrypted-url',[ApiController::class,'getEncryptedUrl']);
    Route::get('send-ripple/{encrypted_url}',[ApiController::class,'sendRipple']);
});
?>
