<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCredentialsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'label'     => 'required|string|min:1',
            'username'  => 'required|string|min:1|exists:users,username'
        ];
    }

    public function messages(): array
    {
        return [
            'label.required'    => 'A label is required',
            'label.min'         => 'A label must contain at least one character',
            'label.string'      => 'A label must be a string of characters',
            'username.required' => 'The username is required',
            'username.min'      => 'A username must contain at least one character',
            'username.string'   => 'A username must be a string of characters'
        ];
    }
}
