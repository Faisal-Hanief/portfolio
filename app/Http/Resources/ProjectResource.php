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
            'summary' => $this->summary,
            'description' => $this->description,
            'thumbnail_url' => $this->thumbnail_url ? asset($this->thumbnail_url) : null,
            'demo_url' => $this->demo_url,
            'github_url' => $this->github_url,
            'is_featured' => $this->is_featured,
            'skills' => SkillResource::collection($this->whenLoaded('skills')),
        ];
    }
}