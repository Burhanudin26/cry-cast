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
    return view('eth');
});

// route to bitcoin
Route::get('menu/bitcoin', function () {
    return view('bitcoin');
});

// route to biance
Route::get('menu/biance', function () {
    return view('biance');
});

// route to dogecoin
Route::get('menu/dogecoin', function () {
    return view('dogecoin');
});

// route to iota
Route::get('menu/iota', function () {
    return view('iota');
});

// route to solana
Route::get('menu/solana', function () {
    return view('solana');
});

// route to stellar
Route::get('menu/stellar', function () {
    return view('stellar');
});

// route to tron
Route::get('menu/tron', function () {
    return view('tron');
});

Route::post('/import', 'App\Http\Controllers\NewController@import');
