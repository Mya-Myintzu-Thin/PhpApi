<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Project : Bulletin Board
| Description : "This page contains users routes, post routes and csv routes toward controllers"
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('users/','UserController@index')->name('user#index');

Route::view('forgot_password', 'auth.reset_password')->name('password.reset');
