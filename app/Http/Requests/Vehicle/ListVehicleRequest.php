<?php

namespace App\Http\Requests\Vehicle;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ListVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_list_vehicle');
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'companyId' => 'nullable|integer',
            'userId' => 'nullable|integer',
            'plate' => 'nullable|string',
            'model' => 'nullable|string',
            'color' => 'nullable|string',
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
