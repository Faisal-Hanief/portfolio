<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);

        return ContactMessageResource::collection($messages);
    }

    public function store(ContactRequest $request)
    {
        ContactMessage::create([
            ...$request->validated(),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Thanks for reaching out! Your message has been sent.',
        ], 201);
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->is_read = true;
        $contactMessage->save();

        return new ContactMessageResource($contactMessage);
    }
}