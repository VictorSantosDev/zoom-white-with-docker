<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ListUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|nullable',
            'email' => 'string|nullable',
            'phone' => 'string|nullable',
            'cpf' => 'string|nullable',
            'active' => 'boolean|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'string' => 'O campo :attribute só aceita texto',
            'boolean' => "O campo :attribute só '1' ou '0'",
        ];
    }
}
