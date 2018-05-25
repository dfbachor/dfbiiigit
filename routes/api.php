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

// a comment to test  

Route::post('/api/v1/users', 'APIController@getUsers')->name('api.users.index');
Route::get('/users/{id}', 'APIController@getUserDetail');

Route::post('/api/v1/tasks', 'APIController@getTasks')->name('api.tasks.index');
Route::get('/tasks/{id}', 'APIController@getTaskDetail');
Route::post('/tasks/updateCloseDate', 'APIController@updateTaskCloseDate')->name('api.tasks.updateCloseDate');


Route::post('/api/v1/rooms', 'APIController@getRooms')->name('api.rooms.index');
Route::get('/rooms/{id}', 'APIController@getRoomDetail');

Route::post('/api/v1/strains', 'APIController@getStrains')->name('api.strains.index');
Route::get('/strains/{id}', 'APIController@getStrainDetail');

Route::post('/api/v1/plants', 'APIController@getPlants')->name('api.plants.index');
Route::get('/plants/{id}', 'APIController@getPlantDetail');

/*
    this works - when calling api  - need to ensure api is in the url
    ex; localhost:8000/api/users/1
    
    Route::get('/users/{id}', function($id) {
        dd($id);
    });

*/


Route::post('/notes', 'APIController@storeNote')->name('api.storeNote');
Route::post('/notes/get', 'APIController@getNotes')->name('api.getNotes');
Route::post('/notes/delete', 'APIController@deleteNote')->name('api.deleteNote');
Route::post('/notes/update', 'APIController@updateNote')->name('api.updateNote');


Route::post('/notes/comment', 'APIController@storeNoteComment')->name('api.storeNoteComment');
Route::post('/notes/like', 'APICommunityController@likeNote')->name('api.likeNote');
Route::post('/notes/unlike', 'APICommunityController@unlikeNote')->name('api.unlikeNote');
