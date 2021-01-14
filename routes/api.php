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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('/{$user_id}')->group(function () {
    Route::get('/', 'ProjectController@show');
    Route::prefix('/projects')->group(function () {
        Route::get('','ProjectController@showOne');
        Route::post('/', 'ProjectController@store');
        Route::prefix('/{project}')->group(function () {
            Route::get('', 'ProjectController@show');
            Route::patch('/', 'ProjectController@update');
            Route::delete('/', 'ProjectController@destroy');
        });
        Route::prefix('/tasks/{task}')->group(function () {
            Route::get('', 'TaskController@show');
            Route::patch('/', 'TaskController@update');
            Route::delete('/', 'TaskController@destroy');
            Route::prefix('/subtasks/{subtask}')->group(function () {
                Route::get('', 'SubtaskController@show');
                Route::patch('/', 'SubtaskController@update');
                Route::delete('/', 'SubtaskController@destroy');
                Route::prefix('/attachments/{attachment}')->group(function () {
                    Route::get('', 'AttachmentController@show');
                    Route::patch('/', 'AttachmentController@update');
                    Route::delete('/', 'AttachmentController@destroy');
                });
            });
        });
    });
});

Route::post('/authorization', 'UserController@auth');
Route::post('/registration', 'UserController@store');
