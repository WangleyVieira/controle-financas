<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LancamentoRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $valor = $this->input('valor');
        if (!empty($valor)) {
            $valor = str_replace(['.', ','], ['', '.'], $valor);
        }
        else {
            $valor = 0.0;
        }

        $this->merge([
            'valor' => $valor,
        ]);
    }

    public function rules(): array
    {
        return [
            'tipo' => ['nullable', 'in:entrada,gasto'],
            'competencia' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{4}$/'],
            'descricao' => ['required', 'string', 'min:3', 'max:255'],
            'valor' => ['required', 'decimal:2,10'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'tipo_categoria_id' => ['required', 'integer', 'exists:tipo_categorias,id'],
            'data_vencimento' => ['required', 'date'],
            'dia_pagamento' => ['nullable', 'integer', 'between:1,31'],
            'is_receber' => ['nullable', 'boolean'],
            'is_pago' => ['nullable', 'boolean'],
            'data_pagamento' => ['nullable', 'date', 'required_if:is_pago,1'],
            'observacao' => ['nullable', 'string'],
            'link_pagamento' => ['nullable', 'url', 'max:2048'],
            'is_parcelado' => ['nullable', 'boolean'],
            'parcela_atual' => ['nullable', 'integer', 'min:1'],
            'total_parcelas' => ['nullable', 'integer', 'min:1'],
            'valor_parcela' => ['nullable', 'numeric'],
            'is_fixo' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'valor.required' => 'Valor e obrigatorio.',
            'valor.decimal' => 'Valor deve ser um numero decimal com 2 casas decimais.',

            'valor.numeric' => 'Valor do Casal deve ser um numero.',

            'descricao.required' => 'Descricao e obrigatoria.',

            'competencia.required' => 'Competencia e obrigatoria.',
            'competencia.regex' => 'Competencia invalida. Use o formato MM/AAAA.',

            'categoria_id.required' => 'Categoria e obrigatoria.',
            'categoria_id.exists' => 'Categoria invalida.',

            'tipo_categoria_id.required' => 'Tipo de categoria e obrigatorio.',

            'data_vencimento.required' => 'Data de vencimento e obrigatoria.',

            'dia_pagamento.between' => 'Dia de pagamento deve estar entre 1 e 31.',

            'data_pagamento.required_if' => 'Data de pagamento e obrigatoria quando marcado como pago.',

            'link_pagamento.url' => 'Link de pagamento invalido.',
        ];
    }
}
