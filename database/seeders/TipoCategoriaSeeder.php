<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_categorias')->insert([
            ['descricao' => 'Receita'],
            ['descricao' => 'Despesa'],
            ['descricao' => 'Investimento'],
            ['descricao' => 'Ambos']
        ]);
    }
}
