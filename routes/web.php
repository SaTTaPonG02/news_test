<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login'); 
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/news_category', 'NewsController@news_category')->name('news_category');
Route::get('/news_category_data', 'NewsController@news_category_data')->name('news_category_data');
Route::get('/insert_news_category', 'NewsController@insert_news_category')->name('insert_news_category');
Route::post('/save_news_category', 'NewsController@save_news_category')->name('save_news_category');
Route::get('/edit_news_category/{id}', 'NewsController@edit_news_category')->name('edit_news_category');
Route::post('/update_news_category', 'NewsController@update_news_category')->name('update_news_category');
Route::post('/delete_news_category', 'NewsController@delete_news_category')->name('delete_news_category');

Route::get('/news/{cat_id}', 'NewsController@news')->name('news');
Route::get('/news_data', 'NewsController@news_data')->name('news_data');
Route::get('/insert_news/{cat_id}', 'NewsController@insert_news')->name('insert_news');
Route::post('/save_news', 'NewsController@save_news')->name('save_news');
Route::get('/edit_news/{id}', 'NewsController@edit_news')->name('edit_news');
Route::post('/update_news', 'NewsController@update_news')->name('update_news');
Route::post('/delete_news', 'NewsController@delete_news')->name('delete_news');
