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

Route::post('/secret', 'Auth\ResetPasswordController@showSecretQuestion')->name('secret');
Route::get('/secret', function () {
    return redirect()->route('main');
});

Route::post('/check', 'Auth\ResetPasswordController@checkAnswer')->name('check');
Route::get('/check', function () {
    return redirect()->route('main');
});
Route::post('/updatepassword', 'Auth\ResetPasswordController@updatePassword')->name('updatepassword');
Route::get('/updatepassword', function () {
    return redirect()->route('main');
});

Route::resource('categories','CategoryController');
Route::resource('products','ProductController');

Route::get('/test', function () {
    return view('test');
});