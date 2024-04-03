<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'job_id' => ['required', Rule::exists('jobs', 'id')],
            'num'=>['required', 'numeric'],
            'arrangement_id' => ['required', Rule::exists('arrangements', 'id')],
            'about' => ['required'],
            'due_date' => ['required'],
            'duties'=>['required',],
            'skill_id'=>['required'],
            'certificate_id'=>['required']
        ];
    }
}
