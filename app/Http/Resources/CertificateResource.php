<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'issuer' => $this->issuer,
            'issued_date' => $this->issued_date->toDateString(),
            'credential_url' => $this->credential_url,
            'description' => $this->description,
        ];
    }
}