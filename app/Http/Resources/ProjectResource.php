<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_url' => $this->image_path ? asset($this->image_path) : null,
            'github_url' => $this->github_url,
            'demo_url' => $this->demo_url,
            'skills' => SkillResource::collection($this->whenLoaded('skills')),
        ];
    }
}