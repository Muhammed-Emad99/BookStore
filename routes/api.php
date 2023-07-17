<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('test', function () {
    echo 'Welcome';
});

Route::middleware('isApiAdmin')->group(function() {
    Route::get('books/list', [ApiController::class, 'list']);
});

Route::middleware('isApiLoggedIn')->group(function() {
    Route::get('categories/list', [ApiController::class, 'categories']);
    Route::get('users/list', [ApiController::class, 'users']);

});

Route::post('users/register', [ApiController::class, 'register']);
Route::post('users/login', [ApiController::class, 'login']);
