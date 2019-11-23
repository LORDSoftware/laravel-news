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

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index')->name('index');
Route::get('/categories/{slug}', 'CategoryController@show')->name('categories.show');
Route::get('/articles/{slug}', 'ArticleController@show')->name('articles.show');
Route::post('/comments/store', 'CommentController@store')->name('comments.store');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function(){
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('articles', 'Admin\ArticleController');
});

