<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function coordinator()
    {
        $messages = Message::where('recivier_id', Auth::user()->id)->get();

        $data = [
            'messages' => $messages,
        ];

        return $data;
    }
}
