<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo_url' => 'sometimes|bail|required_without:description',
            'content' => 'sometimes|string',
        ];
    }
}
