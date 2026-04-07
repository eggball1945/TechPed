<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\FlashSaleController;
use App\Http\Controllers\user\AddressController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\user\UserProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ProductController as AdminProductController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Order\Controller;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StrukController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\petugas\AuthController as PetugasAuthController;
use App\Http\Controllers\petugas\DashboardController as PetugasDashboardController;

Route::get('/', [FlashSaleController::class, 'index'])->name('landing');
Route::get('/kontak', fn() => view('user.kontak.index'))->name('kontak');
Route::post('/kontak', [App\Http\Controllers\ContactController::class, 'store'])->name('kontak.store');
Route::get('/tentang', [App\Http\Controllers\user\AboutController::class, 'index'])->name('tentang');
Route::get('/privacy-policy', fn() => view('user.privacy'))->name('privacy');
Route::get('/terms-of-use', fn() => view('user.terms'))->name('terms');
Route::get('/faq', fn() => view('user.faq'))->name('faq');

Route::prefix('products')->group(function () {
    Route::get('/', [UserProductController::class, 'index'])->name('user.products');
    Route::get('/terlaris', [UserProductController::class, 'terlaris'])->name('user.terlaris');
    Route::get('/{product}', [UserProductController::class, 'show'])
        ->whereNumber('product')
        ->name('user.products.show');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [AuthController::class, 'login'])->name('user.login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [AuthController::class, 'register'])->name('user.register.submit');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('user.password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetCode'])->name('user.password.email');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('user.password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('user.password.update');

Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/delete-selected', [CartController::class, 'deleteSelected'])->name('cart.delete-selected');
    Route::patch('/cart/{cart}/{type}', [CartController::class, 'updateQty'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/receipt/{order}', [CheckoutController::class, 'receipt'])->name('checkout.receipt');
    Route::post('/cart/quick-checkout', [CheckoutController::class, 'quickCheckout'])->name('cart.quick-checkout');

    // User profile
    Route::get('/akun', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/akun', [ProfileController::class, 'update'])->name('profile.update');

    // Orders & addresses (placeholders)
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders');
    Route::resource('alamat', AddressController::class)->except(['show'])->names([
        'index' => 'addresses',
        'store' => 'addresses.store',
        'update' => 'addresses.update',
        'destroy' => 'addresses.destroy',
    ]);
    Route::post('/pesanan/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/pesanan/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::delete('/pesanan/{order}', [OrderController::class, 'userDestroy'])->name('orders.destroy');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::delete('/notifications/{notification}', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();
        return response()->json(['success' => true]);
    })->name('notifications.destroy');

    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.read-all');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
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
        Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
        Route::post('/products', [AdminProductController::class, 'store'])->name('product.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('product.update');
        Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('product.destroy');

        // ORDER
        Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::post('/orders/{order}/send', [OrderController::class, 'send'])->name('order.send');
        Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('order.complete');
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
        Route::get('/admin/reviews', [ReviewController::class, 'index']);
        Route::delete('/admin/reviews/destroy-all', [ReviewController::class, 'destroyAll'])->name('review.destroyAll');
        Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

        // PROMO
        Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
        Route::post('/promo', [PromoController::class, 'store'])->name('promo.store');
        Route::put('/promo/{id}', [PromoController::class, 'update'])->name('promo.update');
        Route::delete('/promo/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');

        // STRUK
        Route::get('/struk', [StrukController::class, 'index'])->name('struk.index');
        Route::get('/struk/{order}/cetak', [StrukController::class, 'cetak'])->name('struk.cetak');
        Route::post('/struk/{order}/kirim', [StrukController::class, 'kirim'])->name('struk.kirim');
        Route::post('/orders/{order}/update-status', [StrukController::class, 'updateStatus'])->name('orders.update-status');

        // SETTING
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/setting/petugas', [SettingController::class, 'storePetugas'])->name('setting.petugas.store');
        Route::put('/setting/petugas/{id}', [SettingController::class, 'updatePetugas'])->name('setting.petugas.update');
        Route::delete('/setting/petugas/{id}', [SettingController::class, 'destroyPetugas'])->name('setting.petugas.destroy');
        Route::post('/setting/umum', [SettingController::class, 'updateUmum'])->name('setting.umum.update');
        Route::post('/setting/pembayaran', [SettingController::class, 'updatePembayaran'])->name('setting.pembayaran.update');

        // CONTACT MESSAGES
        Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{id}', [App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
        Route::delete('/contact/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');

        // BACKUP & RESTORE
        Route::get('/backup', [\App\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
        Route::get('/backup/download', [\App\Http\Controllers\BackupController::class, 'backup'])->name('backup.download');
        Route::post('/restore', [\App\Http\Controllers\BackupController::class, 'restore'])->name('backup.restore');

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

        Route::get('/orders/latest', [PetugasDashboardController::class, 'latestOrders'])->name('orders.latest');

        // PRODUCT
        Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
        Route::post('/products', [AdminProductController::class, 'store'])->name('product.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('product.update');
        Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('product.destroy');

        // ORDER
        Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::post('/orders/{order}/send', [OrderController::class, 'send'])->name('order.send');
        Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('order.complete');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('order.destroy');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
        Route::get('/reviews', [ReviewController::class, 'index'])->name('review.index');
        Route::delete('/reviews/destroy-all', [ReviewController::class, 'destroyAll'])->name('review.destroyAll');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
        
        // PROMO
        Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
        Route::post('/promo', [PromoController::class, 'store'])->name('promo.store');
        Route::put('/promo/{id}', [PromoController::class, 'update'])->name('promo.update');
        Route::delete('/promo/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');

        // STRUK
        Route::get('/struk', [StrukController::class, 'index'])->name('struk.index');
        Route::get('/struk/{order}/cetak', [StrukController::class, 'cetak'])->name('struk.cetak');
        Route::post('/struk/{order}/kirim', [StrukController::class, 'kirim'])->name('struk.kirim');
        Route::post('/orders/{order}/update-status', [StrukController::class, 'updateStatus'])->name('orders.update-status');

        // CONTACT MESSAGES
        Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{id}', [App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
        // BACKUP & RESTORE
        Route::get('/backup', [\App\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
        Route::get('/backup/download', [\App\Http\Controllers\BackupController::class, 'backup'])->name('backup.download');
        Route::post('/restore', [\App\Http\Controllers\BackupController::class, 'restore'])->name('backup.restore');

        Route::delete('/contact/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');

        Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');
    });
});