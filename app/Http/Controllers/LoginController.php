<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login_proses(Request $request){

        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);


        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (Auth::attempt($data)) {
            $user = auth()->user();
    
            if ($user->role == 'user') {
                return redirect()->route('admin.dashboard'); // Sesuaikan dengan nama rute dashboard user
            } elseif ($user->role == 'admin' && $user->id == 4) {
                return redirect()->route('admin.dashboard'); // Sesuaikan dengan nama rute dashboard admin
            } else {
                Auth::logout();
                return redirect()->route('login')->with('failed', 'Tidak DI Izinkan!');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }

        // if (auth()->attempt($data)) {
        //     return redirect()->route('admin.dashboard');
        // } else {
        //     return redirect()->route('login')->with('login_error', 'Coba Kembali Periksa Email atau Password, jika tidak coba hubungi Admin');
        // }
        

        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('succes', 'Kamu Berhasil Logout');
    }

    public function register(){
        return view('auth.register');
    }

    public function register_proses(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Simpan data user setelah validasi berhasil
        User::create([
            'email' => $request->input('email'),
            'name' => $request->input('nama'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role', 'user'),
            // Jangan lupa sesuaikan dengan kolom lainnya
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($data)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->with('login_error', 'Coba Kembali Periksa Email atau Password, jika tidak coba hubungi Admin');
        }
    }
}
