<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TransactionDetailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FrontEnd\CheckoutController;
use App\Http\Controllers\Frontend\LandingController;
use App\Http\Controllers\Frontend\ProductUserController;
use App\Http\Controllers\Frontend\PromoCodeUserController;
use App\Http\Controllers\Frontend\StoreController as FrontendStoreController;
use App\Http\Controllers\Frontend\TransactionUserController;
use App\Http\Controllers\Store\DashboardController as StoreDashboardController;
use App\Http\Middleware\StoreMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('store', StoreController::class);
    Route::resource('detail', TransactionDetailController::class)->except('create');
    Route::resource('promo', PromoCodeController::class)->except(['index', 'create']);
    Route::resource('product', ProductController::class)->except('create');
    Route::resource('transaction', TransactionController::class)->except(['create', 'show']);

    Route::get('product/{store:id}/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('store/{store:id}/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::get('transaction/{transaction:id}/resi', [TransactionController::class, 'show'])->name('transaction.resi.show');
    Route::put('store/{store:id}/transaction/{transaction:id}/resi/add', [TransactionController::class, 'addNoResi'])->name('transaction.resi.add');
    Route::get('store/{store:id}/promocodes', [PromoCodeController::class, 'getPromoCodeByStoreId'])->name('promo.index');
    Route::get('store/{store:id}/promocodes/create', [PromoCodeController::class, 'create'])->name('promo.create');
    Route::get('transaction/{transaction:id}/detail/create', [TransactionDetailController::class, 'create'])->name('detail.create');
});

Route::prefix('store')->name('store.')->middleware(StoreMiddleware::class)->group(function () {
    Route::get('/dashboard-toko', [StoreDashboardController::class, 'index'])->name('dashboard');

    Route::resource('promo', PromoCodeController::class)->except(['index', 'create', 'show']);
    Route::resource('codes', PromoCodeUserController::class)->except(['create', 'show', 'edit']);
    Route::resource('transaction', TransactionUserController::class)->except(['create', 'update', 'edit']);

    Route::resource('product', ProductUserController::class)->except(['create', 'show', 'edit']);

    Route::get('/{store:id}/codes/create', [PromoCodeUserController::class, 'create'])->name('codes.create');
    Route::get('/{store:id}/codes/{id}/edit', [PromoCodeUserController::class, 'edit'])->name('codes.edit');

    Route::put('/store/{store:id}/transaction/{transaction:id}/resi/add', [TransactionUserController::class, 'addNoResi'])->name('transaction.resi.create');
    Route::get('/{store:id}/transaction/create', [TransactionUserController::class, 'create'])->name('transaction.create');
    Route::get('/{store:id}/transaction/{transaction:id}/edit', [TransactionUserController::class, 'edit'])->name('transaction.edit');

    Route::get('/{store:id}/product/{product:id}/detail', [ProductUserController::class, 'show'])->name('product.detail');
    Route::get('/{store:id}/product/{product:id}/edit', [ProductUserController::class, 'edit'])->name('product.user.edit');
    Route::get('/{store:id}/product/create', [ProductUserController::class, 'create'])->name('product.create');
    Route::get('/{store:id}/product/{product:id}', [ProductUserController::class, 'show'])->name('store.product.user.show');
    Route::get('/{store:id}/transaction/{transaction:id}/detail', [TransactionUserController::class, 'show'])->name('store.transaction.detail');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login-toko', [LoginController::class, 'index'])->name('login');
Route::post('/login-toko', [LoginController::class, 'loginStore'])->name('login.store');

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/', [LandingController::class, 'index'])->name('landing.post');
Route::get('/list-toko', [LandingController::class, 'listToko'])->name('list.toko');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::post('/about', [LandingController::class, 'about'])->name('about.post');
Route::get('/{store:username}', [FrontendStoreController::class, 'show'])->name('store.show');
Route::get('/{store:username}/product/{product:slug}', [FrontendStoreController::class, 'product'])->name('store.product.show.detail');
