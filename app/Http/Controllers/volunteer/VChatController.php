<?php

namespace App\Http\Controllers\volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VChatController extends Controller
{
    public function chat()
    {
        return view('volunteer.chat.chat');
    }
}
