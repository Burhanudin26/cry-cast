<?php

use App\Http\Controllers\NewController;
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
    return view('home');
});
// route to menu page
Route::get('/menu', function () {
    return view('menu');
});
// return to abour
Route::get('/about', function () {
    return view('about');
});

// route to eth
Route::get('menu/eth', function () {
    return view('eth');
});
Route::post('/import', 'App\Http\Controllers\NewController@import');
