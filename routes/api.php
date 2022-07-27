<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HallSeatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeatClassController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAccessMiddleware;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//artists routs

Route::get('/artists',[ArtistController::class,'index']);

Route::get('/artists/{artist}',[ArtistController::class,'show']);
// hall rout dont need access
Route::get('/halls',[HallController::class,'index']);
Route::get('/halls/{hall}',[HallController::class,'show']);
Route::get('/halls/{hall}/seats',[HallSeatController::class,'index']);

//categories routs


Route::get('/categories',[CategoryController::class,'index']);

Route::get('/categories/{category}',[CategoryController::class,'show']);






// user register

Route::post('/register',[RegisterController::class,'store']);

//login

Route::post('/login',[LoginController::class,'store']);

//logout

Route::prefix('/concerts')->group(function (){
    Route::get('/',[ConcertController::class,'index']);
});
Route::middleware('auth:sanctum')->group(function (){
//logout
Route::delete('/logout',[LoginController::class,'destroy']);

//users



Route::prefix('/users')->group(function (){
Route::get('/{user}',[UserController::class,'show']);

Route::get('/',[UserController::class,'index']);
});


//category


Route::prefix('/categories')->group(function (){

Route::post('/store',[CategoryController::class,'store'])
->middleware(CheckAccessMiddleware::class.':create-categories');

Route::patch('/{category}',[CategoryController::class,'update']);

Route::delete('/{category}',[CategoryController::class,'destroy']);
});





//artist

Route::prefix('/artists')->group(function (){

Route::post('/',[ArtistController::class,'store']);

Route::patch('/{artist}',[ArtistController::class,'update']);

Route::delete('/{artist}',[ArtistController::class,'destroy']);

});

//concert
Route::prefix('concert')->group(function (){
    Route::post('/store',[ConcertController::class,'store']);
    Route::delete('/{concert}',[ConcertController::class,'destroy']);
});
//halls
Route::prefix('halls')->group(function (){

 Route::post('/store',[HallController::class,'store']);

 Route::patch('/{hall}',[HallController::class,'update']);
 Route::delete('/{hall}',[HallController::class,'destroy']);
 // hall seat
    Route::patch('/{hall}/seats',[HallSeatController::class,'update']);
 Route::post('/{hall}/seats/store',[HallSeatController::class,'store']);


});

//roles
Route::prefix('/roles')->group(function (){
Route::get('/',[RoleController::class,'index']);
Route::get('/{role}',[RoleController::class,'show'])
->middleware(CheckAccessMiddleware::class.':read-roles');
Route::post('/store',[RoleController::class,'store'])
->middleware(CheckAccessMiddleware::class.':create-roles');
Route::patch('/{role}',[RoleController::class,'update'])
->middleware(CheckAccessMiddleware::class.':update-roles');
Route::delete('/{role}',[RoleController::class,'destroy'])
    ->middleware(CheckAccessMiddleware::class.':delete-roles');
});
//seats
Route::prefix('seats-classes')->group(function (){
    Route::get('/',[SeatClassController::class,'index']);
});

});
