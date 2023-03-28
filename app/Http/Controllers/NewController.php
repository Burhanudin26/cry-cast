<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PhpOption\None;

class NewController extends Controller
{
    // get trend SMA
    public function getHighData(){
        // get data as array from table binance and column high and column id
        $data = DB::table('binance')->select('high')->get();
        $trend = DB::table('SMA')->select('sma_high')->get();

        // get data as array from table binance and column low and column id
        $low_data = DB::table('binance')->select('low')->get();
        $low_trend = DB::table('SMA')->select('sma_low')->get();

        // get data as array from table binance and column volume and column id
        $volume_data = DB::table('binance')->select('volume')->get();
        $volume_trend = DB::table('SMA')->select('sma_volume')->get();
        $date = DB::table('binance')->select('date')->get();

        // get oyutput in function BB
        $output = $this->BB();
        return view('output')->with(compact('data','trend','low_data','low_trend','volume_data','volume_trend','date', 'output'));
    }
    //Mencari rata-rata low, high, volume setiap 5 kolom
    public function AverageAll()
    {
        // Create a PDO connection to the database
        $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');

        // Prepare the SQL query to get the low, high, and volume values from the binance table in groups of 5
        $stmt = $db->prepare('SELECT low, high, volume FROM binance');

        // Execute the query
        $stmt->execute();

        // Fetch the result as an array of rows
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize arrays to hold the average values for each column
        $avg_lows = array();
        $avg_highs = array();
        $avg_volumes = array();
        DB::table('AverageAll')->truncate();
        // Calculate the average values for each column for each group of 5 rows
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
            if (count($avg_lows)==5 && count($avg_highs)==5 && count($avg_volumes)==5) {
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
                $i=$i-4;
            }
        }
        $this->HitungSMA();
    }
    //mencari Simple Moving Average
    public function HitungSMA()
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
        for($i=0; $i < 8; $i++){
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
            if (count($sma_lows)==5 && count($sma_highs)==5 && count($sma_volumes)==5) {
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
                $i=$i-4;
            }
        }
        $this->getHighData();
    }

    //Threshold Naive bayes per bulan
<<<<<<< HEAD
    public function Threshold()
    {
        // Create a PDO connection to the database
    $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');
=======
    //     public function Threshold()
    //     {
    //         // Create a PDO connection to the database
    //     $db = new PDO('mysql:host=localhost;dbname=crypto', 'root', '');
>>>>>>> 5cb1a81510c93a8529ab473fdd592f8fc57fe934

    //     // Prepare the SQL query to get the low, high, and volume values from the binance table grouped by month
    //     $stmt = $db->prepare('SELECT YEAR(date) AS year, MONTH(date) AS month, AVG(low) AS avg_low, AVG(high) AS avg_high, AVG(volume) AS avg_volume FROM binance GROUP BY YEAR(date), MONTH(date)');

    //     // Execute the query
    //     $stmt->execute();

    //     // Fetch the result as an array of rows
    //     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     // Loop through each row and insert the monthly averages into the MonthlyAverages table
    //     foreach ($rows as $row) {
    //         $year = $row['year'];
    //         $month = $row['month'];
    //         $avg_low = $row['avg_low'];
    //         $avg_high = $row['avg_high'];
    //         $avg_volume = $row['avg_volume'];

    //         // Prepare the SQL query to insert the average values into the MonthlyAverages table
    //         $insert_stmt = $db->prepare('INSERT INTO MonthlyAverages (year, month, avg_low, avg_high, avg_volume) VALUES (:year, :month, :avg_low, :avg_high, :avg_volume)');

    //         // Bind the average values to the query parameters
    //         $insert_stmt->bindParam(':year', $year);
    //         $insert_stmt->bindParam(':month', $month);
    //         $insert_stmt->bindParam(':avg_low', $avg_low);
    //         $insert_stmt->bindParam(':avg_high', $avg_high);
    //         $insert_stmt->bindParam(':avg_volume', $avg_volume);

<<<<<<< HEAD
        // Execute the query to insert the average values into the MonthlyAverages table
        $insert_stmt->execute();
    }
}
    //Membuat bullish dan bearish pada moving average
    public function BB(){
        
=======
    //         // Execute the query to insert the average values into the MonthlyAverages table
    //         $insert_stmt->execute();
    //     }
    // }
    //Membuat bullish dan bearish pada moving average
    public function BB()
    {

        $sma = DB::table('SMA')->orderBy('id', 'desc')->take(2)->get();
        $high = DB::table('binance')->orderBy('id', 'desc')->take(2)->get();
        $sma1 = $sma[0]->sma_high;
        $sma2 = $sma[1]->sma_high;
        $high1 = $high[0]->high;
        $high2 = $high[1]->high;
        if (($high2 > $sma2) && ($high1 < $sma1)) {
            $output = 'menuju naik';
        } else if (($high2 < $sma2) && ($high1 > $sma1)) {
            $output = 'menuju turun';
        } else if ($high1 > $sma1) {
            $output = 'naik';
        } else if ($high1 < $sma1) {
            $output = 'turun';
        } else {
            $output = '';
        }

        return $output;
>>>>>>> 5cb1a81510c93a8529ab473fdd592f8fc57fe934
    }



    //Binance
    public function import1(Request $request)
    {
    $file = $request->file('csv_input_binance');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $data = array_slice($data, 1); // skip the first row
        $table = 'binance';
        DB::table('binance')->where('id', '<>','admin')->delete();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}
    $this->AverageAll();
    // $this->Threshold();
    // redirect to the page to display the results output
    return redirect()->route('output');
}

    //Bitcoin
    public function import2(Request $request)
    {
    $file = $request->file('csv_input_bitcoin');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'bitcoin';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}
    $this->AverageAll();
}
    // Dogecoin
    public function import3(Request $request)
    {
    $file = $request->file('csv_input_dogecoin');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'dogecoin';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}
    $this->AverageAll();
}
    //Etherium
    public function import4(Request $request)
    {
    $file = $request->file('csv_input_etherium');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'etherium';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}
    $this->AverageAll();
}
    //Iota
    public function import5(Request $request)
    {
    $file = $request->file('csv_input_iota');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'iota';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}
    $this->AverageAll();
}
    //Solana
    public function import6(Request $request)
    {
    $file = $request->file('csv_input_solana');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'solana';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}
    $this->AverageAll();
}
    //Stellar
    public function import7(Request $request)
    {
    $file = $request->file('csv_input_stellar');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'stellar';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
            ]);}}
        $this->AverageAll();
    }
    //Tron
    public function import8(Request $request)
    {
    $file = $request->file('csv_input_tron');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'tron';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'date' => date('Y/m/d H:i:s', strtotime($row[3])),
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
            ]);}}
            $this->AverageAll();
        }


}