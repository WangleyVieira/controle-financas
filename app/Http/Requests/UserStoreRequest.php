<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'password' => ['required', 'min:6', 'max:35'],
            'confirmacao' => ['required', 'min:6', 'max:35', 'same:password'],
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
            'email.unique' => 'Email: Já cadastrado.',

            'password.required' => 'Senha é obrigatória.',
            'password.min' => 'Senha: Minímo 6 caracteres.',
            'password.max' => 'Senha: Máximo 35 caracteres.',

            'confirmacao.required' => 'Confirmação de senha é obrigatória.',
            'confirmacao.min' => 'Confirmação de senha: Minímo 6 caracteres.',
            'confirmacao.max' => 'Confirmação de senha: Máximo 35 caracteres.',
            'confirmacao.same' => 'Confirmação de senha: Deve ser igual a senha.',
        ];
    }
}
