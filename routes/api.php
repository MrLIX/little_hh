<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'vacancies', 'middleware' => 'role:' . User::TYPE_EMPLOYER], __DIR__ . '/api/vacancies.php');
    Route::group(['prefix' => 'resume', 'middleware' => 'role:' . User::TYPE_APPLICANT], __DIR__ . '/api/resumes.php');
});
