<?php

use App\Http\Controllers\{
    CategoryController,
    NoteController,
    UserController,
    BookController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

*/

Route::get('/', function () {
    return view('welcome');
});

// admins only
Route::middleware('isAdmin')->group(function(){

    //------------------------------------- books -------------------------------------
    Route::get('/books/create', [BookController::class, 'create']);  // create
    Route::post('/books/store', [BookController::class, 'store']);   // store

    Route::get('/books/delete/{id}', [BookController::class, 'delete']); // delete

    Route::get('/books/edit/{id}',[BookController::class, 'edit']);
    Route::post('/books/update/{id}',[BookController::class, 'update']); //update


    //------------------------------------- Notes -------------------------------------
    Route::get('/notes/create',[NoteController::class, 'create']); // create
    Route::post('/notes/save',[NoteController::class, 'save']); // save

    //------------------------------------- Categories -------------------------------------
    Route::get('/category/create',[CategoryController::class, 'create']); // create
    Route::post('/category/save',[CategoryController::class, 'save']); // save

});

//any user
Route::middleware('isLoggedIn')->group(function(){
    Route::get('/books/list',[BookController::class, 'list']);
    Route::get('/books/show/{id}',[BookController::class,'show']);
    Route::get('/books/search/{char}',[BookController::class,'search']);
    Route::get('/user/logout',[UserController::class, 'logout']);

    Route::get('/category/list',[CategoryController::class, 'list']);

});

//any person without login and register
//-------------------------------------------------------- Auth --------------------------------------------------------
Route::get('/user/register',[UserController::class, 'register']);
Route::post('/user/save',[UserController::class,'save']);


Route::get('/user/loginForm',[UserController::class, 'loginForm']);
Route::post('/user/login',[UserController::class , 'login']);

//not Authorized --------------------------------
Route::get('notAuthenticated',function (){
    return "You are not Authenticated to you to visit this url";
});

