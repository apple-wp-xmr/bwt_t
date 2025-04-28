<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Weather endpoint
    Route::get('weather', [WeatherController::class, 'today']);

    // Feedback endpoints
    Route::post('feedback', [FeedbackController::class, 'store']);
    Route::get('feedback', [FeedbackController::class, 'index']);

    // Optional: logout
    Route::post('logout', [AuthController::class, 'logout']);
});

// Fallback for undefined API routes
Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
});
