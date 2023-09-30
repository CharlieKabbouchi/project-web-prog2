<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/login-signup/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login-signup/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login-signup/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-signup/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
