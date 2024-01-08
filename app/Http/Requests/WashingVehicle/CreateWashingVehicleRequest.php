<?php

namespace App\Http\Requests\WashingVehicle;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\WashingVehicle\Entity\WashingVehicle;
use Illuminate\Foundation\Http\FormRequest;

class CreateWashingVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estableshimentId' => 'required',
            'washingIds' => 'required|array',
            'plate' => 'required|min:7|max:8',
            'model' => 'required|max:20',
            'color' => 'required|max:20'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'array' => 'O campo :attribute dever ser do tipo ARRAY',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres',
            'min' => 'O campo :attribute pode ter no minímo :min caracteres',
        ];
    }
}
