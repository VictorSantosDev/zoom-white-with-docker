<?php

namespace App\Http\Requests\Employee;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Employee\Entity\Employee;
use App\Domain\Enum\Active;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo :attribute é inválido',
            'integer' => 'O campo :attribute aceita somente inteiro',
            'string' => 'O campo :attribute só aceita formato texto'
        ];
    }

    public function password(): string
    {
        $symbol = ['@', '#', '$', '&'];
        return Str::random(4) . $symbol[rand(0, 3)] . Str::random(3);
    }

    public function data(): Employee
    {
        return new Employee(
            id: null,
            userId: null,
            establishmentId: new Id($this->input('establishmentId')),
            registration: '0000000',
            name: $this->input('name'),
            email: $this->input('email'),
            active: Active::ACTIVE,
            admin: Active::ACTIVE,
            emailVerifiedAt: null,
            password: null,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null,
        );
    }
}
