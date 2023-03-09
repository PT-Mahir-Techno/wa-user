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
        // prod
        // $this->base_url = 'https://api-wa.mahirtechnology.com';

        // dev
        $this->base_url = 'http://localhost:3000';
    }

    public function sendMessage(Request $request)
    {
        $msg = [
            "jid" => $request->reciver."@s.whatsapp.net", // Target jid
            "type"=> "number", // Use "number" for number jid, or "group" for group jid
            "message" => [
                "text" => $request->message
            ], //
        ];

        $data = User::where('id', auth()->user()->id)->with('device')->first();
        $response = Http::post($this->base_url.'/'.$data->device->phone_number.'/messages/send', $msg);
        return response()->json($response->object());
    }
    
    public function getChatList()
    {
        $data = User::where('id', auth()->user()->id)->with('device')->first();
        $response = Http::get($this->base_url.'/chats?id='.$data->phone_number);
        return response()->json($response->object());
    }
}
