<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return view('home');
})->name('hero');
Route::get('/all-offers', [OfferController::class, 'index'])->name('all_offers');
Route::get('/menu', [MenuItemController::class, 'index'])->name('menu');
Route::get('/book', [BookingController::class, 'index'])->name('book');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('menu_items', App\Http\Controllers\Admin\MenuItemController::class)->names([
        'index' => 'menu.index',
        'create' => 'menu.create',
        'store' => 'menu.store',
        'edit' => 'menu.edit',
        'update' => 'menu.update',
        'destroy' => 'menu.destroy',
    ]);
    Route::resource('offers', App\Http\Controllers\Admin\OfferController::class)->names([
        'index' => 'offers.index',
        'create' => 'offers.create',
        'store' => 'offers.store',
        'edit' => 'offers.edit',
        'update' => 'offers.update',
        'destroy' => 'offers.destroy'
    ]);
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class)->names([
        'index' => 'bookings.index',
        'create' => 'bookings.create',
        'store' => 'bookings.store',
        'edit' => 'bookings.edit',
        'update' => 'bookings.update',
        'destroy' => 'bookings.destroy'
    ]);
    Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->names([
        'index' => 'contacts.index',
        'create' => 'contacts.markAsRead',
        'store' => 'contacts.store',
        'edit' => 'contacts.edit',
        'update' => 'contacts.update',
        'destroy' => 'contacts.destroy'
    ]);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ]);

});
