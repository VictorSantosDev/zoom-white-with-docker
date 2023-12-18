<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminEstablishmentController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('login', [AdminAuthController::class, 'login'])->name('admin-auth-login');
            Route::middleware('auth:admin')->post('logout', [AdminAuthController::class, 'logout'])->name('admin-auth-logout');
            Route::middleware('auth:admin')->post('refresh', [AdminAuthController::class, 'refresh'])->name('admin-auth-refresh');
            Route::middleware('auth:admin')->post('me', [AdminAuthController::class, 'me'])->name('admin-auth-me');
        });

        Route::prefix('user')->middleware('auth:admin')->group(function () {
            Route::post('create', [AdminUserController::class, 'createAction'])->name('admin-user-create');
            Route::put('update', [AdminUserController::class, 'updateAction'])->name('admin-user-update');
            Route::get('list', [AdminUserController::class, 'listAction'])->name('admin-user-list');
            Route::get('show/{id}', [AdminUserController::class, 'showAction'])->name('admin-user-show');
            Route::delete('delete/{id}', [AdminUserController::class, 'deleteAction'])->name('admin-user-delete');
        });

        Route::prefix('establishment')->middleware('auth:admin')->group(function () {
            Route::post('create', [AdminEstablishmentController::class, 'createAction'])->name('admin-establishment-create');
            Route::put('update', [AdminEstablishmentController::class, 'updateAction'])->name('admin-establishment-update');
            Route::get('list-by-user', [AdminEstablishmentController::class, 'listByUserAction'])->name('admin-establishment-list-by-user');
            Route::get('/show/{id}', [AdminEstablishmentController::class, 'showAction'])->name('admin-establishment-show');
            Route::delete('/delete/{id}', [AdminEstablishmentController::class, 'deleteAction'])->name('admin-establishment-delete');
        });
    });
});
