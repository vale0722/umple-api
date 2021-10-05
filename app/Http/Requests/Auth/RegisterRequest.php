<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|string|email|max:100|unique:users",
            "password" => "required|string|min:6",
            'photo_uri' => 'required'
        ];
    }
}
