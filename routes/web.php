<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\UserController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/scan', [ToolController::class, 'scan'])->name('scan');

    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
    Route::get('/tools/{tool}', [ToolController::class, 'show'])->name('tools.show');

    Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index');
    Route::get('/borrow/new', [BorrowController::class, 'create'])->name('borrow.create');
    Route::get('/borrow/{borrowRequest}', [BorrowController::class, 'show'])->name('borrow.show');
    Route::post('/borrow/{borrowRequest}/action/{action}', [BorrowController::class, 'action'])->name('borrow.action');

    Route::get('/damage', [DamageController::class, 'index'])->name('damage.index');
    Route::get('/damage/new', [DamageController::class, 'create'])->name('damage.create');
    Route::get('/damage/{damageReport}', [DamageController::class, 'show'])->name('damage.show');
    Route::post('/damage/{damageReport}/action/{action}', [DamageController::class, 'action'])->name('damage.action');

    Route::get('/repairs', [RepairController::class, 'index'])->name('repairs.index');
    Route::get('/repairs/{repairJob}', [RepairController::class, 'show'])->name('repairs.show');
    Route::post('/repairs/{repairJob}/action/{action}', [RepairController::class, 'action'])->name('repairs.action');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/export/{type}', [ReportController::class, 'export'])->name('reports.export');

    Route::prefix('admin')->middleware('role:ADMIN_TRL')->group(function () {
        Route::get('/masters', [MasterController::class, 'index'])->name('admin.masters');
        Route::post('/masters/{type}', [MasterController::class, 'store'])->name('admin.masters.store');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    });
});

Route::redirect('/', '/dashboard');
