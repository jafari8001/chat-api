<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // ارسال پیام
public function store(Request $request)
{
    $request->validate([
        'conversation_id' => 'required|exists:conversations,id',
        'body' => 'required|string',
    ]);

    $message = Message::create([
        'conversation_id' => $request->conversation_id,
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return response()->json($message);
}

}
