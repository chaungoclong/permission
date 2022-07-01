<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware('auth');

// Permisisions
Route::resource('permissions', PermissionController::class)->middleware('authorize');

// Roles
Route::resource('roles', RoleController::class);

// Register
Route::group([
    'prefix' => 'register',
    'as' => 'register.',
    'middleware' => ['guest']
], function () {
    Route::get('', [RegisterController::class, 'showRegisterForm'])
        ->name('form');

    Route::post('', [RegisterController::class, 'register'])
        ->name('process');
});

// login
Route::group([
    'prefix' => 'login',
    'as' => 'login.',
    'middleware' => ['guest']
], function () {
    Route::get('', [LoginController::class, 'showLoginForm'])
        ->name('form');

    Route::post('', [LoginController::class, 'login'])
        ->name('process');
});

// User
Route::resource('users', UserController::class);

Route::get('test', function() {
    dd(\Auth::user()->role->permissions);
});
