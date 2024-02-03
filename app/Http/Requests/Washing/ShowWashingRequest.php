<?php

namespace App\Http\Requests\Washing;

use Illuminate\Foundation\Http\FormRequest;

class ShowWashingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }
}
