<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('/distributor/search','DistributorController@search');
Route::resource('distributor', 'DistributorController');
Route::get('/kasir/search','KasirController@search');
Route::resource('kasir', 'KasirController');
Route::get('/pasok/search','PasokController@search');
Route::resource('pasok', 'PasokController');
Route::get('/buku/search','BukuController@search');
Route::resource('buku', 'BukuController');
Route::get('/penjualan/search','PenjualanController@search');
Route::resource('penjualan', 'PenjualanController');
Auth::routes();
Route::GET('/','Auth\LoginController@showLoginForm')->name('login');
Route::POST('/','Auth\LoginController@login');
