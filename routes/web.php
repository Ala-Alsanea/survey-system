<?php

use App\Filament\Widgets\Map;
use App\Livewire\MapIfram;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::group([
    'middleware' => [

        'auth',
        //  ResearcherMiddleware::class,
    ]
], function () {

    Route::get('/map', MapIfram::class);
});
