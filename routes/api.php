<?php

use App\Http\Controllers;
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

Route::post('/sanctum/token', [Controllers\Api\Sanctum\TokenController::class, 'create']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {

    Route::name('message.')->prefix('message')->group(function () {

        Route::post('/send', [Controllers\MessagingController::class, 'messageGPT'])->name('send');

        Route::get('/all', [Controllers\MessagingController::class, 'getAll'])->name('get.all');

    });

    Route::name('read.status.')->prefix('status')->group(function () {

        Route::get('/all', [Controllers\Api\StatusController::class, 'getAll'])->name('get.all');
    });

    Route::name('conversation.')->prefix('conversation')->group(function () {

        Route::get('/all', [Controllers\Api\ConversationController::class, 'getAll'])->name('get.all');
    });

});

Route::middleware(['auth:sanctum', 'abilities:user-update'])->group(function () {
    Route::post('/user/update-adalo-id', [Controllers\Api\AdaloUserController::class, 'update'])->name('adalo.user.update');
});
