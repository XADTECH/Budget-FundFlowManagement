<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\PlannedCashController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [Analytics::class, 'index'])->name('home');
    Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
    Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

    // pages
    Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
        'pages-account-settings-account'
    );
    Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
        'pages-account-settings-notifications'
    );
    Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
        'pages-account-settings-connections'
    );
    Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
    Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
        'pages-misc-under-maintenance'
    );

    //cash flow management pages
    Route::get('/pages/add-opening-balance', [PlannedCashController::class, 'addBalance'])->name('add-opening-balance');
    Route::get('/pages/add-bank-detail', [BankController::class, 'addBankView'])->name('add-opening-balance');
    Route::get('/pages/allocate-cash', [PlannedCashController::class, 'allocateCash'])->name('allocate-cash');
    Route::get('/pages/cash-receive-amount', [PlannedCashController::class, 'cashreceiveAmount'])->name(
        'cash-receive-amount'
    );
    Route::get('/pages/plan-cash-report', [PlannedCashController::class, 'plancashReport'])->name('plan-cash-report');

    //project management
    Route::get('/pages/add-project-name', [ProjectController::class, 'showaddProjectView'])->name('add-project-name');
    Route::get('/pages/add-business-unit', [ProjectController::class, 'showaddBusinessUnit'])->name('add-business-unit');
    Route::get('/pages/add-business-client', [ProjectController::class, 'showaddBusinessClient'])->name(
        'add-business-client'
    );

    // Budget Managment
    Route::get('/pages/add-project-budget', [BudgetController::class, 'index'])->name('add-project-budget');
    Route::post('/pages/add-project-budget', [BudgetController::class, 'store'])->name('add-project-budget');
    Route::post('/pages/edit-project-budget', [BudgetController::class, 'edit'])->name('edit-project-budget');

    // authentication
    //Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
    Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

    // cards

    //user management
    Route::get('/pages/add-user', [UserController::class, 'index'])->name('add-user');

    // Add other routes that require authentication here
});
