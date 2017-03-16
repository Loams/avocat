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

Route::get(
	'/', function () {
    return view('welcome');
});
//debug de json
Route::get('/test', ['uses' => "ArticleController@testJson"]);

Route::get('/articles', ['uses' => 'ArticleController@index']);
Route::get('/article/{id}', ['uses' => 'ArticleController@show', 'as' => 'article.show'])->where('id', '[0-9]+');

Route::post('/executeSearch', 'SearchController@executeSearch')->name('execute_search');
Route::get('/import', ['uses' => "ArticleController@importArticle"]);