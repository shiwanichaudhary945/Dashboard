<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontendController;

// Route::get("/login",[\App\Http\Controllers\API\FrontendController::class,'getData']);

Route::post("/login",[\App\Http\Controllers\API\FrontendController::class,'login']);
Route::post("/register",[\App\Http\Controllers\API\FrontendController::class,'register']);
