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

        $valor_deborah = $this->input('valor_deborah');
        if (!empty($valor_deborah)) {
            $valor_deborah = str_replace(['.', ','], ['', '.'], $valor_deborah);
        }
        else {
            $valor_deborah = 0.0;
        }

        $this->merge([
            'valor_deborah' => $valor_deborah,
        ]);

        $valor_wangley = $this->input('valor_wangley');
        if (!empty($valor_wangley)) {
            $valor_wangley = str_replace(['.', ','], ['', '.'], $valor_wangley);
        }
        else {
            $valor_wangley = 0.0;
        }

        $this->merge([
            'valor_wangley' => $valor_wangley,
        ]);

        $valor_casal = $this->input('valor_casal');
        if (!empty($valor_casal)) {
            $valor_casal = str_replace(['.', ','], ['', '.'], $valor_casal);
        }
        else {
            $valor_casal = 0.0;
        }

        $this->merge([
            'valor_casal' => $valor_casal,
        ]);

        $deborah_falta_pagar = $this->input('deborah_falta_pagar');
        if (!empty($deborah_falta_pagar)) {
            $deborah_falta_pagar = str_replace(['.', ','], ['', '.'], $deborah_falta_pagar);
        }
        else {
            $deborah_falta_pagar = 0.0;
        }

        $this->merge([
            'deborah_falta_pagar' => $deborah_falta_pagar,
        ]);

        $wangley_falta_pagar = $this->input('wangley_falta_pagar');
        if (!empty($wangley_falta_pagar)) {
            $wangley_falta_pagar = str_replace(['.', ','], ['', '.'], $wangley_falta_pagar);
        }
        else {
            $wangley_falta_pagar = 0.0;
        }

        $this->merge([
            'wangley_falta_pagar' => $wangley_falta_pagar,
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
            'responsavel_id' => ['required', 'integer', 'exists:responsavels,id'],
            'observacao' => ['nullable', 'string'],
            'link_pagamento' => ['nullable', 'url', 'max:2048'],
            'is_parcelado' => ['nullable', 'boolean'],
            'parcela_atual' => ['nullable', 'integer', 'min:1'],
            'total_parcelas' => ['nullable', 'integer', 'min:1'],
            'valor_parcela' => ['nullable', 'numeric'],
            'is_fixo' => ['nullable', 'boolean'],
            'valor_deborah' => ['nullable', 'numeric'],
            'valor_wangley' => ['nullable', 'numeric'],
            'valor_casal' => ['nullable', 'numeric'],
            'deborah_falta_pagar' => ['nullable', 'numeric'],
            'wangley_falta_pagar' => ['nullable', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'valor.required' => 'Valor e obrigatorio.',
            'valor.decimal' => 'Valor deve ser um numero decimal com 2 casas decimais.',

            'valor_wangley.numeric' => 'Valor do Wangley deve ser um numero.',

            'valor_casal.numeric' => 'Valor do Casal deve ser um numero.',

            'deborah_falta_pagar.numeric' => 'Valor da Deborah falta pagar deve ser um numero.',

            'wangley_falta_pagar.numeric' => 'Valor do Wangley falta pagar deve ser um numero.',

            'descricao.required' => 'Descricao e obrigatoria.',

            'competencia.required' => 'Competencia e obrigatoria.',
            'competencia.regex' => 'Competencia invalida. Use o formato MM/AAAA.',

            'categoria_id.required' => 'Categoria e obrigatoria.',
            'categoria_id.exists' => 'Categoria invalida.',

            'tipo_categoria_id.required' => 'Tipo de categoria e obrigatorio.',

            'data_vencimento.required' => 'Data de vencimento e obrigatoria.',

            'dia_pagamento.between' => 'Dia de pagamento deve estar entre 1 e 31.',

            'data_pagamento.required_if' => 'Data de pagamento e obrigatoria quando marcado como pago.',

            'responsavel_id.required' => 'Responsavel e obrigatorio.',
            'responsavel_id.exists' => 'Responsavel invalido.',

            'link_pagamento.url' => 'Link de pagamento invalido.',
        ];
    }
}
