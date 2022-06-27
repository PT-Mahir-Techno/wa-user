<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['device'] = Device::where('user_id', auth()->user()->id)->first();

        return view('device.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_name' => 'required',
            'description' => 'required',
            'phone_number' => 'required|unique:devices,phone_number'
        ],[
            'device_name.required' => 'nama device wajib di isi',
            'description.required' => 'deskripsi wajib di isi',
            'phone_number.required' => 'nomor telepon wajib di isi',
            'phone_number.unique'   => 'nomor telepon sudah terdaftar'
        ]);

        $request['user_id'] = auth()->user()->id;
        $request['status']  = 'unauthenticated';

        $data['device'] = Device::create($request->all());
        return redirect()->back()->with('success', 'berhasil menambahkan device');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        $device->delete();
        return redirect()->back()->with('success', 'berhasil hapuh device');
    }
}
