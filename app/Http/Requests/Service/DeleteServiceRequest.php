<?php

namespace App\Http\Requests\Service;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class DeleteServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_delete_service');
    }
}
