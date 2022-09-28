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

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/login', 'Auth\Login\LoginController@login')->name('login');
Route::post('/login', 'Auth\Login\LoginController@login');

Route::get('/register_view','Auth\RegisterController@registerView');
Route::post('/register','Auth\RegisterController@register');
Route::get('added','Auth\RegisterController@added');

Route::get('logout','Auth\Login\LoginController@logout');

Route::group(['middleware'=>['auth']],function(){

Route::get('/top','PostController@index');

Route::get('/create_post','PostController@postCreateView');

Route::post('new_post','PostController@newPost');

Route::get('/post_detail/{id}','PostController@postDetail')->name('detail');

Route::get('/post_detail/{id}/edit','PostController@postEdit');

Route::post('/post_detail/{id}/update','PostController@postUpdate');

Route::post('/post_detail/{id}/comment','PostCommentController@store');

Route::get('/post_detail/{id}/comment_edit','PostCommentController@edit');

Route::post('/post_detail/{id}/comment_update','PostCommentController@update');

Route::group(['middleware'=>['auth','can:system-only']],function(){

Route::get('/add_category','PostMainCategoryController@addView');

Route::post('add_main_category','PostMainCategoryController@add');

Route::post('add_sub_category','PostSubCategoryController@add');
});
});
