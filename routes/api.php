<?php

use App\Http\Controllers\{UserController, CourseController, SubscriptionController};
use App\Models\Subscription;
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

Route::resource('users', UserController::class);
Route::resource('courses', CourseController::class);
Route::resource('subscriptions', SubscriptionController::class);

Route::get('sub', function () {
  $sub = new Subscription();
  $sub->user_id = 1;
  $sub->course_id = 1;
  return $sub->save();
});
