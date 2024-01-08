<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['sometimes', 'required', ],
            'role_id'=>['sometimes' ,'required', Rule::exists('roles', 'id')],
            'organisation_id'=>['nullable', Rule::exists('organisations', 'id')],
            'email'=>['sometimes', 'required', 'email', Rule::unique('users', 'email')->ignore(2)],
            'username'=>['sometimes', 'required', Rule::unique('users', 'username')->ignore(2)],
            'dob'=>['sometimes', 'required', ],
            'password'=>['sometimes', 'required',  Password::min(8)->mixedCase()->symbols()->numbers(),Rule::unique('users', 'password')->ignore(2)],
        ];
    }
}
