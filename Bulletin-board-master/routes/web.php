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

Route::get('logout','Auth\Login\LoginController@logout')->name('logout');

Route::group(['middleware'=>['auth']],function(){

Route::get('/top','PostController@index')->name('top');

Route::get('/create_post','PostController@postCreateView');

Route::post('new_post','PostController@newPost');

Route::group(['middleware'=>['TraceLog']],function(){
Route::get('/post_detail/{id}','PostController@postDetail')->name('posts.detail');
});

Route::get('/post_detail/{id}/edit','PostController@postEdit');

Route::post('/post_detail/{id}/update','PostController@postUpdate');

Route::get('/post_detail/{id}/delete','PostController@delete');

Route::post('/post_detail/{id}/comment','PostCommentController@store');

Route::get('/post_detail/{id}/comment_edit','PostCommentController@edit');

Route::post('/post_detail/{id}/comment_update','PostCommentController@update');

Route::get('/post_detail/{id}/comment_delete','PostCommentController@delete');

Route::post('/favorite_post', 'PostFavoriteController@postFavorite')->name('posts.favorite');

Route::post('/favorite_comment', 'PostCommentController@postCommentFavorite')->name('comments.favorite');

Route::group(['middleware'=>['auth','can:system-only']],function(){

Route::get('/add_category','PostMainCategoryController@addView');

Route::post('add_main_category','PostMainCategoryController@add');

Route::get('main_delete/{id}','PostMainCategoryController@delete');

Route::get('sub_delete/{id}','PostSubCategoryController@delete');

Route::post('add_sub_category','PostSubCategoryController@add');
});
});
