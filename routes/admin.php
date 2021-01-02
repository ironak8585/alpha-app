<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

Route::middleware(['role:SUPER_ADMIN', 'permission:permissions_manage'])->group(function () {
    Route::resource('permissions', PermissionController::class);
});
Route::middleware(['role:SUPER_ADMIN|ADMIN', 'permission:roles_manage'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::post('/users/roles/add', [UserController::class, 'addRole'])->name('users.roles.add');
    Route::post('/users/{user}/roles/remove/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
});
Route::middleware(['role:SUPER_ADMIN|ADMIN', 'permission:users_manage'])->group(function () {
    Route::match(['get', 'post'], '/users/{user}/password', [UserController::class, 'adminPassword'])->name('users.password');
    Route::resource('users', UserController::class);
});
