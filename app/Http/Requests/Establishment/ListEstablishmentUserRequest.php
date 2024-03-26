<?php

namespace App\Http\Requests\Establishment;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ListEstablishmentUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_list_establishment_user');
    }
}
