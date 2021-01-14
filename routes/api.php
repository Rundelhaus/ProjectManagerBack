<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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
//Route::prefix('/{$user_id}')->group(function () {
//    Route::get('', [ProjectController::class, 'show']);
    Route::prefix('/projects')->group(function () {
        Route::post('/getAll', [ProjectController::class, 'showAll']);
        Route::post('/', [ProjectController::class, 'store']);
    });


//    Route::prefix('/project')->group(function () {
//            Route::get('', [ProjectController::class, 'show']);
//        Route::post('', [ProjectController::class, 'show']);
//            Route::patch('/', [ProjectController::class, 'update']);
//            Route::delete('/', [ProjectController::class, 'destroy']);
//    });
//        Route::prefix('/tasks/{task}')->group(function () {
//            Route::get('', [TaskController::class, 'show']);
//            Route::patch('/', 'TaskController@update');
//            Route::delete('/', 'TaskController@destroy');
//            Route::prefix('/subtasks/{subtask}')->group(function () {
//                Route::get('', 'SubtaskController@show');
//                Route::patch('/', 'SubtaskController@update');
//                Route::delete('/', 'SubtaskController@destroy');
//                Route::prefix('/attachments/{attachment}')->group(function () {
//                    Route::get('', 'AttachmentController@show');
//                    Route::patch('/', 'AttachmentController@update');
//                    Route::delete('/', 'AttachmentController@destroy');
//                });
//            });
//        });
    //});
//});

Route::post('/authorization', [UserController::class, 'auth']);
Route::post('/registration', [UserController::class, 'store']);
//Route::post('/', [ProjectController::class, 'store']);
