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
// route to about page
Route::get('/about', function () {
    return view('about');
});
// route to login page
Route::get('/login', function () {
    return view('login.login');
});

// route to register page
Route::get('/register', function () {
    return view('login.register');
});


// route to eth
Route::get('menu/eth', function () {
    return view('menu.eth');
});

// route to bitcoin
Route::get('menu/bitcoin', function () {
    return view('menu.bitcoin');
});

// route to biance
Route::get('menu/binance', function () {
    return view('menu.binance');
});

// route to dogecoin
Route::get('menu/dogecoin', function () {
    return view('menu.dogecoin');
});

// route to iota
Route::get('menu/iota', function () {
    return view('menu.iota');
});

// route to solana
Route::get('menu/solana', function () {
    return view('menu.solana');
});

// route to stellar
Route::get('menu/stellar', function () {
    return view('menu.stellar');
});

// route to tron
Route::get('menu/tron', function () {
    return view('menu.tron');
});

Route::post('/import1', 'App\Http\Controllers\NewController@import1');
Route::post('/import2', 'App\Http\Controllers\NewController@import2');
Route::post('/import3', 'App\Http\Controllers\NewController@import3');
Route::post('/import4', 'App\Http\Controllers\NewController@import4');
Route::post('/import5', 'App\Http\Controllers\NewController@import5');
Route::post('/import6', 'App\Http\Controllers\NewController@import6');
Route::post('/import7', 'App\Http\Controllers\NewController@import7');
Route::post('/import8', 'App\Http\Controllers\NewController@import8');