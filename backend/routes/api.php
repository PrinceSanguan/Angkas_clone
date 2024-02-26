<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DriverController;

Route::post('/login', [LoginController::class, 'submit']);
Route::post('/login/verify', [LoginController::class, 'verify']);


Route::group(['middleware' => 'auth:sanctum'], function () {

  Route::get('/driver', [DriverController::class, 'show']);
  Route::post('/driver', [DriverController::class, 'update']);

  Route::get('/user', function(Request $request) {
    return $request->user();
  });
});


