<?php

use App\Http\Controllers\ApplicantsController;
use Illuminate\Support\Facades\Route;

Route::get('', [ApplicantsController::class, 'index']);
Route::get('/{cv}', [ApplicantsController::class, 'view']);
Route::get('/vacancies/{cv}', [ApplicantsController::class, 'vacancies']);
Route::get('/vacancies/view/{vacancy}', [ApplicantsController::class, 'vacancyView']);
Route::get('/respond/{vacancy}', [ApplicantsController::class, 'respondVacancies']);
Route::post('', [ApplicantsController::class, 'create']);
Route::post('/respond/{vacancy}', [ApplicantsController::class, 'respondVacancy']);
Route::delete('/{cv}', [ApplicantsController::class, 'delete']);
Route::put('/{cv}', [ApplicantsController::class, 'update']);
