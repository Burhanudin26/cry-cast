<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    //Binance
    public function import1(Request $request)
    {
    $file = $request->file('csv_input_binance');
    if($file && $file->isValid()){
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $table = 'binance';
        DB::table($table)->truncate();
        foreach ($data as $row) {
            DB::table($table)->insert([
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}}
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
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}}
    //Dogecoin
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
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}}
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
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}}
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
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}}
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
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
    ]);}}}
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
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
            ]);}}}
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
                'high' => is_numeric($row[4]) ? $row[4] : 0,
                'low' => is_numeric($row[5]) ? $row[5] : 0,
                'volume' => is_numeric($row[8]) ? $row[8] : 0,
            ]);}}}
    //Simple Moving Average
    public function SMA(){
    }

    // get high data
    public function getHighData(Request $request){
        // get data as array from table binance and cokumn high and column id
        $showAll = $request->input('showAll', false);
        if ($request->input('showAll')) {
            $data = DB::table('binance')->select('high')->get();
            $id = DB::table('binance')->select('id')->get();
        } else {
            // only show 30 latest data
            $data = DB::table('binance')->select('high')->orderBy('id', 'desc')->limit(30)->get();
            $id = DB::table('binance')->select('id')->orderBy('id', 'desc')->limit(30)->get();

        }

        return view('output', compact('data', 'id', 'showAll'));

    }
}