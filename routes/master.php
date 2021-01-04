<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\ConfigurationController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\CountryController;
use App\Http\Controllers\Master\DiamondShapeController;
use App\Http\Controllers\Master\DiamondColorController;
use App\Http\Controllers\Master\DiamondColorIntensityController;

/**
 * Diamond Colors Intensity
 */
Route::middleware(['permission:master_diamond_color_intensities_write'])->group(function () {
    Route::resource('intensities', DiamondColorIntensityController::class)->except(['index', 'show']);
});
Route::middleware(['permission:master_diamond_color_intensities_read|master_diamond_color_intensities_write'])->group(function () {
    Route::resource('intensities', DiamondColorIntensityController::class)->only(['index', 'show']);
});

/**
 * Diamond Colors
 */
Route::middleware(['permission:master_diamond_colors_write'])->group(function () {
    Route::resource('colors', DiamondColorController::class)->except(['index', 'show']);
});
Route::middleware(['permission:master_diamond_colors_read|master_diamond_colors_write'])->group(function () {
    Route::resource('colors', DiamondColorController::class)->only(['index', 'show']);
});

/**
 * Diamond Shapes
 */
Route::middleware(['permission:master_diamond_shapes_write'])->group(function () {
    Route::resource('shapes', DiamondShapeController::class)->except(['index', 'show']);
});
Route::middleware(['permission:master_diamond_shapes_read|master_diamond_shapes_write'])->group(function () {
    Route::resource('shapes', DiamondShapeController::class)->only(['index', 'show']);
});

/**
 * Countries
 */
Route::middleware(['permission:master_countries_write'])->group(function () {

    //import export
    Route::post('countries/export', [CountryController::class, 'export'])->name('countries.export');
    Route::match(['get', 'post'], 'countries/import', [CountryController::class, 'import'])->name('countries.import');

    Route::resource('countries', CountryController::class)->except(['index', 'show']);
});
Route::middleware(['permission:master_countries_read|master_countries_write'])->group(function () {
    Route::resource('countries', CountryController::class)->only(['index', 'show']);
});

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
