<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PhpOption\None;
use Symfony\Component\Console\Output\Output;

class NewController extends Controller
{
    // get trend SMA
    public function getHighData($nama_table)
    {
        // get data as array from table binance and column high and column id
        $data = DB::table($nama_table)->select('high')->get();
        $trend = DB::table('SMA')->select('sma_high')->get();

        // get data as array from table binance and column low and column id
        $low_data = DB::table($nama_table)->select('low')->get();
        $low_trend = DB::table('SMA')->select('sma_low')->get();

        // get data as array from table binance and column volume and column id
        $volume_data = DB::table($nama_table)->select('volume')->get();
        $volume_trend = DB::table('SMA')->select('sma_volume')->get();
        $date = DB::table($nama_table)->select('date')->get();

        // get oyutput in function BB
        $output = $this->BB($nama_table);
        // get output in function bayes
        $outputb = $this->naive();
        return view('output')->with(compact('data', 'trend', 'low_data', 'low_trend', 'volume_data', 'volume_trend', 'date', 'output', 'outputb'));
    }
    //Mencari rata-rata low, high, volume setiap 5 kolom
    public function AverageAll($nama_table)
    {
        // Create a PDO connection to the database
        $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');

        // Prepare the SQL query to get the low, high, and volume values from the binance table in groups of 5
        $stmt = $db->prepare('SELECT low, high, volume FROM ?');

        // Execute the query
        $stmt->execute();

        // Fetch the result as an array of rows
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // priod SMA
        $priod = 5;

        // Initialize arrays to hold the average values for each column
        $avg_lows = array();
        $avg_highs = array();
        $avg_volumes = array();
        DB::table('AverageAll')->truncate();
        // Calculate the average values for each column for each group of $priod rows
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $low = $row['low'];
            $high = $row['high'];
            $volume = $row['volume'];

            // Add the current row's values to their respective arrays
            $avg_lows[] = $low;
            $avg_highs[] = $high;
            $avg_volumes[] = $volume;

            // If we've reached a group of 5 rows, calculate the averages and insert them into the SMA table
            if (count($avg_lows) == $priod && count($avg_highs) == $priod && count($avg_volumes) == $priod) {
                $avg_low = array_sum($avg_lows) / count($avg_lows);
                $avg_high = array_sum($avg_highs) / count($avg_highs);
                $avg_volume = array_sum($avg_volumes) / count($avg_volumes);

                // Prepare the SQL query to insert the average values into the AverageAll table
                $insert_stmt = $db->prepare('INSERT INTO AverageAll (avg_low, avg_high, avg_volume) VALUES (:avg_low, :avg_high, :avg_volume)');

                // Bind the average values to the query parameters
                $insert_stmt->bindParam(':avg_low', $avg_low);
                $insert_stmt->bindParam(':avg_high', $avg_high);
                $insert_stmt->bindParam(':avg_volume', $avg_volume);

                // Execute the query to insert the average values into the SMA table
                $insert_stmt->execute();

                // Clear the arrays of average values
                $avg_lows = array();
                $avg_highs = array();
                $avg_volumes = array();
                $i = $i - ($priod - 1);
            }
        }
        $this->HitungSMA($nama_table);
    }
    //mencari Simple Moving Average
    public function HitungSMA($nama_table)
    {
        // Create a PDO connection to the database
        $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');

        // Prepare the SQL query to get the low, high, and volume values from the binance table in groups of 5
        $stmt = $db->prepare('SELECT avg_low, avg_high, avg_volume FROM averageall');

        // Execute the query
        $stmt->execute();

        // Fetch the result as an array of rows
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize arrays to hold the average values for each column
        $sma_lows = array();
        $sma_highs = array();
        $sma_volumes = array();
        DB::table('SMA')->truncate();
        for ($i = 0; $i < 8; $i++) {
            $insert_stmt = $db->prepare('INSERT INTO SMA (sma_low, sma_high, sma_volume) VALUES (0, 0, 0)');
            $insert_stmt->execute();
        }
        // Calculate the average values for each column for each group of 5 rows
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $smalow = $row['avg_low'];
            $smahigh = $row['avg_high'];
            $smavolume = $row['avg_volume'];

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
                $insert_stmt = $db->prepare('INSERT INTO SMA (sma_low, sma_high, sma_volume) VALUES (:sma_low, :sma_high, :sma_volume)');

                // Bind the average values to the query parameters
                $insert_stmt->bindParam(':sma_low', $sma_low);
                $insert_stmt->bindParam(':sma_high', $sma_high);
                $insert_stmt->bindParam(':sma_volume', $sma_volume);

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
    public function Threshold($nama_table)
    {
        // Create a PDO connection to the database
        $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');

        // Prepare the SQL query to get the monthly averages of low, high, and volume from the binance table
        $stmt = $db->prepare('SELECT DATE_FORMAT(date, "%Y-%m-01") AS month, AVG(low) AS avg_low, AVG(high) AS avg_high, AVG(volume) AS avg_volume FROM binance GROUP BY month');

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
        $this->bayes();
    }

    // Membuat bullish dan bearish pada moving average
    public function BB($nama_table)
    {

        $sma = DB::table('SMA')->orderBy('id', 'desc')->take(2)->get();
        $high = DB::table($nama_table)->orderBy('id', 'desc')->take(2)->get();
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
    public function bayes()
    {
        // Get the threshold data for each month
        $thresholds = DB::table('threshold')->get();
        // truncate the data
        DB::table('bayes')->truncate();
        // Loop through each month
        foreach ($thresholds as $threshold) {
            // Get the month and year from the threshold date
            $month = date('m', strtotime($threshold->date));
            $year = date('Y',
                strtotime($threshold->date)
            );

            // Get the start and end date for the month
            $startDate = $year . '-' . $month . '-01';
            $endDate = date('Y-m-t', strtotime($startDate));

            // Get the binance data for the month
            $binanceData = DB::table('binance')
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

            // Loop through each day in the month
            foreach ($binanceData as $key => $data) {
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

                // Compare current and next day high values
                $nextKey = $key + 1;
                if ($nextKey < count($binanceData) && $binanceData[$nextKey]->high > $data->high) {
                    $hargavalue = 1;
                } else {
                    $hargavalue = 0;
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
        $this->naive();
    }

    // naive bayes output count for each day
    public function naive()
    {
        // get the high from bayes and count check if match with harga
        $high = DB::table('bayes')->where('high', 1)->where('harga', 1)->count();
        // high 0
        $high0 = DB::table('bayes')->where('high', 0)->where('harga', 0)->count();
        // high 1 0
        $high1 = DB::table('bayes')->where('high', 1)->where('harga', 0)->count();
        // high 0 1
        $high01 = DB::table('bayes')->where('high',
            0
        )->where('harga', 1)->count();
        // low 1
        $low = DB::table('bayes')->where('low', 1)->where('harga', 1)->count();
        // low 0
        $low0 = DB::table('bayes')->where('low', 0)->where('harga', 0)->count();
        // low 1 0
        $low1 = DB::table('bayes')->where('low', 1)->where('harga', 0)->count();
        // low 0 1
        $low01 = DB::table('bayes')->where('low', 0)->where('harga', 1)->count();
        // volume 1
        $volume = DB::table('bayes')->where('volume', 1)->where('harga', 1)->count();
        // volume 0
        $volume0 = DB::table('bayes')->where('volume', 0)->where('harga', 0)->count();
        // volume 1 0
        $volume1 = DB::table('bayes')->where('volume', 1)->where('harga', 0)->count();
        // volume 0 1
        $volume01 = DB::table('bayes')->where('volume', 0)->where('harga', 1)->count();

        // total high 1 1 and 0 0
        $totalhigh = $high + $high1;
        // total high 0 1 and 1 0
        $totalhigh0 = $high0 + $high01;
        // total low 1 1 and 0 0
        $totallow = $low + $low1;
        // total low 0 1 and 1 0
        $totallow0 = $low0 + $low01;
        // total volume 1 1 and 0 0
        $totalvolume = $volume + $volume1;
        // total volume 0 1 and 1 0
        $totalvolume0 = $volume0 + $volume01;

        // total high 11 and 01
        $totalhigh1 = $high + $high01;
        // total high 10 and 00
        $totalhigh2 = $high0 + $high1;
        // total low 11 and 01
        $totallow1 = $low + $low01;
        // total low 10 and 00
        $totallow2 = $low0 + $low1;
        // total volume 11 and 01
        $totalvolume1 = $volume + $volume01;
        // total volume 10 and 00
        $totalvolume2 = $volume0 + $volume1;

        // sum all total high
        $totalhigh3 = $totalhigh + $totalhigh0 +

        // sum all total high
        $totalhigh3 = $totalhigh + $totalhigh0 + $totalhigh1 + $totalhigh2;
        // sum all total low
        $totallow3 = $totallow + $totallow0 + $totallow1 + $totallow2;
        // sum all total volume
        $totalvolume3 = $totalvolume + $totalvolume0 + $totalvolume1 + $totalvolume2;

        // predictor priror probability
        $p1 = $totalhigh / $totalhigh3;
        $p2 = $totalhigh2 / $totalhigh3;
        $p11 = $totalhigh1 / $totalhigh3;
        $p12 = $totalhigh0 / $totalhigh3;

        $p3 = $totallow / $totallow3;
        $p4 = $totallow2 / $totallow3;
        $p13 = $totallow1 / $totallow3;
        $p14 = $totallow0 / $totallow3;

        $p5 = $totalvolume / $totalvolume3;
        $p6 = $totalvolume2 / $totalvolume3;
        $p15 = $totalvolume1 / $totalvolume3;
        $p16 = $totalvolume0 / $totalvolume3;

        // output naive bayes algorithm where high 1 and low 1 and volume 1 use the predictor prior probability the output must no more than 1
        $output = $p1 * $p3 * $p5;
        $outputa = $output * 100;


        return $outputa;

    }
    //Binance
    public function import1(Request $request)
    {
        $file = $request->file('csv_input_binance');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $data = array_slice($data, 1); // skip the first row
            $nama_table = "binance";
            DB::table($nama_table)->where('id', '<>', 'admin')->delete();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }

    //Bitcoin
    public function import2(Request $request)
    {
        $file = $request->file('csv_input_bitcoin');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $nama_table = 'bitcoin';
            DB::table($nama_table)->truncate();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }
    // Dogecoin
    public function import3(Request $request)
    {
        $file = $request->file('csv_input_dogecoin');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $nama_table = 'dogecoin';
            DB::table($nama_table)->truncate();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }
    //Etherium
    public function import4(Request $request)
    {
        $file = $request->file('csv_input_etherium');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $nama_table = 'etherium';
            DB::table($nama_table)->truncate();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }
    //Iota
    public function import5(Request $request)
    {
        $file = $request->file('csv_input_iota');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $nama_table = 'iota';
            DB::table($nama_table)->truncate();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }
    //Solana
    public function import6(Request $request)
    {
        $file = $request->file('csv_input_solana');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $nama_table = 'solana';
            DB::table($nama_table)->truncate();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }
    //Stellar
    public function import7(Request $request)
    {
        $file = $request->file('csv_input_stellar');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $nama_table = 'stellar';
            DB::table($nama_table)->truncate();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }
    //Tron
    public function import8(Request $request)
    {
        $file = $request->file('csv_input_tron');
        if ($file && $file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $nama_table = 'tron';
            DB::table($nama_table)->truncate();
            foreach ($data as $row) {
                DB::table($nama_table)->insert([
                    'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                    'high' => is_numeric($row[4]) ? $row[4] : 0,
                    'low' => is_numeric($row[5]) ? $row[5] : 0,
                    'volume' => is_numeric($row[8]) ? $row[8] : 0,
                ]);
            }
        }
        $this->AverageAll($nama_table);
        $this->Threshold($nama_table);
        $this->getHighData($nama_table);
        // redirect to the page to display the results output
        return redirect()->route('output');
    }
}
