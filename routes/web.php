<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'showAdminLogin'])->name('admin.login_form');
Route::post('/admin/login', [App\Http\Controllers\AuthController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.create_user');
    Route::post('/users/create', [AdminController::class, 'storeUser'])->name('admin.store_user');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit_user');
    Route::post('/users/{id}/edit', [AdminController::class, 'updateUser'])->name('admin.update_user');
    Route::post('/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.delete_user');
    Route::get('/lokasi', [AdminController::class, 'lokasi'])->name('admin.lokasi');
    Route::post('/lokasi', [AdminController::class, 'updateLokasi'])->name('admin.update_lokasi');

    // Manajemen Absen
    Route::get('/absen', [AdminController::class, 'absen'])->name('admin.absen');
    Route::get('/absen/create', [AdminController::class, 'createAbsen'])->name('admin.absen_create');
    Route::post('/absen/create', [AdminController::class, 'storeAbsen'])->name('admin.absen_store');
    Route::get('/absen/{id}/edit', [AdminController::class, 'editAbsen'])->name('admin.absen_edit');
    Route::post('/absen/{id}/edit', [AdminController::class, 'updateAbsen'])->name('admin.absen_update');
    Route::post('/absen/{id}/delete', [AdminController::class, 'deleteAbsen'])->name('admin.absen_delete');
});
