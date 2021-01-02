<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\ConfigurationController;
use App\Http\Controllers\Master\CategoryController;

/**
 * Categories
 */
Route::middleware(['permission:master_categories_write'])->group(function () {
    Route::resource('categories', CategoryController::class)->except(['index', 'show']);
});
Route::middleware(['permission:master_categories_read|master_categories_write'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
});

/**
 * Configurations
 */
Route::middleware(['permission:master_configurations_write'])->group(function () {
    Route::resource('configurations', ConfigurationController::class)->except(['index', 'show']);
});
Route::middleware(['permission:master_configurations_read|master_configurations_write'])->group(function () {
    Route::resource('configurations', ConfigurationController::class)->only(['index', 'show']);
});
