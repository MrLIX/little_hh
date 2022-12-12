<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('vacancies', [AdminController::class, 'vacancies']);
Route::get('cvs', [AdminController::class, 'cvs']);
