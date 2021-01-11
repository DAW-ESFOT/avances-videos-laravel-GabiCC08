<?php

use App\Article;
use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('articles', 'ArticleController@index');
Route::get('comments', 'CommentController@index');
Route::get('categories', 'categoryController@index');
Route::get('categories/{category}', 'categoryController@show');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('articles/{article}', 'ArticleController@show');
    Route::post('articles', 'ArticleController@store');
    Route::put('articles/{article}', 'ArticleController@update');
    Route::delete('articles/{article}', 'ArticleController@delete');

    Route::get('comments/{comment}', 'commentController@show');
    Route::post('comments', 'commentController@store');
    Route::put('comments/{comment}', 'commentController@update');
    Route::delete('comments/{comment}', 'commentController@delete');

    Route::post('categories', 'categoryController@store');
    Route::put('categories/{category}', 'categoryController@update');
    Route::delete('categories/{category}', 'categoryController@delete');

});
