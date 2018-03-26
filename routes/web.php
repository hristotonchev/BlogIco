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

Route::get('/blogposts', 'BlogController@blogposts')->name('blogposts');

Route::get('/blogpost/{id}', 'BlogController@blogpost')->name('blogpost');

Route::post('/comment', 'BlogController@comment')->name('comment');

Route::get('/home', 'BlogController@home')->name('home');

    //Admin

Route::get('/admin/login', 'LoginController@login')->name('login');

Route::post('/admin/logincheck', 'LoginController@loginCheck')->name('logincheck');

Route::get('/admin/admin_blogposts', 'AdminController@displayAllBlogPostsInAdmin')->name('admin_blogposts');

Route::get('/admin/logout', 'AdminController@logout')->name('logout');

Route::get('/admin/admin_create_blogpost', 'AdminController@createBlogPost')->name('admin_create_blogpost');

Route::post('/admin/admin_save_blogpost', 'AdminController@saveBlogPost')->name('admin_save_blogpost');

Route::get('/admin/admin_edit_blogpost/{id}', 'AdminController@editBlogPost')->name('admin_edit_blogpost');

Route::post('/admin/admin_update_blogpost', 'AdminController@updateBlogPost')->name('admin_update_blogpost');

Route::post('/admin/admin_delete_blogpost', 'AdminController@deleteBlogPost')->name('admin_delete_blogpost');

Route::get('/admin/admin_destroy_blogpost/{id}', 'AdminController@destroyBlogPost')->name('admin_destroy_blogpost');

Route::get('admin/admin_comments_list', 'AdminController@displayAllCommentsInAdmin')->name('admin_comments_list');

Route::get('/admin/admin_destroy_comment/{id}', 'AdminController@destroyComment')->name('admin_destroy_comment');

Route::post('/admin/admin_delete_comment', 'AdminController@deleteComment')->name('admin_delete_comment');
