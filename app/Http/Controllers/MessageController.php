<?php

namespace App\Http\Controllers;

use App\Model\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function SendMessage(Request $request)
    {
        $data = [
          'from' => $request->from_id,
          'to'  => $request->to_id,
          'message' => $request->text,
          'is_read' => 0,
        ];
        Message::create($data);
        return response()->json('Send');
    }
}
