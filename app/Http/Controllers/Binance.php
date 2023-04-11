<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Binance extends Controller
{
        public function index(Request $request){
        // minim date in table binance
        $minDate = DB::table('binance')->min('date');
        $maxDate = DB::table('binance')->max('date');
        return view('menu.binance', compact('minDate', 'maxDate'));
        }
}
