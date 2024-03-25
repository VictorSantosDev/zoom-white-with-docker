<?php

namespace App\Http\Requests\Service;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ListServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_list_service');
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'categoryId' => 'nullable|integer',
            'name' => 'nullable|string',
            'price' => 'nullable|integer',
            'limitPerPage' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute aceita somente números inteiros',
            'string' => 'O campo :attribute só aceita formato texto',
        ];
    }
}
