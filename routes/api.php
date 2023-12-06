<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ResearcherMiddleware;
use App\Http\Controllers\ResearcherController;

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

Route::post('login',[ResearcherController::class,'login']);
Route::post('signin', [ResearcherController::class, 'signin']);

Route::group(['middleware' => [

    'auth:sanctum',
    //  ResearcherMiddleware::class,


     ]], function () {
    // protected routes go here
    Route::post('test', [ResearcherController::class, 'store']);

});
