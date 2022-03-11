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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', function () {
    return view('welcome');
});

Route::post('/create-post', 'PostController@store');

Route::get('/post/list','PostController@getpostlist');

Route::get('post/{postId}', 'PostController@getpostById');

Route::put('post/update/{postId}','PostController@updatePostById');

Route::delete('post/delete/{postId}','PostController@deletePostById');

Route::post('/post/upload-csv', 'PostController@uploadPostCSVFile');

Route::post('/password/update', 'UserController@savePassword');

Route::post('login', 'App\Http\Controllers\Api\AuthController@login');

Route::post('logout', 'App\Http\Controllers\Api\AuthController@logout');

