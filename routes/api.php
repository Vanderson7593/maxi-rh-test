<?php

use App\Http\Controllers\{UserController, CourseController, SubscriptionController};
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

Route::resource('users', UserController::class); // ['only' => ['store']]
Route::resource('courses', CourseController::class); //['only' => ['store', 'index']]
Route::resource('subscriptions', SubscriptionController::class); // ['index', 'update', 'show']

Route::get('sub', function () {
  $a = 'APP';
  return "{$a}";
});
