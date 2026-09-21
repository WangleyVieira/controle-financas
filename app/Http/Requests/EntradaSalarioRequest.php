<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaSalarioRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor_salario' => $this->input('valor_salario') ? str_replace(['.', ','], ['', '.'], $this->input('valor_salario')) : 0,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'competencia' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{4}$/'],
            'descricao' => ['required', 'string', 'min:3', 'max:255'],
            'valor_salario' => ['required', 'decimal:2,10'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'competencia.required' => 'Competência é obrigatória.',
            'competencia.regex' => 'Competência inválida. Use o formato MM/AAAA.',

            'descricao.required' => 'Descrição é obrigatória.',
            'descricao.min' => 'Descrição deve ter no mínimo 3 caracteres.',
            'descricao.max' => 'Descrição deve ter no máximo 255 caracteres.',

            'valor_salario.required' => 'Valor do salário é obrigatório.',
            'valor_salario.decimal' => 'Valor do salário deve ser um número decimal com 2 casas decimais.',
        ];
    }
}
