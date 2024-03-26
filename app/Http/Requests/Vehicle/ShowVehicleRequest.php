<?php

namespace App\Http\Requests\Vehicle;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ShowVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_show_vehicle');
    }
}
