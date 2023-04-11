<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErrRate extends Controller
{
    //Error rate
    public function errate()
    {
        // truncate the table
        DB::table('err_rate')->truncate();
        // get date and high from Master
        $master = DB::table('Master')->select('date', 'high')->get();
        // get date and high value from sma
        $sma = DB::table('sma')->select('date', 'sma_high')->get();
        // loop through master and sma and compare the values based on date
        // cpunt master and sma

        foreach ($master as $m) {
            foreach ($sma as $s) {
                if ($m->date == $s->date) {
                    // minus the values to get the err value
                    $err = abs($m->high - $s->sma_high); // calculate absolute error value
                    // insert the error value into the database err_rate
                    DB::table('err_rate')->insert([
                        'date' => $m->date,
                        'err_rate' => $err,
                    ]);
                }
            }
        }
        $r = $this->getAvgErrRate();
        return $r;
    }
    public function errate1()
    {
        // truncate the table
        DB::table('err_rate')->truncate();
        // get date and high from Master
        $master = DB::table('Binance')->select('date', 'high')->get();
        // get date and high value from sma
        $sma = DB::table('sma')->select('date', 'sma_high')->get();
        // loop through master and sma and compare the values based on date
        // cpunt master and sma

        foreach ($master as $m) {
            foreach ($sma as $s) {
                if ($m->date == $s->date) {
                    // minus the values to get the err value
                    $err = abs($m->high - $s->sma_high); // calculate absolute error value
                    // insert the error value into the database err_rate
                    DB::table('err_rate')->insert([
                        'date' => $m->date,
                        'err_rate' => $err,
                    ]);
                }
            }
        }
        $r = $this->getAvgErrRate();
        return $r;
    }

    // get average error rate
    public function getAvgErrRate()
    {
        // sum all data from err_rate
        $sum = DB::table('err_rate')->sum('err_rate');
        // count all data from err_rate
        $count = DB::table('err_rate')->count();
        // divide sum by count to get average
        $avg = $sum / $count;

        return $avg;
    }


}