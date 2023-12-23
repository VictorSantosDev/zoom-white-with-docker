<?php

namespace App\Http\Requests\Washing;

use Illuminate\Foundation\Http\FormRequest;

class ListWashingByEstablishmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'name' => 'nullable',
            'active' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute aceita somente números inteiros',
            'required' => 'O campo :attribute é obrigatório',
        ];
    }
}
