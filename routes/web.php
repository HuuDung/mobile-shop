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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.',
    'middleware' => ['auth', 'admin']], function () {
        Route::resource('member', 'MemberAdministrationController');
        Route::get('search-member', 'MemberAdministrationController@search')->name('member.search');
        Route::post('member/{id}', 'MemberAdministrationController@restore')->name('member.restore');
        Route::resource('product-administration', 'ProductAdministrationController');
        Route::post('product-administration/{id}', 'ProductAdministrationController@restore')->name('product-administration.restore');
        Route::get('search-product', 'ProductAdministrationController@search')->name('product.search');
        Route::resource('category', 'CategoryAdministrationController');
        Route::post('category/{id}', 'CategoryAdministrationController@restore')->name('category.restore');
        Route::group(['prefix' => 'specificate', 'namespace' => 'Specificate', 'as' => 'specificate.'], function () {
            Route::resource('ram', 'RamController');
            Route::post('ram/{id}', 'RamController@restore')->name('ram.restore');
            Route::resource('cpu', 'CpuController');
            Route::post('cpu/{id}', 'CpuController@restore')->name('cpu.restore');
            Route::resource('system', 'SystemController');
            Route::post('system/{id}', 'SystemController@restore')->name('system.restore');
            Route::resource('storage', 'StorageController');
            Route::post('storage/{id}', 'StorageController@restore')->name('storage.restore');
        });
    });


Route::resource('user', 'UserController')->only('index', 'edit', 'update')->middleware('auth');

Route::get('user/changepassword', 'UserController@getFormChangePassWord')->middleware('auth')->name('changepassword');
Route::post('user/changepassword', 'UserController@changePassWord')->middleware('auth')->name('password.update');

Route::get('add-balance', 'UserController@addBalance')->name('add.balance')->middleware('auth');
Route::post('add-balance', 'UserController@storeBalance')->name('store.balance')->middleware('auth');
Route::get('product-detail/{productId}', 'ProductController@show')->name('product.show');
Route::group(['prefix' => 'cart', 'as' => 'cart.', 'middleware' => ['auth']], function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('/', 'CartController@store')->name('store');
    Route::put('/', 'CartController@update')->name('update');
    Route::delete('/', 'CartController@destroy')->name('destroy');
});
Route::get('pay/', 'HistoryController@pay')->name('pay')->middleware('auth');
Route::post('pay/', 'HistoryController@store')->name('pay.store')->middleware('auth');
Route::get('history', 'HistoryController@index')->name('history.index')->middleware('auth');
Route::get('search-product', 'HomeController@search')->name('home.product.search');
Route::get('search-filter-product', 'HomeController@searchFilter')->name('home.search.filter');
