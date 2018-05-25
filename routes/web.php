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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/community', 'CommunityController@index')->name('community');

Route::get('/users', 'UsersController@index')->name('users');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users/store', 'UsersController@store')->name('users.store');
Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');
Route::post('/users/update', 'UsersController@update')->name('users.update');
Route::get('/users/destroy/{id}', 'UsersController@destroy');

Route::get('/tasks', 'TasksController@index')->name('tasks');
Route::get('/tasks/create', 'TasksController@create')->name('tasks.create');
Route::post('/tasks/store', 'TasksController@store')->name('tasks.store');
Route::get('/tasks/edit/{id}', 'TasksController@edit')->name('tasks.edit');
Route::post('/tasks/update', 'TasksController@update')->name('tasks.update');
Route::get('/tasks/destroy/{id}', 'TasksController@destroy');

Route::get('/rooms', 'RoomsController@index')->name('rooms');
Route::get('/rooms/create', 'RoomsController@create')->name('rooms.create');
Route::post('/rooms/store', 'RoomsController@store')->name('rooms.store');
Route::get('/rooms/edit/{id}', 'RoomsController@edit')->name('rooms.edit');
Route::post('/rooms/update', 'RoomsController@update')->name('rooms.update');
Route::get('/rooms/destroy/{id}', 'RoomsController@destroy');

Route::get('/strains', 'StrainsController@index')->name('strains');
Route::get('/strains/create', 'StrainsController@create')->name('strains.create');
Route::post('/strains/store', 'StrainsController@store')->name('strains.store');
Route::get('/strains/edit/{id}', 'StrainsController@edit')->name('strains.edit');
Route::post('/strains/update', 'StrainsController@update')->name('strains.update');
Route::get('/strains/destroy/{id}', 'StrainsController@destroy');

Route::get('/plants', 'PlantsController@index')->name('plants');
Route::get('/plants/create', 'PlantsController@create')->name('plants.create');
Route::post('/plants/store', 'PlantsController@store')->name('plants.store');
Route::get('/plants/edit/{id}', 'PlantsController@edit')->name('plants.edit');
Route::post('/plants/update', 'PlantsController@update')->name('plants.update');
Route::get('/plants/destroy/{id}', 'PlantsController@destroy');

Route::get('/system', 'SystemsController@show')->name('system');
Route::post('/system/update', 'SystemsController@update')->name('system.update');

Route::get('/systemImage/{filename}', [
    'uses' => 'SystemsController@getSystemImage', 
    'as' => 'system.image'
]);

Route::get('/image/{filename}', [
    'uses' => 'ApiController@getImage', 
    'as' => 'image'
]);
