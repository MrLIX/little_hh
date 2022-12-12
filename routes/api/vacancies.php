<?php

use App\Http\Controllers\VacanciesController;
use Illuminate\Support\Facades\Route;

Route::get('', [VacanciesController::class, 'index']);
Route::get('/{vacancy}', [VacanciesController::class, 'view']);
Route::get('/responds/{vacancy}', [VacanciesController::class, 'responds']);
Route::post('', [VacanciesController::class, 'create']);
Route::put('/{vacancy}', [VacanciesController::class, 'update']);
Route::delete('/{vacancy}', [VacanciesController::class, 'delete']);
