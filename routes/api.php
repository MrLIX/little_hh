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

Route::post('/v1/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], __DIR__ . '/api/auth.php');
    Route::group(['prefix' => 'vacancies'], __DIR__ . '/api/vacancies.php');
    Route::group(['prefix' => 'applicants'], __DIR__ . '/api/applicants.php');
    Route::group(['prefix' => 'admin'], __DIR__ . '/api/admin.php');
});
