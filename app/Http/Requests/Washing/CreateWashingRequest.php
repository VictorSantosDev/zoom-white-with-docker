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
        return false;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'name' => 'required|string|max:50',
            'price' => 'required|integer|max_digits:10',
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute aceita somente números inteiros',
            'required' => 'O campo :attribute é obrigatório',
            'max_digits' => 'O campo :attribute aceita no máximo :max_digits caracteres',
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
            deletedAt: null
        );
    }
}
