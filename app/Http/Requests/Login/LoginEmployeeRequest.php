<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'registration' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo é obrigatório.'
        ];
    }
}
