<?php

namespace App\Http\Controllers\coordinator;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class CChatController extends Controller
{
    public function chat()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $messages = Message::where('sender', Auth::id())->with('getsender', 'getreceiver')->get();
        return view('coordinator.chat.chat', ['users' => $users]);
    }

    public function getmessages(Request $request)
    {
        $messages = Message::where('sender', Auth::id())->where('receiver', $request->receiver_id)->get();
        $user = User::where('id', $request->receiver_id)->first();
        return view('coordinator.chat.messages', ['messages' => $messages, 'user' => $user]);
    }

    public function getallmessages(Request $request)
    {
        $messages = Message::where('sender', Auth::id())->where('receiver', $request->receiver_id)->get();
        $user = User::where('id', $request->receiver_id)->first();
        return view('coordinator.chat.getmessages', ['messages' => $messages, 'user' => $user]);
    }

    public function getmessage(Request $request)
    {
        $messages = Message::where('sender', Auth::id())->where('receiver', $request->receiver_id)->get();
        $user = User::where('id', $request->receiver_id)->first();
        return view('coordinator.chat.message', ['messages' => $messages, 'user' => $user]);
    }

    public function sendmessage(Request $request)
    {
        $message = new Message(['sender' => Auth::id(), 'receiver' => $request->receiver_id, 'condition' => "0", 'content' => $request->content]);
        $message->save();

        //$messages = Message::where('sender', Auth::id())->where('receiver', $request->receiver_id)->get();

        //$user = User::where('id', $request->receiver_id)->first();
        //return view('coordinator.chat.messages', ['messages' => $messages, 'user' => $user]);
        $get_message = Message::where('id', $message->id)->first();
        return view('coordinator.chat.message', ['message' => $get_message]);
    }
}
