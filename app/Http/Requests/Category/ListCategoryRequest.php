<?php

namespace App\Http\Requests\Category;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ListCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_list_category');
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'name' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo é :attribute obrigatório',
            'integer' => 'O campo :attribute aceita somente inteiro',
            'string' => 'O campo :attribute só aceita formato texto'
        ];
    }
}
