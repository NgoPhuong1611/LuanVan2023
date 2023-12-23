<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        return view('User.Chat.chat', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $user=User::find(session()->get('id'));
        $message = new Message();
        $message->user_id =$user->id;
        $message->content = $request->input('content');
        $message->save();

        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]);

        $pusher->trigger('chat-channel', 'new-message', ['message' => $message]);

        return response()->json(['status' => 'Message sent']);
    }
}
