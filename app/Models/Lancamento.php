<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use SoftDeletes;

    protected $table = 'lancamentos';

    protected $fillable = [
        'tipo', 'competencia', 'descricao', 'valor','data_vencimento', 'is_receber','is_pago', 'data_pagamento',
        'observacao', 'link_pagamento', 'is_parcelado', 'parcela_atual', 'total_parcelas', 'valor_parcela', 'grupo_parcelamento',
        'is_fixo', 'valor_deborah', 'valor_wangley', 'valor_casal', 'deborah_falta_pagar', 'wangley_falta_pagar', 'tipo_categoria_id',
        'responsavel_id', 'cadastrado_por_usuario', 'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function tipoCategoria()
    {
        return $this->belongsTo(TipoCategoria::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cadastrado_por_usuario');
    }

    public function responsavel()
    {
        return $this->belongsTo(Responsavel::class, 'responsavel_id');
    }
}

