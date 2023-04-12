<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class Binance extends Controller
{
        public function index(Request $request){
        // minim date in table binance
        $minDate = DB::table('binance')->min('date');
        $maxDate = DB::table('binance')->max('date');
        return view('menu.binance', compact('minDate', 'maxDate'));
        }
    //mencari Simple Moving Average
    public function HitungSMA($table)
    {
        // Create a PDO connection to the database
        $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');

        // Prepare the SQL query to get the low, high, and volume values from the binance table in groups of 5
        $stmt = $db->prepare('SELECT date, low, high, volume FROM ' . $table);

        // Execute the query
        $stmt->execute();

        // Fetch the result as an array of rows
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize arrays to hold the average values for each column
        $sma_lows = array();
        $sma_highs = array();
        $sma_volumes = array();
        DB::table('SMA')->truncate();
        for ($i = 0; $i < 4; $i++) {
            $row = $rows[$i];
            $smadate = $row['date'];
            $insert_stmt = $db->prepare('INSERT INTO SMA (date,sma_low, sma_high, sma_volume) VALUES (:smadate,0, 0, 0)');
            $insert_stmt->bindParam(':smadate', $smadate);
            $insert_stmt->execute();

        }
        // Calculate the average values for each column for each group of $priod rows
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $smalow = $row['low'];
            $smahigh = $row['high'];
            $smavolume = $row['volume'];
            $smadate = $row['date'];

            // Add the current row's values to their respective arrays
            $sma_lows[] = $smalow;
            $sma_highs[] = $smahigh;
            $sma_volumes[] = $smavolume;

            // If we've reached a group of 5 rows, calculate the averages and insert them into the SMA table
            if (count($sma_lows) == 5 && count($sma_highs) == 5 && count($sma_volumes) == 5) {
                $sma_low = array_sum($sma_lows) / count($sma_lows);
                $sma_high = array_sum($sma_highs) / count($sma_highs);
                $sma_volume = array_sum($sma_volumes) / count($sma_volumes);

                // Prepare the SQL query to insert the average values into the SMA table
                $insert_stmt = $db->prepare('INSERT INTO SMA (date,sma_low, sma_high, sma_volume) VALUES (:smadate, :sma_low, :sma_high, :sma_volume)');

                // Bind the average values to the query parameters
                $insert_stmt->bindParam(':sma_low', $sma_low);
                $insert_stmt->bindParam(':sma_high', $sma_high);
                $insert_stmt->bindParam(':sma_volume', $sma_volume);
                $insert_stmt->bindParam(':smadate', $smadate);

                // Execute the query to insert the average values into the SMA table
                $insert_stmt->execute();

                // Clear the arrays of average values
                $sma_lows = array();
                $sma_highs = array();
                $sma_volumes = array();
                $i = $i - 4;
            }
        }
    }
    //Threshold Naive bayes per bulan
    public function Threshold($table)
    {
        // Create a PDO connection to the database
        $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');

        // Prepare the SQL query to get the monthly averages of low, high, and volume from the binance table
        $stmt = $db->prepare("SELECT DATE_FORMAT(date, '%Y-%m-01') AS month, AVG(low) AS avg_low, AVG(high) AS avg_high, AVG(volume) AS avg_volume FROM $table GROUP BY month");

        // Execute the query
        $stmt->execute();

        // Fetch the result as an array of rows
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        DB::table('threshold')->truncate();
        // Loop through each row and insert the monthly averages into the threshold table
        foreach ($rows as $row) {
            $month = $row['month'];
            $avg_low = $row['avg_low'];
            $avg_high = $row['avg_high'];
            $avg_volume = $row['avg_volume'];

            // Prepare the SQL query to insert the monthly averages into the threshold table
            $insert_stmt = $db->prepare('INSERT INTO threshold (date, hold_low, hold_high, hold_volume) VALUES (:date, :hold_low, :hold_high, :hold_volume)');

            // Bind the monthly averages to the query parameters
            $insert_stmt->bindParam(':date', $month);
            $insert_stmt->bindParam(':hold_low', $avg_low);
            $insert_stmt->bindParam(':hold_high', $avg_high);
            $insert_stmt->bindParam(':hold_volume', $avg_volume);

            // Execute the query to insert the monthly averages into the threshold table
            $insert_stmt->execute();
        }
        $this->bayes($table);
    }

    // Membuat bullish dan bearish pada moving average
    public function BB($table)
    {

        $sma = DB::table('SMA')->orderBy('id', 'desc')->take(2)->get();
        $high = DB::table($table)->orderBy('id', 'desc')->take(2)->get();
        $sma1 = $sma[0]->sma_high;
        $sma2 = $sma[1]->sma_high;
        $high1 = $high[0]->high;
        $high2 = $high[1]->high;
        if (($high2 > $sma2) && ($high1 < $sma1)) {
            $output = 'menuju turun';
        } else if (($high2 < $sma2) && ($high1 > $sma1)) {
            $output = 'menuju naik';
        } else if ($high1 > $sma1) {
            $output = 'naik';
        } else if ($high1 < $sma1) {
            $output = 'turun';
        } else {
            $output = '';
        }

        return $output;
    }

    // treshold check based on threshold table per month and iterate to chech per day in binance table
    public function bayes($table)
    {
        // Get the threshold data for each month
        $thresholds = DB::table('threshold')->get();
        // truncate the data
        DB::table('bayes')->truncate();
        // Loop through each month
        foreach ($thresholds as $threshold) {
            // Get the month and year from the threshold date
            $month = date('m', strtotime($threshold->date));
            $year = date(
                'Y',
                strtotime($threshold->date)
            );

            // Get the start and end date for the month
            $startDate = $year . '-' . $month . '-01';
            $endDate = date('Y-m-t', strtotime($startDate));

            // Get the binance data for the month
            $prevData = DB::table($table)
                ->whereBetween('date', [$startDate, $endDate])
                ->get();
            // Loop through each day in the month
            foreach ($prevData as $key => $data) {
                // Check if the value is above or below the threshold
                if ($data->high > $threshold->hold_high) {
                    $hvalue = 1;
                } else {
                    $hvalue = 0;
                }

                // condition for low
                if ($data->low > $threshold->hold_low) {
                    $lvalue = 1;
                } else {
                    $lvalue = 0;
                }

                // condition for volume
                if ($data->volume > $threshold->hold_volume) {
                    $vvalue = 1;
                } else {
                    $vvalue = 0;
                }
                $hargavalue = 0;
                // Loop through each day in the month
                // Check if this is the first row in the table
                if ($key == 0) {
                    // Set the harga value to 0 without comparing with previous day's high value
                    $hargavalue = 0;
                } else {
                    // Compare current and previous day's high values
                    if ($data->high > $prevData[$key - 1]->high) {
                        $hargavalue = 1;
                    } else {
                        $hargavalue = 0;
                    }
                }


                // Store the output in the bayes table
                DB::table('bayes')->insert([
                    'date' => $data->date,
                    'high' => $hvalue,
                    'low' => $lvalue,
                    'volume' => $vvalue,
                    'harga' => $hargavalue,
                ]);
            }
        }
        // select last high low vol data from bayes table
        $lastdata = DB::table('bayes')->orderBy('id', 'desc')->take(1)->get();
        $high = $lastdata[0]->high;
        $low = $lastdata[0]->low;
        $volume = $lastdata[0]->volume;
        $this->naive( $high, $low, $volume);
    }



    // naive bayes output count for each day
    public function naive($high=0, $low=0, $volume=1)
    {
           // class
        $harga1 = DB::table('bayes')->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $harga0 = DB::table('bayes')->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $hargatotal = DB::table('bayes')->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $Class1 = $harga1 / $hargatotal;
        $Class0 = $harga0 / $hargatotal;

        // high
        $high11 = DB::table('bayes')->where('high', 1)->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $high01 = DB::table('bayes')->where('high', 0)->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $high10 = DB::table('bayes')->where('high', 1)->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $high00 = DB::table('bayes')->where('high', 0)->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $hightotal1 = DB::table('bayes')->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $ph11 = $high11 / $hightotal1;
        $ph01 = $high01 / $hightotal1;
        $hightotal0 = DB::table('bayes')->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $ph10 = $high10 / $hightotal0;
        $ph00 = $high00 / $hightotal0;

        // low
        $low11 = DB::table('bayes')->where('low', 1)->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $low01 = DB::table('bayes')->where('low', 0)->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $low10 = DB::table('bayes')->where('low', 1)->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $low00 = DB::table('bayes')->where('low', 0)->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $lowtotal1 = DB::table('bayes')->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $pl11 = $low11 / $lowtotal1;
        $pl01 = $low01 / $lowtotal1;
        $lowtotal0 = DB::table('bayes')->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $pl10 = $low10 / $lowtotal0;
        $pl00 = $low00 / $lowtotal0;

        // volume
        $volume11 = DB::table('bayes')->where('volume', 1)->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $volume01 = DB::table('bayes')->where('volume', 0)->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $volume10 = DB::table('bayes')->where('volume', 1)->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $volume00 = DB::table('bayes')->where('volume', 0)->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $volumetotal1 = DB::table('bayes')->where('harga', 1)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $pv11 = $volume11 / $volumetotal1;
        $pv01 = $volume01 / $volumetotal1;
        $volumetotal0 = DB::table('bayes')->where('harga', 0)->whereNotBetween('id', [DB::table('bayes')->max('id') - 100, DB::table('bayes')->max('id')])->count();
        $pv10 = $volume10 / $volumetotal0;
        $pv00 = $volume00 / $volumetotal0;

        // output when up
        $output1111 = round((($ph11 * $pl11 * $pv11 * $Class1) / (($ph11 * $pl11 * $pv11 * $Class1) + ($ph10 * $pl10 * $pv10 * $Class0))) * 100, 2);
        $output1110 = round((($ph11 * $pl11 * $pv01 * $Class1) / (($ph11 * $pl11 * $pv01 * $Class1) + ($ph10 * $pl10 * $pv00 * $Class0))) * 100, 2);
        $output1100 = round((($ph11 * $pl01 * $pv01 * $Class1) / (($ph11 * $pl01 * $pv01 * $Class1) + ($ph10 * $pl00 * $pv00 * $Class0))) * 100, 2);
        $output1101 = round((($ph11 * $pl01 * $pv11 * $Class1) / (($ph11 * $pl01 * $pv11 * $Class1) + ($ph10 * $pl00 * $pv10 * $Class0))) * 100, 2);
        $output1001 = round((($ph01 * $pl11 * $pv11 * $Class1) / (($ph01 * $pl11 * $pv11 * $Class1) + ($ph00 * $pl10 * $pv10 * $Class0))) * 100, 2);
        $output1000 = round((($ph01 * $pl11 * $pv01 * $Class1) / (($ph01 * $pl11 * $pv01 * $Class1) + ($ph00 * $pl10 * $pv00 * $Class0))) * 100, 2);
        $output1010 = round((($ph01 * $pl01 * $pv01 * $Class1) / (($ph01 * $pl01 * $pv01 * $Class1) + ($ph00 * $pl00 * $pv00 * $Class0))) * 100, 2);
        $output1011 = round((($ph01 * $pl01 * $pv11 * $Class1) / (($ph01 * $pl01 * $pv11 * $Class1) + ($ph00 * $pl00 * $pv10 * $Class0))) * 100, 2);


        // output when down
        $output0111 = round((($ph10 * $pl10 * $pv10 * $Class0) / (($ph11 * $pl11 * $pv11 * $Class1) + ($ph10 * $pl10 * $pv10 * $Class0))) * 100, 2);
        $output0110 = round((($ph10 * $pl10 * $pv00 * $Class0) / (($ph11 * $pl11 * $pv01 * $Class1) + ($ph10 * $pl10 * $pv00 * $Class0))) * 100, 2);
        $output0100 = round((($ph10 * $pl00 * $pv00 * $Class0) / (($ph11 * $pl01 * $pv01 * $Class1) + ($ph10 * $pl00 * $pv00 * $Class0))) * 100, 2);
        $output0101 = round((($ph10 * $pl00 * $pv10 * $Class0) / (($ph11 * $pl01 * $pv11 * $Class1) + ($ph10 * $pl00 * $pv10 * $Class0))) * 100, 2);
        $output0001 = round((($ph00 * $pl10 * $pv10 * $Class0) / (($ph01 * $pl11 * $pv11 * $Class1) + ($ph00 * $pl10 * $pv10 * $Class0))) * 100, 2);
        $output0000 = round((($ph00 * $pl10 * $pv00 * $Class0) / (($ph01 * $pl11 * $pv01 * $Class1) + ($ph00 * $pl10 * $pv00 * $Class0))) * 100, 2);
        $output0010 = round((($ph00 * $pl00 * $pv00 * $Class0) / (($ph01 * $pl01 * $pv01 * $Class1) + ($ph00 * $pl00 * $pv00 * $Class0))) * 100, 2);
        $output0011 = round((($ph00 * $pl00 * $pv10 * $Class0) / (($ph01 * $pl01 * $pv11 * $Class1) + ($ph00 * $pl00 * $pv10 * $Class0))) * 100, 2);

        // // sum all o
        // $sum = $output1111 + $output1110 + $output1100 + $output1101 + $output1011 + $output1010 + $output1000 + $output1001 + $output0111 + $output0110 + $output0100 + $output0101 + $output0011 + $output0010 + $output0000 + $output0001;
        // return $sum;

        // detect feature from last table data and if match with the combination above, then show the result
        // $high = DB::table('bayes')->orderBy('id', 'desc')->first()->high;
        // $low = DB::table('bayes')->orderBy('id', 'desc')->first()->low;
        // $volume = DB::table('bayes')->orderBy('id', 'desc')->first()->volume;
        // $date = DB::table('bayes')->orderBy('id', 'desc')->first()->date;
        // print all output
        // echo all output
        // echo $output1111 . ' ' . $output1110 . ' ' . $output1100 . ' ' . $output1101 . ' ' . $output1011 . ' ' . $output1010 . ' ' . $output1000 . ' ' . $output1001 . ' ' . $output0111 . ' ' . $output0110 . ' ' . $output0100 . ' ' . $output0101 . ' ' . $output0011 . ' ' . $output0010 . ' ' . $output0000 . ' ' . $output0001;

        if ($high == 1 && $low == 1 && $volume == 1) {
            if ($output1111 > $output0111) {
                $result = 'Naik ' . $output1111;
            } else {
                $result = 'Turun ' . $output0111;
            }
        } elseif ($high == 1 && $low == 1 && $volume == 0) {
            if ($output1110 > $output0110) {
                $result = 'Naik ' . $output1110;
            } else {
                $result = 'Turun ' . $output0110;
            }
        } elseif ($high == 1 && $low == 0 && $volume == 0) {
            if ($output1100 > $output0100) {
                $result = 'Naik ' . $output1100;
            } else {
                $result = 'Turun ' . $output0100;
            }
        } elseif ($high == 1 && $low == 0 && $volume == 1) {
            if ($output1101 > $output0101) {
                $result = 'Naik ' . $output1101;
            } else {
                $result = 'Turun ' . $output0101;
            }
        } elseif ($high == 0 && $low == 1 && $volume == 1) {
            if ($output1011 > $output0011) {
                $result = 'Naik ' . $output1011;
            } else {
                $result = 'Turun ' . $output0011;
            }
        } elseif ($high == 0 && $low == 1 && $volume == 0) {
            if ($output1010 > $output0010) {
                $result = 'Naik ' . $output1010;
            } else {
                $result = 'Turun ' . $output0010;
            }
        } elseif ($high == 0 && $low == 0 && $volume == 0) {
            if ($output1000 > $output0000) {
                $result = 'Naik ' . $output1000;
            } else {
                $result = 'Turun ' . $output0000;
            }
        } else {
            if ($output1001 > $output0001) {
                $result = 'Naik ' . $output1001;
            } else {
                $result = 'Turun ' . $output0001;
            }
        }
        return $result;
    }
    public function accuracy()
    {
        $bayeses = DB::table('bayes')->get();
        $akurasis = DB::table('prediction')->select('date','hasil')->get();
        $count = 0;
        $total = DB::table('prediction')->count();
        foreach ($bayeses as $bayes) {
            foreach ($akurasis as $akurasi) {
                if ($bayes->date == $akurasi->date) {
                    if ($bayes->harga == $akurasi->hasil) {
                        $count++;
                    }
                }
            }
        }
        $accuracy = round(($count / $total) * 100, 2);
        return $accuracy;
    }

    public function predict()
    {
        // truncate table prediction
        DB::table('prediction')->truncate();
        // insert first row of data in table prediction
        $latestBayesData = DB::table('bayes')->orderBy('id', 'desc')->take(100)->get()->last();
        if ($latestBayesData) {
            $datep = $latestBayesData->date;
            $hasilp = $latestBayesData->harga;

            DB::table('prediction')->insert([
                'date' => $datep,
                'hasil' => $hasilp
            ]);
        }

        // count all data in table bitcoin and iterate
        $count = DB::table('bayes')->count();
        // get the last 100 records from the bayes table in ascending order
        $bayesData = DB::table('bayes')->orderBy('id', 'desc')->take(100)->get();
        // Convert collection to array
        $bayesData = $bayesData->toArray();
        // Reverse the array
        $bayesData = array_reverse($bayesData);
        // iterate the data and get the high, low, and volume data
        foreach ($bayesData as $data) {
            $high = $data->high;
            $low = $data->low;
            $volume = $data->volume;
            // get the output from function bayes
            $output = $this->naive($high, $low, $volume);
            // save the output in table prediction
            // check the output if first string Naik or Turun if Naik save 1 if Turun save 0
            if (substr($output, 0, 4) == 'Naik') {
                $output = 1;
            } else {
                $output = 0;
            }
            DB::table('prediction')->insert([
                'id' => $data->id + 1,
                // insert date to date but increment by 1 first
                'date' => date('Y-m-d', strtotime($data->date . ' + 1 days')),
                'hasil' => $output,
            ]);
        }
        // delete the last row of data in table prediction
        DB::table('prediction')->where('id', $count + 1)->delete();
        $p = $this->accuracy();
        return $p;
    }
    //Binance
    public function import1(Request $request)
    {
        $datei = $request->date;
        // validate date
        $this->validate($request, [
            'date' => 'required|date',
        ]);
        // convert date to string
        $datei = date('Y/m/d', strtotime($datei));

        $table = 'binance';
        $this->HitungSMA($table);
        $this->Threshold($table);
        $data = DB::table($table)->select('high')->get();
        $trend = DB::table('SMA')->select('sma_high')->get();

        // get data as array from table binance and column low and column id
        $low_data = DB::table($table)->select('low')->get();
        $low_trend = DB::table('SMA')->select('sma_low')->get();

        // get data as array from table binance and column volume and column id
        $volume_data = DB::table($table)->select('volume')->get();
        $volume_trend = DB::table('SMA')->select('sma_volume')->get();
        $date = DB::table($table)->select('date')->get();

        // get oyutput in function BB
        $output = $this->BB($table);
        // get output in function bayes

        // select high and low and volume from table binance based on date
        $bayesData = DB::table('bayes')
        ->where('date', '<', $datei) // Add condition to filter dates before $datei
        ->orderBy('id', 'desc')
        ->get();

        $high = $bayesData->first()->high;
        $low = $bayesData->first()->low;
        $volume = $bayesData->first()->volume;


        $outputb = $this->naive($high, $low, $volume);
        $akurasi = $this->predict();


        return view('outputmenu')->with(compact('data', 'trend', 'low_data', 'low_trend', 'volume_data', 'volume_trend', 'date', 'output', 'outputb', 'akurasi', 'datei'));
    }

}
