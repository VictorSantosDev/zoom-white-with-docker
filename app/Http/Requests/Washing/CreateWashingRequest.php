<?php

namespace App\Http\Requests\Washing;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Washing\Entity\Washing;
use Illuminate\Foundation\Http\FormRequest;

class CreateWashingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'name' => 'required|string|max:50',
            'price' => 'required|integer|max:10|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute aceita somente números inteiros',
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute aceita no máximo :max caracteres',
        ];
    }

    public function data(): Washing
    {
        return new Washing(
            id: null,
            establishmentId: new Id($this->input('establishmentId')),
            name: $this->input('name'),
            price: $this->input('price'),
            active: Active::ACTIVE,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: now()
        );
    }
}
