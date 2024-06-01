<?php

namespace App\Http\Requests\Admin;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Enum\TypeUser;
use Illuminate\Foundation\Http\FormRequest;
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|max:255|min:3',
            'email' => 'email|max:255',
            'phone' => 'required|min:11|max:11',
            'cpf' => 'required|cpf|max:11',
            'birthDate' => [
                'required', 'date', fn (
                    string $attribute,
                    mixed $value,
                    Closure $fail
                ) => $this->validateAge(attribute: $attribute, value: $value, fail: $fail)
            ],
            'typeUser' => 'required|in:' . implode(',', TypeUser::getEnum()),
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute deve receber um valor númerico',
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo :attribute é inválido',
            'phone' => 'O campo suporta no máximo 11 caracteres',
            'cpf' => 'O documento é inválido',
            'birthDate' => 'Data de aniversário é inválida',
        ];
    }

    public function data(): User
    {
        $symbol = ['@', '#', '$', '&'];
        $password = Str::random(4) . $symbol[rand(0, 3)] . Str::random(3);

        return new User(
            id: new Id($this->input('id')),
            name: $this->input('name'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            active: Active::ACTIVE,
            cpf: $this->input('cpf'),
            birthDate: $this->input('birthDate'),
            password: $password,
            typeUser: TypeUser::tryFromByName($this->input('typeUser')),
            emailVerifiedAt: null,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null
        );
    }

    private function validateAge(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        $date = Carbon::parse($value);

        $age = $date->diffInYears(Carbon::now());

        if ($age < 18) {
            $fail('inválido');
        }
    }
}
