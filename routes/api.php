<?php

use App\Http\Controllers\API\V1\CharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\API\V1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('characters', CharacterController::class);

    Route::post('characters/bulk', ['uses' => 'CharacterController@bulkStore']);
});