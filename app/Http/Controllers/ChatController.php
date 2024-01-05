<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use App\Models\Admin;
use Pusher\Pusher;
use App\Models\ExamHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Forum::orderBy('time_date', 'desc')->get();

        // $user_username = User::find(session()->get('id'))->username;

        $userIds = $messages->pluck('user_id')->unique()->toArray();
        $usernames = User::whereIn('id', $userIds)->pluck('username', 'id');

        //
        $adminIds = $messages->pluck('admin_id')->unique()->toArray();
        $ad_usernames = Admin::whereIn('id', $adminIds)->pluck('username', 'id');

        // BXH điểm
        $ratings = ExamHistory::select('users.username', DB::raw('MAX(score) as max_score'))
        ->join('users', 'exam_history.user_id', '=', 'users.id')
        ->groupBy('user_id')
        ->get() // Use get() to retrieve the results as an array
        ->toArray(); // Convert the collection to an array

        return view('User.Chat.chat', [
            'messages' => $messages,
            'usernames' => $usernames,
            'ad_usernames'=>$ad_usernames,
            // 'user_username' => $user_username,
            'ratings' => $ratings, // Placed all variables inside a single array
        ]);
    }
    public function sendMessage(Request $request)
    {
        
        $user=User::find(session()->get('id'));
        $message = new Forum();
        $message->user_id =$user->id;
        $message->admin_id=null;
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
