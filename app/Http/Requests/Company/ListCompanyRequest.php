<?php

namespace App\Http\Requests\Company;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ListCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_list_company');
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'companyName' => 'nullable|string',
            'fantasyName' => 'nullable|string',
            'document' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
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
