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

// Route::get('/', function () {
//     return view('dashboard');
// });

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::post('/post', 'App\Http\Controllers\PostController@createPost')->name('post.create');
Route::get('/post/{id}', 'App\Http\Controllers\HomeController@viewPost')->name('post.view');
Route::get('/post/edit/{id}', 'App\Http\Controllers\PostController@editPost')->name('post.edit');
Route::put('/post/update/{id}', 'App\Http\Controllers\PostController@updatePost')->name('post.update');
Route::delete('/post/delete/{id}', 'App\Http\Controllers\PostController@deletePost')->name('post.delete');
Route::post('/post/comment', 'App\Http\Controllers\PostController@postComment')->name('post.comment');
