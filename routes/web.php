<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::post('/testimonios', [TestimonialController::class, 'store'])->middleware('throttle:3,1');
