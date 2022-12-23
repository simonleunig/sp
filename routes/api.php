<?php

use App\Http\Controllers\Api\CallcenterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CallcenterController::class)->group(function () {
    Route::get('/get_all_contacts', 'get_all_contacts');
    Route::post('/create_contact', 'create_contact');
    Route::post('/delete_contact', 'delete_contact');
    Route::post('/update_contact', 'update_contact');
});
