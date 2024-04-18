<?php

namespace App\Http\Requests\Category;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Category\Entity\Category;
use App\Domain\Enum\Active;
use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_create_category');
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'name' => 'required|max:30',
            'numberIcon' => 'required|integer|max_digits:2',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute aceita no máximo :max caracteres',
            'integer' => 'O campo :attribute deve receber um valor númerico',
        ];
    }

    public function data(): Category
    {
        return new Category(
            id: null,
            establishmentId: new Id($this->input('establishmentId')),
            name: $this->input('name'),
            numberIcon: $this->input('numberIcon'),
            active: Active::ACTIVE,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null
        );
    }
}
