<?php

namespace App\Http\Requests\Parking;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ShowParkingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_show_parking_price');
    }
}
