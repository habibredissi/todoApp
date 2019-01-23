<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for the tasks API 
Route::get('/tasks', 'TasksController@index');
Route::post('/tasks', 'TasksController@store');
Route::put('/tasks/{task}', 'TasksController@update');
Route::delete('/tasks/{task}', 'TasksController@destroy');

// Routes for the lists API 
Route::get('/lists', 'ListsController@index');
Route::get('/lists/{list}', 'ListsController@show');
Route::post('/lists', 'ListsController@store');
Route::put('/lists/{list}', 'ListsController@update');
Route::delete('/lists/{list}', 'ListsController@destroy');

// Routes for Authentification
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');