<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use SoftDeletes;

    protected $table = 'lancamentos';

    protected $fillable = [
        'tipo',
        'descricao',
        'valor',
        'categoria_id',
        'data_vencimento',
        'dia_pagamento',
        'is_pago',
        'data_pagamento',
        'responsavel',
        'observacao',
        'link_pagamento',
        'cadastrado_por_usuario',
        'is_parcelado',
        'parcela_atual',
        'total_parcelas',
        'valor_parcela',
        'grupo_parcelamento',
        'is_fixo',
        'valor_deborah',
        'valor_wangley',
        'valor_casal',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'valor_parcela' => 'decimal:2',
        'valor_deborah' => 'decimal:2',
        'valor_wangley' => 'decimal:2',
        'valor_casal' => 'decimal:2',
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'is_pago' => 'boolean',
        'is_parcelado' => 'boolean',
        'is_fixo' => 'boolean',
        'dia_pagamento' => 'integer',
        'parcela_atual' => 'integer',
        'total_parcelas' => 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cadastrado_por_usuario');
    }
}
