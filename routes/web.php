<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('landing_page');})->name('landing_page');
Route::get('/menu', function () {return view('Menu.menu_list');})->name('menu');
Route::get('/stores', function () {return view('Store.store');})->name('store');
Route::get('/promo', function () {return view('Promo.promo');})->name('promo');
Route::get('/login', function () {return view('Auth.login');})->name('login');
Route::get('/register', function () {return view('Auth.register');})->name('register');
Route::get('/logout', function () {return view('Auth.login');})->name('logout');
Route::get('/profile', function () {return view('Profiles.profiles');})->name('profile');


Route::get('/admin', function () {return view('Admin.Dashboard.dashboard'); })->name('admin.dashboard');
Route::get('/admin/products', function () {return view('Admin.Product.product'); })->name('admin.products');
Route::get('/admin/settings', function () {return view('Admin.Settings.settings'); })->name('admin.settings');
Route::get('/admin/reviews', function () {return view('Admin.Reviews.reviews'); })->name('admin.reviews');
Route::get('/admin/notifications', function () {return view('Admin.Notifications.notifications'); })->name('admin.notifications');
Route::get('/admin/activities', function () {return view('Admin.Activities.activities'); })->name('admin.activities');
Route::prefix('admin/auth')->name('admin.')->group(function () {
    Route::get('/login', function () { return view('Admin.Auth.login'); })->name('login');
    Route::get('/register', function () { return view('Admin.Auth.register');})->name('register'); 
    Route::get('/profile', function () {return view('Admin.Profiles.profiles');})->name('profile');
    Route::get('/tambah-menu', function () {return view('Admin.Product.tambah_menu');})->name('tambah_menu');
});

Route::get('/menu/view', function () {return view('Menu.menu_view');})->name('menu_view');
