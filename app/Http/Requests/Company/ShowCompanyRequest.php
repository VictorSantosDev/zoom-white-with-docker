<?php

namespace App\Http\Requests\Company;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ShowCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_show_company');
    }
}
