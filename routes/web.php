<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\FlashSaleController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\Order\Controller;
use App\Http\Controllers\petugas\AuthController as PetugasAuthController;
use App\Http\Controllers\petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\ProductController as PetugasProductController;

Route::get('/', [FlashSaleController::class, 'index'])->name('landing');
Route::get('/landing', [FlashSaleController::class, 'index']);

Route::get('/kontak', function () {
    return view('user.kontak.index');
});

Route::get('/tentang', function () {
    return view('user.tentang.index');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [AuthController::class, 'login'])->name('user.login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [AuthController::class, 'register'])->name('user.register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::patch('/cart/{cart}/{type}', [CartController::class, 'updateQty']);
    Route::delete('/cart/{cart}', [CartController::class, 'destroy']);

    Route::get('/akun', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/akun', [ProfileController::class, 'update'])->name('profile.update');
});

// ADMIN
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders/latest', [DashboardController::class, 'latestOrders']);

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.process');
    });

    Route::middleware('auth:admin')->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/search', [DashboardController::class, 'search'])->name('search');

        // PRODUCT
        Route::get('/products', [ProductController::class, 'index'])->name('product.index');
        Route::post('/products', [ProductController::class, 'store'])->name('product.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

        // ORDER
        Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::post('/orders/{order}/send', [OrderController::class, 'send'])->name('order.send');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
        Route::get('/orders/latest', [DashboardController::class, 'latestOrders'])->name('orders.latest');

        // USER
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{user}/suspend', [UserController::class, 'toggleSuspend'])->name('users.suspend');
        Route::delete('/users/{user}', [UserController::class, 'destroyUser'])->name('users.destroy');
        Route::delete('/petugas/{petugas}', [UserController::class, 'destroyPetugas'])->name('petugas.destroy');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
        Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('review.index');

        // CRUD PETUGAS
        // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        // Route::post('/users', [UserController::class, 'store'])->name('users.store');
        // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

        Route::get('/struk', [DashboardController::class, 'struk'])->name('struk');
        Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// PETUGAS
Route::prefix('petugas')->name('petugas.')->group(function () {

    Route::middleware('guest:petugas')->group(function () {
        Route::get('/login', [PetugasAuthController::class, 'showLogin'])->name('auth.index');
        Route::post('/login', [PetugasAuthController::class, 'login'])->name('auth.login');
    });

    Route::middleware('auth:petugas')->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');

        Route::get('/latest-orders', [PetugasDashboardController::class, 'latestOrders'])->name('latest-orders');

        // PRODUCT
        Route::get('/products', [ProductController::class, 'index'])->name('product.index');
        Route::post('/products', [ProductController::class, 'store'])->name('product.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

        // ORDER
        Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::post('/orders/{order}/send', [OrderController::class, 'send'])->name('order.send');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('order.destroy');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');

        Route::get('/struk', [DashboardController::class, 'struk'])->name('struk');

        Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');
    });
});