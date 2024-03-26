<?php

namespace App\Http\Requests\Service;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ShowServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_show_service');
    }
}
