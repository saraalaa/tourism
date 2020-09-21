<?php

use App\Http\Controllers\Api\V1\OfferController;
use App\Http\Controllers\Api\V1\TokenController;
use Illuminate\Validation\Rule;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')
    ->resource('offers', OfferController::class)->except('destroy');

Route::post('/token/create', [TokenController::class, 'create']);