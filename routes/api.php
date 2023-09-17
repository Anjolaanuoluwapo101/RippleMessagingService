<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ripple\ApiController;
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

Route::prefix('')->group(function () {
  /**
   * admin_id here is the id of the owner of the site making an api request to this service
   */
    Route::get('add-rippler/{admin_id}',[ApiController::class,'create']);
    Route::get('add-url/{admin_id}/{rippler_id}',[ApiController::class,'addUrl']);
    Route::post('send-ripple/{admin_id}/{rippler_id}',[ApiController::class,'addRipple']);
});
?>
