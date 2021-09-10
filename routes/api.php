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

Route::resource('users', UserController::class, ['only' => ['store', 'index']]);

Route::resource('courses', CourseController::class, ['only' => ['store', 'index']]);

Route::prefix('subscriptions')->group(function () {
  Route::resource('/', SubscriptionController::class, ['except' => ['edit', 'create']]);
  Route::patch('status/update/{id}', [SubscriptionController::class, 'updateStatus']);
});
