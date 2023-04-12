<?php

use App\Http\Controllers\NewController;
use App\Http\Controllers\ErrRate;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Binance;
use App\Http\Controllers\Bitcoin;


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

// Default route from laravel
Route::get('/', function () {
    return view('home');
});


// Register & Login
Route::get('/registerGet', [UserController::class, 'showRegistrationForm'])->name('registerGet');
Route::post('/registerPost', [UserController::class, 'register'])->name('registerPost');
Route::get('/loginGet', [UserController::class, 'showLoginForm'])->name('loginGet');
Route::post('/loginPost', [UserController::class, 'login'])->name('loginPost');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// route to about page
Route::get('/about', function () {
    return view('about');
});
// route to login page
Route::get('/loginPage', function () {
    return view('login.login');
});

// route to register page
Route::get('/registerPage', function () {
    return view('login.register');
})->name('regis');

// route to register page
Route::get('/menu-master', function () {
    return view('menu-master');
})->name('mmaster');

// menu route
Route::get('/menu', function () {
    return view('menu');
})->name('menu');

//Menu group
Route::prefix('menu')->group(function () {
     // route to eth
     Route::get('master', function () {
        return view('menu.master');
    });
    // route to eth
    Route::get('eth', function () {
        return view('menu.eth');
    });

    // route to bitcoin
    Route::get('bitcoin', function () {
        return view('menu.bitcoin');
    });

    // route to bianceconmtroller index
    Route::get('binance', [Binance::class, 'index']);

    // route to dogecoin
    Route::get('dogecoin', function () {
        return view('menu.dogecoin');
    });

    // route to iota
    Route::get('iota', function () {
        return view('menu.iota');
    });

    // route to solana
    Route::get('solana', function () {
        return view('menu.solana');
    });

    // route to stellar
    Route::get('stellar', function () {
        return view('menu.stellar');
    });

    // route to tron
    Route::get('tron', function () {
        return view('menu.tron');
    });
});

// Route to controller
Route::post('/import', 'App\Http\Controllers\NewController@import');
// import 1 in controller Binance
Route::post('/import1', 'App\Http\Controllers\Binance@import1')->name('import1');
// import 2 in controller Bitcoin
Route::post('/import2', 'App\Http\Controllers\Bitcoin@import2')->name('import2');
Route::post('/import3', 'App\Http\Controllers\NewController@import3');
Route::post('/import4', 'App\Http\Controllers\NewController@import4');
Route::post('/import5', 'App\Http\Controllers\NewController@import5');
Route::post('/import6', 'App\Http\Controllers\NewController@import6');
Route::post('/import7', 'App\Http\Controllers\NewController@import7');
Route::post('/import8', 'App\Http\Controllers\NewController@import8');

// Output

// Try Naive Bayes
Route::get('/naive', 'App\Http\Controllers\NewController@naiveBayes')->name('naive');

// redirect import1 to output

// return controller naive
Route::get('/naiveb', 'App\Http\Controllers\binance@naive')->name('naiveb');

// route to controller predict
Route::get('/predict', 'App\Http\Controllers\NewController@predict')->name('predict');

// route to controller naive
Route::get('/naive', 'App\Http\Controllers\NewController@naive')->name('naive');

// route to controller accuracy
Route::get('/accuracy', 'App\Http\Controllers\NewController@accuracy')->name('accuracy');

// route to controller recall
Route::get('/recall', 'App\Http\Controllers\NewController@recall')->name('recall');

// route to controller precision
Route::get('/precision', 'App\Http\Controllers\NewController@precision')->name('precision');

// route to controller f1
Route::get('/f1', 'App\Http\Controllers\NewController@f1')->name('f1');

// route to controller errRate
Route::get('/errate', 'App\Http\Controllers\ErrRate@errate')->name('errate');
Route::get('/errate1', 'App\Http\Controllers\ErrRate@errate1')->name('errate1');
