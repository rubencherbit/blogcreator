<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
 * User routes
 */
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

/*
 * Home routes
 */
Route::get('/', 'BlogController@index')->name('home');

/*
 * Blog routes
 */
Route::resource('blogs', 'BlogController', [ 'except' => [
    'index'
]]);


/*
 * Article routes
 */
Route::resource('article', 'ArticleController');


/*
 * Categorie routes
 */
Route::resource('categorie', 'CategorieController');

/*
 * Admin routes
 */
Route::get('/admin/blogs', 'BlogController@indexAdmin');
Route::get('/admin/articles', 'ArticleController@indexAdmin');
