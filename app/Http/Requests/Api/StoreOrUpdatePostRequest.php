<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo' => 'sometimes|mimes:jpg,png|max:1014',
            'content' => 'sometimes|string',
        ];
    }
}
