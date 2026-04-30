<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponsavelRequest extends FormRequest
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'max:150', 'min:3'],
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
            'nome.required' => 'Nome é obrigatório.',
            'nome.max' => 'Nome: Máximo 150 caracteres.',
            'nome.min' => 'Nome: Minímo 3 caracteres.',
        ];
    }
}
