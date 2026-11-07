<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sender_name' => $this->sender_name,
            'sender_email' => $this->sender_email,
            'subject' => $this->subject,
            'body' => $this->body,
            'is_read' => $this->is_read,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}