<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarController;
use App\Http\Controllers\ModController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\WitnessController;
use App\Http\Controllers\AttorneyController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\CaseChargeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ModEmployeeController;
use App\Http\Controllers\CaseHearingController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('registrars', RegistrarController::class);
        Route::resource('users', UserController::class);
        Route::resource('courts', CourtController::class);
        Route::resource('attorneys', AttorneyController::class);
        Route::resource('judges', JudgeController::class);
        Route::resource('bars', BarController::class);
        Route::resource('mods', ModController::class);
        Route::resource('case-charges', CaseChargeController::class);
        Route::resource('mod-employees', ModEmployeeController::class);
        Route::resource('case-hearings', CaseHearingController::class);
        Route::resource('witnesses', WitnessController::class);
        Route::resource('appointments', AppointmentController::class);
        Route::resource('decisions', DecisionController::class);
    });
