<?php

use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::get('', [VacancyController::class, 'index']);
Route::get('/{vacancy}', [VacancyController::class, 'view']);
Route::get('/responds/{vacancy}', [VacancyController::class, 'responds']);
Route::post('', [VacancyController::class, 'create']);
Route::put('/{vacancy}', [VacancyController::class, 'update']);
Route::delete('/{vacancy}', [VacancyController::class, 'delete']);
