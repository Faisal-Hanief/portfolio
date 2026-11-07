<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['sometimes', 'string', 'max:150'],
            'headline' => ['sometimes', 'string', 'max:255'],
            'bio' => ['sometimes', 'string', 'max:3000'],
            'photo_url' => ['nullable', 'string', 'max:255'],
            'cv_url' => ['nullable', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'location' => ['nullable', 'string', 'max:150'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
        ];
    }
}