<?php

use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\SendMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/send-message', [SendMessageController::class, 'sendMessage']);
    Route::get('/get-chat-list', [SendMessageController::class, 'getChatList']);
    // Route::post('/send-message', [SendMessageController::class, 'sendMessage']);
});


Route::post('/update-device-status', [DeviceController::class, 'updateStatus']);