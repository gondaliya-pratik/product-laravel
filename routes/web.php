<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
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
    return view('login');
});



Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/login', [AuthController::class, 'authentication'])->name('auth.login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/store', [AuthController::class, 'store'])->name('auth.store');

Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('customer.dashboard');
	Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
	Route::resource('product', ProductsController::class);
});