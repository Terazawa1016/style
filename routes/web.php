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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/content', 'ContentController@index')->name('content');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/like', 'HomeController@like')->name('like');
Route::get('/favorite', 'HomeController@favorite')->name('favorite');
Route::get('/category', 'SearchController@category')->name('category');
Route::get('/height', 'SearchController@height')->name('height');
Route::get('/age', 'SearchController@age')->name('age');


//管理ページ--------------------------------------------------------------------
Route::get('/tool', 'ToolController@tool')->name('tool');
Route::get('/create', 'ToolController@create')->name('create');
Route::post('/store', 'ToolController@store')->name('store');
Route::post('/status/{style_id}', 'ToolController@status')->name('status');
Route::post('/comment/{style_id}', 'ToolController@comment')->name('comment');
Route::post('/delete/{style_id}', 'ToolController@delete')->name('delete');

//詳細ページ--------------------------------------------------------------------
Route::get('/detail/{style_id}', 'DetailController@detail')->name('detail');
Route::post('/detail/{style_id}', 'ChatController@chat')->name('chat');
Route::post('/like_two', 'DetailController@like_two')->name('like_two');

Route::get('/other/{user_id}', 'OtherController@other')->name('other');
Route::post('/like_three', 'OtherController@like_three')->name('like_three');
