<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LancamentoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tipo' => ['nullable', 'in:entrada,gasto'],
            'descricao' => ['required', 'string', 'min:3', 'max:255'],
            'valor' => ['required', 'string'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'tipo_categoria_id' => ['required', 'integer', 'exists:tipo_categorias,id'],
            'data_vencimento' => ['required', 'date'],
            'dia_pagamento' => ['nullable', 'integer', 'between:1,31'],
            'is_pago' => ['nullable', 'boolean'],
            'data_pagamento' => ['nullable', 'date'],
            'responsavel_id' => ['required', 'integer'],
            'observacao' => ['nullable', 'string'],
            'link_pagamento' => ['nullable', 'url', 'max:2048'],
            'is_parcelado' => ['nullable', 'boolean'],
            'parcela_atual' => ['nullable', 'integer', 'min:1'],
            'total_parcelas' => ['nullable', 'integer', 'min:1'],
            'valor_parcela' => ['nullable', 'string'],
            'is_fixo' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Descricao e obrigatoria.',
            'categoria_id.required' => 'Categoria é obrigatoria.',
            'categoria_id.exists' => 'Categoria invalida.',
            'data_vencimento.required' => 'Data de vencimento e obrigatoria.',
            'link_pagamento.url' => 'Link de pagamento invalido.',
            'dia_pagamento.between' => 'Dia de pagamento deve estar entre 1 e 31.',
            'tipo_categoria_id.required' => 'Tipo de categoria e obrigatorio.',
            'reponsavel_id.required' => 'Responsavel é obrigatorio.',
            'responsavel_id.integer' => 'Responsavel deve ser um numero inteiro.',
        ];
    }
}
