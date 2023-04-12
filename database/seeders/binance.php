<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class binance extends Seeder
{
    public function run()
    {
        $path = storage_path('app/public/coin_Cardano.csv'); // Path to your CSV file
        $data = array_map('str_getcsv', file($path));
        $header = $data[0];
        $dateIndex = array_search('Date', $header);
        $highIndex = array_search('High', $header);
        $lowIndex = array_search('Low', $header);
        $volumeIndex = array_search('Volume', $header);
        // Remove header row from data
        $data = array_slice($data, 1);
        DB::table('binance')->truncate();
        foreach ($data as $row) {
            // Insert the data into the users table
            DB::table('Binance')->insert([
                'date' => date('Y/m/d', strtotime($row[$dateIndex])),
                'high' => is_numeric($row[$highIndex]) ? $row[$highIndex] : 0,
                'low' => is_numeric($row[$lowIndex]) ? $row[$lowIndex] : 0,
                'volume' => is_numeric($row[$volumeIndex]) ? $row[$volumeIndex] : 0,
                // Add more columns as needed
            ]);
        }
    }
}
