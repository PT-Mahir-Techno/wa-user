<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function updateStatus(Request $request)
    {
        $device = Device::find($request->id);
        $device->update(['status' => request('status')]);
        
        return response()->json($device, 200);
    }
}
