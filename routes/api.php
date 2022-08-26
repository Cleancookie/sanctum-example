<?php

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

/**
 * First post to this url with body like { "token_name": "yerd" }
 */
Route::post('/tokens/create', function (Request $request) {
    $user = App\Models\User::first();
    auth()->login($user);
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

/**
 * And then get request here with bearer token
 */
Route::get('/me', function () {
    return auth()->user();
})->middleware('auth:sanctum');
