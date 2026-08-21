<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use SoftDeletes;

    protected $table = 'lancamentos';

    protected $fillable = [
        'tipo', 'competencia', 'descricao', 'valor', 'valor_pago', 'data_vencimento', 'is_receber', 'is_pago', 'data_pagamento',
        'observacao', 'link_pagamento', 'is_parcelado', 'parcela_atual', 'total_parcelas', 'valor_parcela', 'grupo_parcelamento',
        'is_fixo', 'tipo_categoria_id', 'cadastrado_por_usuario', 'categoria_id'
    ];

    protected function casts(): array
    {
        return [
            'data_vencimento' => 'date',
            'data_pagamento' => 'date',
            'valor' => 'decimal:2',
            'valor_pago' => 'decimal:2',
            'is_pago' => 'boolean',
            'is_parcelado' => 'boolean',
            'is_fixo' => 'boolean',
        ];
    }

    public function getSituacaoAttribute(): string
    {
        if ($this->valor_pago !== null && (float) $this->valor_pago >= (float) $this->valor) {
            return 'pago';
        }

        if ($this->valor_pago !== null && (float) $this->valor_pago > 0) {
            return 'parcial';
        }

        return $this->data_vencimento->isPast() ? 'vencido' : 'pendente';
    }

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

}
