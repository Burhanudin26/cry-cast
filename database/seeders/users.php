<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate users
        DB::table('users')->truncate();
        $users = [
            [
                'name' => 'Avan',
                'email' => 'AvanCry1@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('AvanCry1'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alvalen',
                'email' => 'AlvalenCry2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('AlvalenCry2'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yusuf',
                'email' => 'YusufCry3@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('YusufCry3'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Azarya',
                'email' => 'AzaryaCry4@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('AzaryaCry4'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('users')->insert($users);
    }
}