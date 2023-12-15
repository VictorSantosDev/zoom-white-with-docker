<?php

namespace App\Http\Requests\Admin;

use App\Domain\Enum\TypeEstablishment;
use Illuminate\Foundation\Http\FormRequest;

class ListEstablishmentByUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => 'required|integer',
            'nameByCompany' => 'nullable|string',
            'document' => 'nullable|string',
            'type' =>
            'nullable|string|in:' . TypeEstablishment::CAR_WASH->value .
                ','   . TypeEstablishment::PARKING->value .
                ','   . TypeEstablishment::CAR_WASH_AND_PARKING->value,
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo é :attribute obrigatório',
            'integer' => 'O campo :attribute aceita somente inteiro',
            'type.in' => 'O campo type só aceita esses valores CAR_WASH, PARKING, CAR_WASH_AND_PARKING',
            'string' => 'O campo :attribute só aceita formato texto'
        ];
    }
}
