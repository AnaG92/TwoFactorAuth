<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code'      => 'required|min_digits:6|max_digits:6',
            'username'  => 'required|string|exists:users,username',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required'     => 'The code is required',
            'code.min_digits'   => 'The code must be six digits long',
            'code.max_digits'   => 'The code must be six digits long',
            'username.required' => 'The username is required',
            'username.string'   => 'The username must be a string'
        ];
    }
}
