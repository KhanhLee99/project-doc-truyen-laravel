<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//user
Route::get('users', 'AdminUserController@index');
Route::post('user/register','AdminUserController@store');
Route::put('user/{id}','AdminUserController@edit');
Route::delete('user/{id}','AdminUserController@delete');
Route::get('user/{name}','AdminUserController@search');
Route::post('login','AdminUserController@login');

//author
Route::get('authors', 'AdminAuthorController@index');
Route::post('author/add', 'AdminAuthorController@add');
Route::put('author/{id}', 'AdminAuthorController@edit');
Route::delete('author/{id}', 'AdminAuthorController@delete');
Route::get('author/{name}','AdminAuthorController@search');

//story
Route::post('story/add', 'AdminStoryController@add');
Route::get('stories', 'AdminStoryController@index');
Route::delete('story/{id}', 'AdminStoryController@delete');
Route::put('story/{id}', 'AdminStoryController@edit');
Route::get('story/{name}','AdminStoryController@search');

//category
Route::post('category/add', 'AdminCategoryController@add');
Route::get('categories', 'AdminCategoryController@index');
Route::put('category/{id}', 'AdminCategoryController@edit');
Route::delete('category/{id}', 'AdminCategoryController@delete');
Route::get('category/{name}','AdminCategoryController@search');

//chapter
Route::post('chapter/add', 'AdminChapterController@add');
Route::get('chapters', 'AdminChapterController@index');
Route::put('chapter/{id}', 'AdminChapterController@edit');
Route::delete('chapter/{id}', 'AdminChapterController@delete');
Route::get('chapter', 'AdminChapterController@search');