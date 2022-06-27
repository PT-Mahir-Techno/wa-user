<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email'    => 'required|exists:users,email',
            'password' => 'required'
        ],[
            'email.required'     => 'email wajib di isi',
            'email.exists'       => 'email tidak terdaftar',
            'password.required'  => 'password wajib di isi'
        ]);

        $credentials = $request->only('email', 'password');

        $authenticated = auth()->attempt($credentials, $request->has('remember'));

        if ($authenticated){
            return redirect()->route('device.index');
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique:users,phone_number',
            'email'        => 'required|email|unique:users,email',
            'password_decrypt'     => 'required|min:8'
        ],[
            'name.required' => 'nama wajib di isi',
            'phone_number.required' => 'nomor telepon wajib di isi',
            'phone_number.unique'   => 'nomor telepon sudah terdaftar',
            'email.required'        => 'wmail wajib di isi',
            'email.email'           => 'email tidak valid',
            'email.unique'          => 'email sudah terdaftar',
            'password_decrypt.required'     => 'password wajib di isi',
            'password_decrypt.min'          => 'password minimal 8 karakter'
        ]);

        $request['password'] = bcrypt($request['password_decrypt']);
        $request['role']     = 'user';

        // dd($credentials);
        
        $data_user = User::create($request->all());
        
        if ($data_user){
            $credentials = [
                'email' => $request['email'],
                'password' => $request['password_decrypt']
            ];

            Auth::attempt($credentials);
            $user = Auth::user();
            $token =  $user->createToken('auth-token')->plainTextToken;
            $update_api_token = User::find($data_user->id);
            $update_api_token->update(['api_token' => $token]);
            Auth::logout();
        }
        
        // dd('wkwk');

        return redirect()->route('login')->with('success', 'Berhasil mendaftar silahkan masuk !');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Berhasil keluar');
    }

    
}
