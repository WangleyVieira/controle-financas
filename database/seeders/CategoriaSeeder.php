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
            ['descricao' => 'Aluguel'           ],
            ['descricao' => 'Empréstimo'        ],
            ['descricao' => 'Cartão de Crédito' ],
            ['descricao' => 'Alimentação'       ],
            ['descricao' => 'Veículo'           ],
            ['descricao' => 'Beleza'            ],
            ['descricao' => 'Saúde'             ],
            ['descricao' => 'Educação'          ],
            ['descricao' => 'Conta de Luz'      ],
            ['descricao' => 'Conta de Água'     ],
            ['descricao' => 'Conta de Internet' ],
            ['descricao' => 'Compras Variadas'  ],
            ['descricao' => 'Assinatura'        ],
            ['descricao' => 'Lazer'             ],
            ['descricao' => 'Salário'           ],
            ['descricao' => 'Renda Extra'       ],
            ['descricao' => 'Outros'            ],
        ]);
    }
}
