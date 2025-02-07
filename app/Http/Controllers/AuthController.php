<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => ['required', 'max:25'],
            'email' => ['required', 'max:255', 'email','unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama pengguna wajib diisi.',
            'name.max' => 'Nama pengguna tidak boleh lebih dari 25 karakter.',

            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.unique' => 'Email sudah terdaftar',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal harus memiliki 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        //register
        $user = User::create($fields);

        //login
        Auth::login($user);

        //redirect
        return redirect()->route('home');
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',

            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        if (Auth::attempt($fields,$request->remember)) {
            return redirect()->intended();
        }else{
            return back()->withErrors([
                'error' => 'Invalid email or password'
            ]);
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect('/');
    }
}