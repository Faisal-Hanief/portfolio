<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    // Email and phone are intentionally not part of the public API response.
    public function toArray(Request $request): array
    {
        return [
            'full_name' => $this->full_name,
            'headline' => $this->headline,
            'bio' => $this->bio,
            'photo_url' => $this->photo_url ? asset($this->photo_url) : null,
            'cv_url' => $this->cv_url ? asset($this->cv_url) : null,
            'location' => $this->location,
            'github_url' => $this->github_url,
            'linkedin_url' => $this->linkedin_url,
            'instagram_url' => $this->instagram_url,
        ];
    }
}