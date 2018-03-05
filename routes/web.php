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

Route::get('/', 'BlogController@home')->name('home');

Route::get('/about', 'BlogController@about')->name('about');

Route::get('/contact', 'BlogController@contact')->name('contact');

Route::get('/blogposts','BlogController@blogposts')->name('blogposts');

Route::get('/blogpost/{id}','BlogController@blogpost')->name('blogpost');

Route::post('/comment','BlogController@comment')->name('comment');
