<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;

class ContactController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::latest()->paginate(20));
    }

    public function store(ContactRequest $request)
    {
        Message::create([
            'sender_name' => $request->validated('name'),
            'sender_email' => $request->validated('email'),
            'subject' => $request->validated('subject'),
            'body' => $request->validated('message'),
        ]);

        return response()->json([
            'message' => 'Thanks for reaching out! Your message has been sent.',
        ], 201);
    }

    public function markAsRead(Message $message)
    {
        $message->is_read = true;
        $message->save();

        return new MessageResource($message);
    }
}