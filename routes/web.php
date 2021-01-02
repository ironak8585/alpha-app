<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomePageController::class, 'home']);
Route::get('/welcome', [HomePageController::class, 'welcome']);

Route::group(['middleware' => ['auth']], function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::match(['get', 'post'], '/users/password', [UserController::class, 'password'])->name('users.password');

    Route::prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));

    Route::prefix('master')
        ->name('master.')
        ->group(base_path('routes/master.php'));
});

require __DIR__ . '/auth.php';
