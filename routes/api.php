<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'show']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/experiences', [ExperienceController::class, 'index']);
Route::get('/certificates', [CertificateController::class, 'index']);
Route::get('/stats', StatsController::class);

Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:contact');

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::patch('/profile', [ProfileController::class, 'update']);

    Route::post('/projects', [ProjectController::class, 'store']);
    Route::patch('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

    Route::get('/contact-messages', [ContactController::class, 'index']);
    Route::patch('/contact-messages/{message}/read', [ContactController::class, 'markAsRead']);
});