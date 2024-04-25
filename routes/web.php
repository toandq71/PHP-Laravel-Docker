<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleManagementController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'check-route-permission-admin'])->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

    Route::resource('role-management', RoleManagementController::class);
    Route::post('/role-management/{role:id}', [RoleManagementController::class, 'update'])->name('role-management.update');

    Route::resource('admin-management', AdminManagementController::class);
    Route::post('/admin-management/{admin:id}', [AdminManagementController::class, 'update'])->name('admin-management.update');


});

require __DIR__.'/auth.php';
