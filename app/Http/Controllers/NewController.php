<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    public function import(Request $request)
    {
    $file = $request->file('csv_input');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'crypto';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);
}
}
    }}