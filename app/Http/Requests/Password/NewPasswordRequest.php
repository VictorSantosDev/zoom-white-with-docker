<?php

namespace App\Http\Requests\Password;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
{
    const REGEX_PASSWORD = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hash' => 'required|string',
            'password' => 'required|string|regex:'.self::REGEX_PASSWORD,
            'repeatPassword' => 'same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute deve ser um texto',
            'regex' => 'A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e símbolos.',
            'repeatPassword.same' => 'As senhas são diferentes'
        ];
    }
}
