<?php

namespace App\Http\Requests\Washing;

use Illuminate\Foundation\Http\FormRequest;

class DeleteWashingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }
}
