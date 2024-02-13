<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BarController;
use App\Http\Controllers\Api\ModController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CourtController;
use App\Http\Controllers\Api\JudgeController;
use App\Http\Controllers\Api\WitnessController;
use App\Http\Controllers\Api\AttorneyController;
use App\Http\Controllers\Api\DecisionController;
use App\Http\Controllers\Api\RegistrarController;
use App\Http\Controllers\Api\CourtBarsController;
use App\Http\Controllers\Api\CaseChargeController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\CourtJudgesController;
use App\Http\Controllers\Api\ModEmployeeController;
use App\Http\Controllers\Api\CaseHearingController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ModDecisionsController;
use App\Http\Controllers\Api\RegistrarUsersController;
use App\Http\Controllers\Api\CourtAttorneysController;
use App\Http\Controllers\Api\ModCaseChargesController;
use App\Http\Controllers\Api\CourtRegistrarsController;
use App\Http\Controllers\Api\ModModEmployeesController;
use App\Http\Controllers\Api\ModCaseHearingsController;
use App\Http\Controllers\Api\ModAppointmentsController;
use App\Http\Controllers\Api\CourtCaseHearingsController;
use App\Http\Controllers\Api\JudgeCaseHearingsController;
use App\Http\Controllers\Api\WitnessCaseHearingsController;
use App\Http\Controllers\Api\RegistrarCaseChargesController;
use App\Http\Controllers\Api\AttorneyCaseHearingsController;
use App\Http\Controllers\Api\CaseHearingDecisionsController;
use App\Http\Controllers\Api\ModEmployeeCaseChargesController;
use App\Http\Controllers\Api\CaseHearingAppointmentsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('registrars', RegistrarController::class);

        // Registrar Users
        Route::get('/registrars/{registrar}/users', [
            RegistrarUsersController::class,
            'index',
        ])->name('registrars.users.index');
        Route::post('/registrars/{registrar}/users', [
            RegistrarUsersController::class,
            'store',
        ])->name('registrars.users.store');

        // Registrar Case Charges
        Route::get('/registrars/{registrar}/case-charges', [
            RegistrarCaseChargesController::class,
            'index',
        ])->name('registrars.case-charges.index');
        Route::post('/registrars/{registrar}/case-charges', [
            RegistrarCaseChargesController::class,
            'store',
        ])->name('registrars.case-charges.store');

        Route::apiResource('users', UserController::class);

        Route::apiResource('courts', CourtController::class);

        // Court Registrars
        Route::get('/courts/{court}/registrars', [
            CourtRegistrarsController::class,
            'index',
        ])->name('courts.registrars.index');
        Route::post('/courts/{court}/registrars', [
            CourtRegistrarsController::class,
            'store',
        ])->name('courts.registrars.store');

        // Court Attorneys
        Route::get('/courts/{court}/attorneys', [
            CourtAttorneysController::class,
            'index',
        ])->name('courts.attorneys.index');
        Route::post('/courts/{court}/attorneys', [
            CourtAttorneysController::class,
            'store',
        ])->name('courts.attorneys.store');

        // Court Judges
        Route::get('/courts/{court}/judges', [
            CourtJudgesController::class,
            'index',
        ])->name('courts.judges.index');
        Route::post('/courts/{court}/judges', [
            CourtJudgesController::class,
            'store',
        ])->name('courts.judges.store');

        // Court Bars
        Route::get('/courts/{court}/bars', [
            CourtBarsController::class,
            'index',
        ])->name('courts.bars.index');
        Route::post('/courts/{court}/bars', [
            CourtBarsController::class,
            'store',
        ])->name('courts.bars.store');

        // Court Case Hearings
        Route::get('/courts/{court}/case-hearings', [
            CourtCaseHearingsController::class,
            'index',
        ])->name('courts.case-hearings.index');
        Route::post('/courts/{court}/case-hearings', [
            CourtCaseHearingsController::class,
            'store',
        ])->name('courts.case-hearings.store');

        Route::apiResource('attorneys', AttorneyController::class);

        // Attorney Case Hearings
        Route::get('/attorneys/{attorney}/case-hearings', [
            AttorneyCaseHearingsController::class,
            'index',
        ])->name('attorneys.case-hearings.index');
        Route::post('/attorneys/{attorney}/case-hearings', [
            AttorneyCaseHearingsController::class,
            'store',
        ])->name('attorneys.case-hearings.store');

        Route::apiResource('judges', JudgeController::class);

        // Judge Case Hearings
        Route::get('/judges/{judge}/case-hearings', [
            JudgeCaseHearingsController::class,
            'index',
        ])->name('judges.case-hearings.index');
        Route::post('/judges/{judge}/case-hearings', [
            JudgeCaseHearingsController::class,
            'store',
        ])->name('judges.case-hearings.store');

        Route::apiResource('bars', BarController::class);

        Route::apiResource('mods', ModController::class);

        // Mod Case Charges
        Route::get('/mods/{mod}/case-charges', [
            ModCaseChargesController::class,
            'index',
        ])->name('mods.case-charges.index');
        Route::post('/mods/{mod}/case-charges', [
            ModCaseChargesController::class,
            'store',
        ])->name('mods.case-charges.store');

        // Mod Mod Employees
        Route::get('/mods/{mod}/mod-employees', [
            ModModEmployeesController::class,
            'index',
        ])->name('mods.mod-employees.index');
        Route::post('/mods/{mod}/mod-employees', [
            ModModEmployeesController::class,
            'store',
        ])->name('mods.mod-employees.store');

        // Mod Case Hearings
        Route::get('/mods/{mod}/case-hearings', [
            ModCaseHearingsController::class,
            'index',
        ])->name('mods.case-hearings.index');
        Route::post('/mods/{mod}/case-hearings', [
            ModCaseHearingsController::class,
            'store',
        ])->name('mods.case-hearings.store');

        // Mod Appointments
        Route::get('/mods/{mod}/appointments', [
            ModAppointmentsController::class,
            'index',
        ])->name('mods.appointments.index');
        Route::post('/mods/{mod}/appointments', [
            ModAppointmentsController::class,
            'store',
        ])->name('mods.appointments.store');

        // Mod Decisions
        Route::get('/mods/{mod}/decisions', [
            ModDecisionsController::class,
            'index',
        ])->name('mods.decisions.index');
        Route::post('/mods/{mod}/decisions', [
            ModDecisionsController::class,
            'store',
        ])->name('mods.decisions.store');

        Route::apiResource('case-charges', CaseChargeController::class);

        Route::apiResource('mod-employees', ModEmployeeController::class);

        // ModEmployee Case Charges
        Route::get('/mod-employees/{modEmployee}/case-charges', [
            ModEmployeeCaseChargesController::class,
            'index',
        ])->name('mod-employees.case-charges.index');
        Route::post('/mod-employees/{modEmployee}/case-charges', [
            ModEmployeeCaseChargesController::class,
            'store',
        ])->name('mod-employees.case-charges.store');

        Route::apiResource('case-hearings', CaseHearingController::class);

        // CaseHearing Appointments
        Route::get('/case-hearings/{caseHearing}/appointments', [
            CaseHearingAppointmentsController::class,
            'index',
        ])->name('case-hearings.appointments.index');
        Route::post('/case-hearings/{caseHearing}/appointments', [
            CaseHearingAppointmentsController::class,
            'store',
        ])->name('case-hearings.appointments.store');

        // CaseHearing Decisions
        Route::get('/case-hearings/{caseHearing}/decisions', [
            CaseHearingDecisionsController::class,
            'index',
        ])->name('case-hearings.decisions.index');
        Route::post('/case-hearings/{caseHearing}/decisions', [
            CaseHearingDecisionsController::class,
            'store',
        ])->name('case-hearings.decisions.store');

        Route::apiResource('witnesses', WitnessController::class);

        // Witness Case Hearings
        Route::get('/witnesses/{witness}/case-hearings', [
            WitnessCaseHearingsController::class,
            'index',
        ])->name('witnesses.case-hearings.index');
        Route::post('/witnesses/{witness}/case-hearings', [
            WitnessCaseHearingsController::class,
            'store',
        ])->name('witnesses.case-hearings.store');

        Route::apiResource('appointments', AppointmentController::class);

        Route::apiResource('decisions', DecisionController::class);
    });
