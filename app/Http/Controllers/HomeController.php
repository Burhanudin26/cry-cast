<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function import(Request $request)
    {
    $file = $request->file('csv_input');
    $path = $file->getRealPath();
    $data = array_map('str_getcsv', file($path));
    $table = 'crypto';
    DB::table($table)->truncate();
    foreach ($data as $row) {
        DB::table($table)->insert([
            'tanggal' => $row[3],
            'high' => $row[4],
            'low' => $row[5],
            'volume' => $row[8],

    ]);
}
return redirect('/csv')->with('success', 'CSV file imported successfully.');
}}
