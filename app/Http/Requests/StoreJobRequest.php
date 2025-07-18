<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
        'employer.name' => 'required|string|max:255',
        'employer.contactEmail' => 'required|email',
        'employer.contactPhone' => 'required|string|max:255',
        'job.title' => 'required|string|max:255',
        'job.type' => 'required|string|max:255',
        'job.description' => 'required|string',
        'job.location' => 'required|string|max:255',
        'job.salary' => 'nullable|string|max:255',
        ];
    }
}
