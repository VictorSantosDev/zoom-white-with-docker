<?php

namespace App\Http\Requests\WashingVehicle;

use Illuminate\Foundation\Http\FormRequest;

class ListWashingVehiclesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
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
