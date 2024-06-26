<?php

namespace App\Http\Requests\Password;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'email',
        ];
    }

    public function messages(): array
    {
        return [
            'email' => 'O email é inválido',
        ];
    }
}
