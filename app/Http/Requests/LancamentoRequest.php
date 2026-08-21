<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LancamentoRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor' => $this->normalizarValor($this->input('valor')),
            'valor_pago' => $this->filled('valor_pago') ? $this->normalizarValor($this->input('valor_pago')) : null,
            'is_pago' => $this->boolean('is_pago'),
            'is_parcelado' => $this->boolean('is_parcelado'),
            'is_fixo' => $this->boolean('is_fixo'),
        ]);
    }

    private function normalizarValor(?string $valor): string
    {
        $valorNormalizado = empty($valor) ? 0 : str_replace(['.', ','], ['', '.'], $valor);

        return number_format((float) $valorNormalizado, 2, '.', '');
    }

    public function rules(): array
    {
        return [
            'competencia' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{4}$/'],
            'descricao' => ['required', 'string', 'min:3', 'max:255'],
            'valor' => ['required', 'decimal:2,10'],
            'valor_pago' => ['nullable', 'numeric', 'min:0', 'lte:valor', 'required_if:is_pago,1'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'data_vencimento' => ['required', 'date'],
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

            'descricao.required' => 'Descricao e obrigatoria.',

            'competencia.required' => 'Competencia e obrigatoria.',
            'competencia.regex' => 'Competencia invalida. Use o formato MM/AAAA.',

            'categoria_id.required' => 'Categoria e obrigatoria.',
            'categoria_id.exists' => 'Categoria invalida.',

            'data_vencimento.required' => 'Data de vencimento e obrigatoria.',

            'data_pagamento.required_if' => 'Data de pagamento e obrigatoria quando marcado como pago.',
            'valor_pago.required_if' => 'Informe o valor pago ao marcar o lançamento como pago.',
            'valor_pago.lte' => 'O valor pago não pode ser maior que o valor previsto.',

            'link_pagamento.url' => 'Link de pagamento invalido.',
        ];
    }
}
