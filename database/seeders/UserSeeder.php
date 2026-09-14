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

        DB::table('users')->insert([
            [
                'id' => $uuid1,
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456')
            ]
        ]);
    }
}
