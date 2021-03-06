<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo' => 'sometimes|nullable',
            'content' => 'sometimes|string|nullable',
        ];
    }
}
