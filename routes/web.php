<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\About;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    $about = About::first();
    $offers = Offer::latest()->get();
    $categories = Category::all();

    return view('home', compact('about', 'offers', 'categories'));
})->name('hero');
Route::get('/all-offers', [OfferController::class, 'index'])->name('all_offers');
Route::get('/menu', [MenuItemController::class, 'index'])->name('menu');
Route::get('/book', [BookingController::class, 'index'])->name('book');
Route::post('/book/table', [BookingController::class, 'store'])->name('book.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/sent', [ContactController::class, 'store'])->name('contact.store');
Route::get('/about', [AboutController::class, 'index'])->name('about');



// admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('menu_items', App\Http\Controllers\Admin\MenuItemController::class)->names([
        'index' => 'menu.index',
        'create' => 'menu.create',
        'store' => 'menu.store',
        'filterByCategory' => 'menu.filter',
        'edit' => 'menu.edit',
        'update' => 'menu.update',
        'destroy' => 'menu.destroy',
    ]);
    Route::get('/menu/filter', [App\Http\Controllers\Admin\MenuItemController::class, 'filterByCategory'])->name('menu.filter');
    Route::get('/menu/createItemInCategory', [App\Http\Controllers\Admin\MenuItemController::class, 'createItemInCategory'])->name('menu.createItemInCategory');

    Route::resource('offers', App\Http\Controllers\Admin\OfferController::class)->except(['show'])->names([
        'index' => 'offers.index',
        'create' => 'offers.create',
        'store' => 'offers.store',
        'edit' => 'offers.edit',
        'update' => 'offers.update',
        'destroy' => 'offers.destroy'
    ]);
    Route::get('/offers/filter_by_category', [App\Http\Controllers\Admin\OfferController::class, 'filterByCategory'])->name('offers.filter.category');
    Route::get('/offers/filter_by_status', [App\Http\Controllers\Admin\OfferController::class, 'filterByStatus'])->name('offers.filter.status');

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
    Route::put('/settings/update', [SettingsController::class, 'update'])->name('settings.update');


    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ]);

    Route::get('/contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/mark-as-read', [App\Http\Controllers\Admin\ContactController::class, 'markAsRead'])->name('contacts.markAsRead');
    Route::delete('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');


    Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');
    Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');  // عرض صفحة الفورم
    Route::post('/about/create', [AboutController::class, 'createAbout'])->name('about.store'); // حفظ البيانات
});
