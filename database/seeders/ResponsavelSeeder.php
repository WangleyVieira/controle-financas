<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponsavelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('responsavels')->insert([
            ['nome' => 'Wangley'],
            ['nome' => 'Déborah'],
            ['nome' => 'Casal']
        ]);
    }
}
