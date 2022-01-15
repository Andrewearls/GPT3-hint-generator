<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::post('/sanctum/token', [Controllers\Api\Sanctum\TokenController::class, 'create']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::name('message.')->prefix('message')->group(function () {
        
        Route::post('/send', [Controllers\MessagingController::class, 'messageGPT'])->name('send');

        Route::get('/all', [Controllers\MessagingController::class, 'getAll'])->name('get.all');

    });
    
});