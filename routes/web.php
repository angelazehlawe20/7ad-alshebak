<?php

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

Route::get('/', function () {
    return view('home');
})->name('hero');

Route::get('/all-offers', function () {
    return view('partials.all_offers');
})->name('all_offers');

Route::get('/menu', function () {
    return view('partials.menu');
})->name('menu');

Route::get('/book', function () {
    return view('partials.book');
})->name('book');

Route::get('/contact', function () {
    return view('partials.contact');
})->name('contact');
