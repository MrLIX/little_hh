<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::get('', [ResumeController::class, 'index']);
Route::get('/{resume}', [ResumeController::class, 'view']);
Route::get('/vacancies/{resume}', [ResumeController::class, 'vacancies']);
Route::get('/respond/{resume}', [ResumeController::class, 'respondVacancies']);
Route::post('', [ResumeController::class, 'create']);
Route::delete('/{resume}', [ResumeController::class, 'delete']);
Route::put('/{resume}', [ResumeController::class, 'update']);
