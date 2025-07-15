<?php

use App\Http\Controllers\Admin\{
    AboutController,
    DashboardController,
    HeroController,
    SettingsController,
    AdminController,
    AdminManagementController,
    MenuItemController as AdminMenuItemController,
    OfferController as AdminOfferController,
    BookingController as AdminBookingController,
    ContactController as AdminContactController,
    CategoryController
};
use App\Http\Controllers\{
    MenuItemController,
    OfferController,
    BookingController,
    ContactController,
    TelegramController
};
use App\Models\{About, Category, Offer, Hero_Page};
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales', ['en', 'ar']))) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    return view('home', [
        'heroPage' => Hero_Page::first(),
        'about' => About::first(),
        'offers' => Offer::latest()->get(),
        'categories' => Category::all()
    ]);
})->name('hero');

Route::get('/csrf-token', function () {
    return response()->json(csrf_token());
});

Route::get('/keep-alive', function () {
    return response()->json(['status' => 'alive']);
})->middleware('auth'); // فقط للمستخدمين المسجلين دخول


// Public Feature Routes
Route::controller(OfferController::class)->group(function () {
    Route::get('/all-offers', 'index')->name('all_offers');
});

Route::controller(MenuItemController::class)->group(function () {
    Route::get('/menu', 'index')->name('menu');
});

Route::controller(BookingController::class)->group(function () {
    Route::get('/book', 'index')->name('book');
    Route::post('/book/table', 'store')->name('book.store');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact/sent', 'store')->name('contact.store');
});

Route::controller(AboutController::class)->group(function () {
    Route::get('/about', 'index')->name('about');
});

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login.form')->middleware('guest:admin');
    Route::post('/login', [AdminController::class, 'login'])->name('login')->middleware('guest:admin');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Items Management
    Route::resource('/menu_items', AdminMenuItemController::class)->names([
        'index' => 'menu.index',
        'create' => 'menu.create',
        'store' => 'menu.store',
        'edit' => 'menu.edit',
        'update' => 'menu.update',
        'destroy' => 'menu.destroy',
    ]);
    Route::controller(AdminMenuItemController::class)->group(function () {
        Route::get('/menu/filter', 'filterByCategory')->name('menu.filter');
        Route::get('/menu/createItemInCategory', 'createItemInCategory')->name('menu.createItemInCategory');
    });

    // Offers Management
    Route::resource('/offers', AdminOfferController::class)->except(['show'])->names([
        'index' => 'offers.index',
        'create' => 'offers.create',
        'store' => 'offers.store',
        'edit' => 'offers.edit',
        'update' => 'offers.update',
        'destroy' => 'offers.destroy'
    ]);
    Route::controller(AdminOfferController::class)->group(function () {
        Route::get('/offers/filter_by_category', 'filterByCategory')->name('offers.filter.category');
        Route::get('/offers/filter_by_status', 'filterByStatus')->name('offers.filter.status');
    });

    // Bookings Management
    Route::resource('/bookings', AdminBookingController::class)->except(['show'])->names([
        'index' => 'bookings.index',
        'create' => 'bookings.create',
        'store' => 'bookings.store',
        'edit' => 'bookings.edit',
        'update' => 'bookings.update',
        'destroy' => 'bookings.destroy',
    ]);
    Route::post('/bookings/markAsNotified', [AdminBookingController::class, 'markAsNotified'])->name('bookings.markAsNotified');
    Route::get('/bookings/export', [AdminBookingController::class, 'export'])->name('bookings.export');
    Route::get('/bookings/export/frequent', [AdminBookingController::class, 'exportFrequentBookers'])->name('bookings.export.frequent');


    // Settings Management
    Route::controller(SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings.index');
        Route::put('/settings/update', 'update')->name('settings.update');
    });

    // Categories Management
    Route::resource('/categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ]);

    // Contacts Management
    Route::controller(AdminContactController::class)->group(function () {
        Route::get('/contacts', 'index')->name('contacts.index');
        Route::get('/contacts/{contact}', 'show')->name('contacts.show');
        Route::post('/contacts/mark-as-read', 'markAsRead')->name('contacts.markAsRead');
        Route::delete('/contacts/{contact}', 'destroy')->name('contacts.destroy');
    });
    Route::post('/contacts/mark-as-notified', [AdminContactController::class, 'markAsNotified'])->name('contacts.markAsNotified');


    // About Management
    Route::controller(AboutController::class)->group(function () {
        Route::get('/about/index', 'indexForAdmin')->name('about.indexForAdmin');
        Route::put('/about/update', 'update')->name('about.update');
        Route::post('/about/update-image', 'updateImage')->name('about.updateImage');
        Route::post('/about/delete-media', 'deleteMedia')->name('about.deleteMedia');
        Route::get('/about/create', 'create')->name('about.create');
        Route::post('/about/create', 'createAbout')->name('about.store');
    });

    // Hero Management
    Route::controller(HeroController::class)->group(function () {
        Route::get('/hero/index', 'indexForAdmin')->name('hero.indexForAdmin');
        Route::get('/hero/create', 'create')->name('hero.create');
        Route::post('/hero/create', 'store')->name('hero.store');
        Route::put('/hero/update', 'update')->name('hero.update');
        Route::post('/hero/delete', 'destroy')->name('hero.destroy');
        Route::post('/hero/delete-image', 'deleteImage')->name('hero.deleteImage');
    });


    // Admin Authentication
    Route::controller(AdminController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/profile', 'index')->name('profile.index');
        Route::put('/profile', 'update')->name('profile.update');
    });

    // Admin Management (Owner Only)
    Route::resource('/admins', AdminManagementController::class)->except(['show'])->middleware('owner');
});

Route::post('/telegram/webhook', [TelegramController::class, 'handleWebhook']);

