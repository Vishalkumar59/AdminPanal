<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Qrcode\Http\Controllers\QrController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as'=> 'api.', 'prefix' => 'api'],function (){

Route::get('/webhook',[QrController::class,'getWebhook']);
Route::post('/webhook',[QrController::class,'postWebhook']);
// Route::get('/webhook1',[QrController::class,'webhook1'])->middleware('api_token');


});



// Route::get('/webhook',[APIController::class,'webhook'])->name('webhook');



