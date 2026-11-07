<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // On create (POST) the main fields are required.
        // On update (PATCH) only the fields that are sent are checked.
        $required = $this->isMethod('post') ? 'required' : 'sometimes';
        $projectId = $this->route('project')?->id;

        return [
            'title' => [$required, 'string', 'max:150'],
            'slug' => [$required, 'string', 'max:150', 'alpha_dash', Rule::unique('projects', 'slug')->ignore($projectId)],
            'summary' => [$required, 'string', 'max:255'],
            'description' => [$required, 'string', 'max:2000'],
            'thumbnail_url' => ['nullable', 'string', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['sometimes', 'boolean'],
            'skill_ids' => ['sometimes', 'array'],
            'skill_ids.*' => ['integer', 'exists:skills,id'],
        ];
    }
}