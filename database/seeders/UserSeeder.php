<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uuid1 = "26ce0b8c-c37c-4f79-926c-aa03af692886";
        $uuid2 = "20e40049-0bb4-44d2-a5dd-7f5edc8ba7da";

        DB::table('users')->insert([
            [
                'id' => $uuid1,
                'name' => 'Wangley',
                'email' => 'wangley@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'id' => $uuid2,
                'name' => 'Déborah',
                'email' => 'deborah@gmail.com',
                'password' => Hash::make('12345678')
            ]
        ]);
    }
}
