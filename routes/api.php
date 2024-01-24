<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarsController;

Route::get('test', fn () => [1, 2, 3]);

Route::apiResource('cars', CarsController::class);
