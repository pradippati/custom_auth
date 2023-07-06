<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authenticationController;
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

Route::get('/', function () {
    return view('register');
});
Route::post('/register', [authenticationController::class, 'register'])->name('register');
Route::get('/login', [authenticationController::class, 'login'])->name('login');
Route::post('/loginaccess', [authenticationController::class, 'loginaccess'])->name('loginaccess');

Route::get('/dashboard', [authenticationController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [authenticationController::class, 'logout'])->name('logout');

Route::get('/verify-email/{token}', [authenticationController::class, 'verifyEmail'])->name('verify-email');