<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Forum::all();

        $user_username=User::find(session()->get('id'))->username;

        $userIds = $messages->pluck('user_id')->unique()->toArray();
        $usernames = User::whereIn('id', $userIds)->pluck('username', 'id');
        return view('User.Chat.chat', ['messages' => $messages, 'usernames' => $usernames],['user_username' => $user_username]);
    }

    public function sendMessage(Request $request)
    {
        $user=User::find(session()->get('id'));
        $message = new Forum();
        $message->user_id =$user->id;
        $message->admin_id=1;
        $message->level=0;
        $message->title="";
        $message->detail = $request->input('content');
        $message->save();
        $username = $user->username; // Lấy tên người dùng
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]);

        $pusher->trigger('chat-channel', 'new-message', ['message' => $message, 'username' => $username]);

        return response()->json(['status' => 'Message sent']);
    }
}
