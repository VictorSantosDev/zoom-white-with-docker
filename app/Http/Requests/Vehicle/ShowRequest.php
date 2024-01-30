<?php

namespace App\Http\Requests\Vehicle;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('show_vehicle');
    }
}
