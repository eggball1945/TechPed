<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\AuthController;

// PAGES
Route::get('/', function () { return view('user.landing'); });
Route::get('/landing', function () { return view('user.landing'); });
Route::get('/kontak', function () { return view('user.kontak.index'); });
Route::get('/tentang', function () { return view('user.tentang.index'); });
Route::get('/keranjang', function () { return view('user.cart.index'); });

// AUTH USERS
Route::get('/login', [AuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [AuthController::class, 'login'])->name('user.login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [AuthController::class, 'register'])->name('user.register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

