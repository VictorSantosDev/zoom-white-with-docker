<?php

namespace App\Http\Requests\Vehicle;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Vehicle\Entity\Vehicle;
use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_update_vehicle');
    }

    public function rules(): array
    {
        return [
            'vehicleId' => 'required',
            'serviceIds' => 'nullable|array',
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

    public function data(): Vehicle
    {
        return new Vehicle(
            id: new Id($this->input('vehicleId')),
            establishmentId: new Id(null),
            userId: new Id(null),
            companyId: new Id(null),
            plate: $this->input('plate'),
            model: $this->input('model'),
            color: $this->input('color'),
            price: 0,
            createdAt: null,
            updatedAt: now(),
            deletedAt: null
        );
    }
}
