<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResumeRequest extends FormRequest
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
            'summary' => ['required'],
            // Skills
            'skill_id' => ['required', 'numeric', Rule::exists('skills', 'id')],
            // Experience
            'job_id' => ['required', 'numeric', Rule::exists('jobs', 'id')],
            'duty_id' => ['required', 'numeric', Rule::exists('duties', 'id')],
            'organisation'=>['required'],
            'start'=>['required'],
            'end'=>['nullable'],
            //  Qualification
            'certificate_id' => ['required', 'numeric', Rule::exists('certificates', 'id')],
            'school'=>['required'],
            'started'=>['required'],
            'finished'=>['required'],
            // Referrals
            'full_name'=>['required'],
            'company'=>['required'],
            'phone'=>['required', 'numeric', 'min:10', ],
            'email'=>['required', 'email'],
        ];
    }
}
