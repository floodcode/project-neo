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

/**
 * Home routes
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 * Auth routes
 */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

/**
 * News routes
 */
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/view/{id}', 'NewsController@view')->name('news.view');
Route::match(['get', 'post'], '/news/create', 'NewsController@create')->name('news.create');
Route::match(['get', 'post'], '/news/edit/{id}', 'NewsController@edit')->name('news.edit');
Route::post('/news/delete/{id}', 'NewsController@delete');
Route::post('/news/delete-translation/{id}', 'NewsController@deleteTranslation');
Route::post('/news/comment/create/{id}', 'NewsController@commentCreate')->name('news.comment.create');
Route::post('/news/comment/delete/{id}', 'NewsController@commentDelete')->name('news.comment.delete');

/**
 * User routes
 */
Route::get('/users', 'UserController@index')->name('user.index');
Route::get('/users/{id}', 'UserController@view')->name('user.view');

/**
 * Admin routes
 */
Route::prefix('/admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/news/categories', 'AdminController@newsCategories')->name('admin.news.categories');
    Route::post('/news/categories/create', 'AdminController@newsCategoriesCreate');
    Route::post('/news/categories/edit/{id}', 'AdminController@newsCategoriesEdit');
    Route::post('/news/categories/delete/{id}', 'AdminController@newsCategoriesDelete');
});