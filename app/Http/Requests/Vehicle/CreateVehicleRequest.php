<?php

namespace App\Http\Requests\Vehicle;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Vehicle\Entity\Vehicle;
use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_create_vehicle');
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'companyId' => 'nullable|integer',
            'serviceIds' => 'required|array',
            'plate' => 'required|min:7|max:8',
            'model' => 'required|max:20',
            'color' => 'required|max:20'
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute aceita somente números inteiros',
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres',
            'min' => 'O campo :attribute pode ter no minímo :min caracteres',
        ];
    }
    public function data(): Vehicle
    {
        return new Vehicle(
            id: null,
            establishmentId: new Id($this->input('establishmentId')),
            userId: new Id(null),
            companyId: new Id($this->input('companyId')),
            plate: $this->input('plate'),
            model: $this->input('model'),
            color: $this->input('color'),
            price: 0,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null
        );
    }
}
