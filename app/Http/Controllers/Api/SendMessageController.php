<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendMessageController extends Controller
{
    public function __construct()
    {
        $this->base_url = 'https://api-wa.mahirtechnology.com';
    }

    public function sendMessage(Request $request)
    {
        $message = [
            "receiver" => $request->reciver,
            "message"  => ["text" => $request->message]
        ];
        $data = User::where('id', auth()->user()->id)->with('device')->first();
        $response = Http::post($this->base_url.'/chats/send?id='.$data->phone_number, $message);
        return response()->json($response->object());
    }
    
    public function getChatList()
    {
        $data = User::where('id', auth()->user()->id)->with('device')->first();
        $response = Http::get($this->base_url.'/chats?id='.$data->phone_number);
        return response()->json($response->object());
    }
}
