<?php

use App\Http\Controllers\FoodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/foods', [FoodController::class, 'store']);

Route::get('/foods', [FoodController::class, 'index']);
