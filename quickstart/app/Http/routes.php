<?php

/**
 * Display All Tasks
 */

use GuzzleHttp\Psr7\Request;
use Illuminate\Routing\Route;

Route::get('/', function () {
    //
});

/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    //
});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    //
});