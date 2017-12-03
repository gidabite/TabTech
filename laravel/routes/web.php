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

Route::get('/', 'MainController@index')->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/update','HomeController@update')->name('update');
Route::get('/update', function () {
    abort(404);
});


Route::post('/secret', 'Auth\ResetPasswordController@showSecretQuestion')->name('secret');
Route::get('/secret', function () {
    abort(404);
});

Route::post('/check', 'Auth\ResetPasswordController@checkAnswer')->name('check');
Route::get('/check', function () {
    abort(404);
});
Route::post('/updatepassword', 'Auth\ResetPasswordController@updatePassword')->name('updatepassword');
Route::get('/updatepassword', function () {
    abort(404);
});

Route::resource('categories','CategoryController');
Route::resource('products','ProductController');
Route::resource('grandcategories','GrandCategoryController');

Route::post('/ajax', 'AjaxController@category')->name('ajax');
Route::get('/ajax', function () {
    abort(404);
});
Route::post('/ajaxImage', 'AjaxController@image')->name('ajaxImage');
Route::get('/ajaxImage', function () {
    abort(404);
});

Route::post('/ajaxstars', 'AjaxController@stars')->name('ajaxstars');
Route::get('/ajaxstars', function () {
    abort(404);
});

Route::post('/ajaxmanager', 'AjaxController@manager')->name('ajaxmanager');
Route::get('/ajaxmanager', function () {
    abort(404);
});


Route::post('/add','ShoppingController@add')->name('add');
Route::get('/add', function () {
    abort(404);
});
Route::post('/decrease','ShoppingController@decrease')->name('decrease');
Route::get('/decrease', function () {
    abort(404);
});
Route::post('/delete','ShoppingController@delete')->name('delete');
Route::get('/delete', function () {
    abort(404);
});
Route::get('/basket','ShoppingController@basket')->name('basket');

Route::get('/order', 'ShoppingController@order')->name('order');

Route::post('/pay', 'ShoppingController@pay')->name('pay');
Route::get('/post', function () {
    abort(404);
});

Route::get('/history','ShoppingController@history')->name('history');