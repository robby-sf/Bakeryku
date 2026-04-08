<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('landing_page');})->name('landing_page');
Route::get('/menu', function () {return view('Menu.menu_list');})->name('menu');
Route::get('/stores', function () {return view('Store.store');})->name('store');
Route::get('/promo', function () {return view('Promo.promo');})->name('promo');
Route::get('/menu/view', function () {return view('Menu.menu_view');})->name('menu_view');
