<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErrRate extends Controller
{
    //Error rate
    public function errate()
    {
        // get date and high from Master
        $master = DB::table('Master')->select('date', 'high')->get();
        // get date and high value from sma
        $sma = DB::table('sma')->select('date', 'sma_high')->get();
        // loop through master and sma and compare the values based on date
        foreach ($master as $m) {
            foreach ($sma as $s) {
                if ($m->date == $s->date) {
                    // if the values are not the same, add to error count
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
    // Function to get the average of error rates
    public function getAvgErrRate()
    {
        // Query the err_rate table to get all the error rate values
        $errRates = DB::table('err_rate')->select('err_rate')->get();
        $totalErr = 0;
        $count = 0;

        // Loop through the error rate values and calculate the total error and count
        foreach ($errRates as $errRate) {
            $totalErr += $errRate->err_rate;
            $count++;
        }

        // Calculate the average error rate
        $avgErrRate = ($count > 0) ? $totalErr / $count : 0;

        return $avgErrRate;
    }

    }

