<?php

use App\Http\Controllers\Apis\Auth\RegisterController;
use App\Http\Controllers\Apis\LikeController;
use App\Http\Controllers\Apis\TweetController;
use App\Http\Controllers\Apis\UsersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getall',[TweetController::class,'index']);


Route::middleware('auth:api')->group(function () {
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::resource('user', UsersController::class);
    Route::resource('tweet', TweetController::class);
    Route::resource('like',LikeController::class);
//    Route::post('/tweet/{user_id}',[TweetController::class,'store']);

});
Route::get('user/{id}',[UserController::class,'profile']);

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
