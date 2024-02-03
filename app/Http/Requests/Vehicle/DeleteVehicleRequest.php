<?php

namespace App\Http\Requests\Vehicle;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class DeleteVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_delete_vehicle');
    }
}
