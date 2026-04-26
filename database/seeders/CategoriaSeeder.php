<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['descricao' => 'Moradia / Aluguel',           'tipo_categoria_id' => 2],
            ['descricao' => 'Empréstimo',                  'tipo_categoria_id' => 2],
            ['descricao' => 'Cartão de Crédito',           'tipo_categoria_id' => 2],
            ['descricao' => 'Alimentação',                 'tipo_categoria_id' => 2],
            ['descricao' => 'Veículo',                     'tipo_categoria_id' => 2],
            ['descricao' => 'Saúde / Beleza',              'tipo_categoria_id' => 2],
            ['descricao' => 'Educação',                    'tipo_categoria_id' => 2],
            ['descricao' => 'Contas (água/luz/internet)',  'tipo_categoria_id' => 2],
            ['descricao' => 'Compras Variadas',            'tipo_categoria_id' => 2],
            ['descricao' => 'Lazer / Assinatura',          'tipo_categoria_id' => 2],
            ['descricao' => 'Salário',                     'tipo_categoria_id' => 1],
            ['descricao' => 'Renda Extra',                 'tipo_categoria_id' => 1],
            ['descricao' => 'Outros',                      'tipo_categoria_id' => 3],
        ]);
    }
}
