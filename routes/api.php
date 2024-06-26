<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCouponsController;
use App\Http\Controllers\Admin\AdminEstablishmentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Employee\EmployeeAuthController;
use App\Http\Controllers\Employee\EmployeeWashingVehicleController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserCompanyController;
use App\Http\Controllers\User\UserEstablishmentController;
use App\Http\Controllers\User\UserParkingPriceController;
use App\Http\Controllers\User\UserPasswordController;
use App\Http\Controllers\User\UserServiceController;
use App\Http\Controllers\User\UserVehicleController;
use App\Http\Controllers\User\UserWashingController;

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

        Route::prefix('coupons')->middleware('auth:admin')->group(function () {
            Route::post('create', [AdminCouponsController::class, 'createAction'])->name('admin-coupons-create');
            Route::put('update', [AdminCouponsController::class, 'updateAction'])->name('admin-coupons-update');
            Route::put('enable-or-disable', [AdminCouponsController::class, 'enableOrDisableAction'])->name('admin-coupons-enable-or-disable');
            Route::get('/show/{id}', [AdminCouponsController::class, 'showAction'])->name('admin-coupons-show');
        });
    });

    Route::prefix('user')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('login', [UserAuthController::class, 'login'])->name('users-auth-login');
            Route::middleware('auth:users')->post('logout', [UserAuthController::class, 'logout'])->name('users-auth-logout');
            Route::middleware('auth:users')->post('refresh', [UserAuthController::class, 'refresh'])->name('users-auth-refresh');
            Route::middleware('auth:users')->post('me', [UserAuthController::class, 'me'])->name('users-auth-me');
        });

        Route::prefix('password')->group(function () {
            Route::post('new', [UserPasswordController::class, 'newPasswordAction'])->name('new-password');
            Route::post('forgot', [UserPasswordController::class, 'forgotPasswordAction'])->name('forgot-password');

            Route::post('new-logged', [UserPasswordController::class, 'newPasswordLoggedAction'])->middleware('auth:users')->name('new-logged-password');
        });

        Route::prefix('establishment')->middleware('auth:users')->group(function () {
            Route::get('list-establishment-user', [UserEstablishmentController::class, 'listEstablishmentAction'])->name('ist-establishment-user');
        });

        Route::prefix('category')->middleware('auth:users')->group(function () {
            Route::post('create', [UserCategoryController::class, 'createAction'])->name('user-category-create');
            Route::put('update', [UserCategoryController::class, 'updateAction'])->name('user-category-update');
            Route::get('show/{id}', [UserCategoryController::class, 'showAction'])->name('user-category-show');
            Route::get('list', [UserCategoryController::class, 'listAction'])->name('user-category-list');
            Route::delete('delete/{id}', [UserCategoryController::class, 'deleteAction'])->name('user-category-delete');
        });

        Route::prefix('service')->middleware('auth:users')->group(function () {
            Route::post('create', [UserServiceController::class, 'createAction'])->name('user-service-create');
            Route::get('show/{id}', [UserServiceController::class, 'showAction'])->name('user-service-show');
            Route::get('list', [UserServiceController::class, 'listAction'])->name('user-service-list');
            Route::delete('delete/{id}', [UserServiceController::class, 'deleteAction'])->name('user-service-delete');
        });

        /** @not used route washing discontinued */
        Route::prefix('washing')->middleware('auth:users')->group(function () {
            Route::post('create', [UserWashingController::class, 'createAction'])->name('user-washing-create');
            Route::get('show/{id}', [UserWashingController::class, 'showAction'])->name('user-washing-show');
            Route::get('list', [UserWashingController::class, 'listAction'])->name('user-washing-list');
            Route::delete('delete/{id}', [UserWashingController::class, 'deleteAction'])->name('user-washing-delete');
        });

        Route::prefix('parking-price')->middleware('auth:users')->group(function () {
            Route::post('create', [UserParkingPriceController::class, 'createParkingPriceAction'])->name('user-parking-create-price');
            Route::put('update', [UserParkingPriceController::class, 'updateParkingPriceAction'])->name('user-parking-update-price');
            Route::get('show/{id}', [UserParkingPriceController::class, 'showParkingPriceAction'])->name('user-parking-show-price');
        });

        /** @todo update, show, list, delete for company */
        Route::prefix('company')->middleware('auth:users')->group(function () {
            Route::post('create', [UserCompanyController::class, 'createAction'])->name('user-company-create');
            Route::put('update', [UserCompanyController::class, 'updateAction'])->name('user-company-update');
            Route::get('show/{id}', [UserCompanyController::class, 'showAction'])->name('user-company-show');
            Route::get('list', [UserCompanyController::class, 'listAction'])->name('user-company-list');
            Route::delete('delete/{id}', [UserCompanyController::class, 'deleteAction'])->name('user-company-delete');
        });

        Route::prefix('vehicle')->middleware('auth:users')->group(function () {
            Route::post('create', [UserVehicleController::class, 'createAction'])->name('user-vehicle-create');
            Route::put('update', [UserVehicleController::class, 'updateAction'])->name('user-vehicle-update');
            Route::get('show/{id}', [UserVehicleController::class, 'showAction'])->name('user-vehicle-show');
            Route::get('show/full/{id}', [UserVehicleController::class, 'showFullAction'])->name('user-vehicle-show-full');
            Route::get('list', [UserVehicleController::class, 'listAction'])->name('user-vehicle-list');
            Route::delete('/delete/{id}', [UserVehicleController::class, 'deleteAction'])->name('user-vehicle-delete');
        });
    });

    /** @not used route employee discontinued */
    Route::prefix('employee')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('login', [EmployeeAuthController::class, 'login'])->name('employee-auth-login');
            Route::middleware('auth:employee')->post('logout', [EmployeeAuthController::class, 'logout'])->name('employee-auth-logout');
            Route::middleware('auth:employee')->post('refresh', [EmployeeAuthController::class, 'refresh'])->name('employee-auth-refresh');
            Route::middleware('auth:employee')->post('me', [EmployeeAuthController::class, 'me'])->name('employee-auth-me');
        });

        Route::prefix('washing-vehicle')->middleware('auth:employee')->group(function () {
            Route::post('create', [EmployeeWashingVehicleController::class, 'createAction'])->name('employee-washing-vehicle-create');
            Route::put('update', [EmployeeWashingVehicleController::class, 'updateAction'])->name('employee-washing-vehicle-update');
            Route::get('show/{id}', [EmployeeWashingVehicleController::class, 'showAction'])->name('employee-washing-vehicle-show');
            Route::get('list', [EmployeeWashingVehicleController::class, 'listAction'])->name('employee-washing-vehicle-list');
            Route::delete('/delete/{id}', [EmployeeWashingVehicleController::class, 'deleteAction'])->name('employee-washing-vehicle-delete');
        });
    });
});
