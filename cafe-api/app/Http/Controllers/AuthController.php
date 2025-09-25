<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // ⬅️ Tambahkan ini

class AuthController extends Controller
{
    // ✅ MENAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        return view('login'); // resources/views/login.blade.php
    }

    // ✅ LOGIN LOGIKA (sementara statis: 'user' dan 'admin')
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;

        if ($username === 'user' && $password === 'user') {
            return redirect()->route('user.dashboard');
        } elseif ($username === 'admin' && $password === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['error' => 'Username atau password salah']);
        }
    }

    // ✅ MENAMPILKAN HALAMAN REGISTER
    public function showRegister()
    {
        return view('register'); // resources/views/register.blade.php
    }

    // ✅ REGISTRASI MEMBER BARU & LANGSUNG LOGIN OTOMATIS
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:new_members',
            'email' => 'required|email|unique:new_members',
            'password' => 'required|min:6|confirmed',
        ]);

        $member = new NewMember();
        $member->name = $request->name;
        $member->username = $request->username;
        $member->email = $request->email;
        $member->password = Hash::make($request->password);
        $member->save();

        // ✅ Login otomatis setelah berhasil daftar
        Auth::login($member);

        // ✅ Arahkan langsung ke beranda
        return redirect()->route('user.dashboard');
    }
}
