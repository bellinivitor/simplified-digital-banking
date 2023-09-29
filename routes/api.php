<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransferController;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/v1')->group(function () {

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::post('transfer/{sender}/{recipient}', [TransferController::class, 'store'])->name('transfer');
});

if (config('app.debug')) {
    Route::get('/test', fn() => 'Ok')
        ->withoutMiddleware(ThrottleRequests::class . ':api');
}
