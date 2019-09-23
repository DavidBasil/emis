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

Route::get('/forum', 'ForumsController@index')->name('forum');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('categories', 'CategoriesController');
    Route::get('posts/create', 'PostsController@create')->name('posts.create');
    Route::post('posts/store', 'PostsController@store')->name('posts.store');
    Route::post('posts/comment/{id}', 'PostsController@comment')->name('post.comment');
    Route::get('comment/like/{id}', 'CommentsController@like')->name('comment.like');
    Route::get('comment/unlike/{id}', 'CommentsController@unlike')->name('comment.unlike');
});

Route::get('posts/{post}', 'PostsController@show')->name('posts.show');
