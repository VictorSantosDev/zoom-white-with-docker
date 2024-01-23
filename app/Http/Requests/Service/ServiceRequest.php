<?php

namespace App\Http\Requests\Service;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Service\Entity\ServiceEntity;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'categoryId' => 'required|integer',
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

    public function data(): ServiceEntity
    {
        return new ServiceEntity(
            id: null,
            establishmentId: new Id($this->input('establishmentId')),
            categoryId: new Id($this->input('categoryId')),
            name: $this->input('name'),
            price: $this->input('price'),
            active: Active::ACTIVE,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null,
        );
    }
}
