<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:150', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
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
            'name.required' => 'Nome é obrigatório.',
            'name.max' => 'Nome: Máximo 150 caracteres.',
            'name.min' => 'Nome: Minímo 3 caracteres.',

            'email.required' => 'Email é obrigatório.',
            'email.email' => 'Email: Formato inválido.',
            'email.unique' => 'Email: Já cadastrado no sistema.',
        ];
    }
}
