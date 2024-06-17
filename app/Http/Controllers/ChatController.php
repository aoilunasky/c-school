<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewChatMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
   
    public function index()
    {
        $teachers = User::whereHas('teacher')->get();
        return view('chats.index')->with(['teachers' => $teachers]);
    }

    public function sendNoti(Request $request)
    {
        $user = User::find($request->userID);
        $user->notify(new NewChatMessageNotification);
        return response()->json('Notification sent.', 201);
    }
}
