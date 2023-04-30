<?php

use App\Http\Controllers\NewController;
use App\Http\Controllers\ErrRate;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Binance;
use App\Http\Controllers\Bitcoin;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registrationController;


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


// Register Controller route
Route::post('/registerSend', [registrationController::class, 'register'])->name('registerPost');
// Login Controller route
Route::post('/loginSend', [loginController::class, 'authenticate'])->name('loginPost');
// Logout Controller route
Route::get('/logout', [loginController::class, 'logout'])->name('logout');


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

Route::middleware(['auth.user'])->group(function () {
    // your protected routes go here
// route to register page
    Route::get('/menu', function () {
        return view('menu-master');
    })->name('mmaster');


    //Menu group
    Route::prefix('menu')->group(function () {
        // route to bitcoin
        Route::get('akurasi', [Bitcoin::class, 'index'])
            ->name('akurasi.index');
        // route to bianceconmtroller index
        Route::get('prediksi', function () {
            return view('menu.master');
        })->name('prediksi.index');
    });

    // Route to controller
    Route::post('/import', 'App\Http\Controllers\NewController@import');
    // import 1 in controller Binance
    Route::post('/import1', 'App\Http\Controllers\Binance@import1')->name('import1');
    // import 2 in controller Bitcoin
    Route::post('/import2', 'App\Http\Controllers\Bitcoin@import2')->name('import2');


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

        // Route to viewAccurary
        Route::get('/outputAkurasi', 'App\Http\Controllers\NewController@viewAccuracy')->name('viewAccuracy');
});