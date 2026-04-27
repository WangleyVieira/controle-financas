<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoCategoriaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descricao' => ['required', 'max:150', 'min:3'],
        ];
    }

    /**
     * Get the errors messages for the defined validation rules
     *
     * @return array
     */
    public function messages()
    {
        return [
            'descricao.required' => 'Descrição é obrigatório.',
            'descricao.max' => 'Descrição: Máximo 150 caracteres.',
            'descricao.min' => 'Descrição: Minímo 3 caracteres.',
        ];
    }
}
