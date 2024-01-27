<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class ListVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'companyId' => 'nullable|integer',
            'employeeId' => 'nullable|integer',
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
