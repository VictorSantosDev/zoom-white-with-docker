<?php

namespace App\Http\Requests\Category;

use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class ShowCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_show_category');
    }
}
