<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [UsersController::class, 'login']);
Route::post('logout', [UsersController::class, 'logout'])->middleware("oauth_private");

Route::group(array('prefix' => 'users', 'middleware' => ['oauth_admin']), function () {
    Route::get('create', [UsersController::class, 'create']);
    Route::post('store', [UsersController::class, 'store']);
    Route::get('edit/{id}', [UsersController::class, 'edit']);
    Route::put('update/{id}', [UsersController::class, 'update']);
});

Route::group(array('prefix' => 'tasks', 'middleware' => ['oauth_private']), function () {
    Route::post('store', [TaskController::class, 'store']);
    Route::get('edit/{id}', [TaskController::class, 'edit'])->middleware("oauth_role_task");
    Route::put('update/{id}', [TaskController::class, 'update'])->middleware("oauth_role_task");
    Route::put('delete/{id}', [TaskController::class, 'destroy'])->middleware("oauth_role_task");
    Route::put('process/{id}', [TaskController::class, 'process'])->middleware("oauth_role_task");
    Route::post('list', [TaskController::class, 'list']);
    Route::post('search', [TaskController::class, 'search']);
});