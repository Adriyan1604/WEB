<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $username = $request->username;
        $password = $request->password;
    
        if ($username === 'user' && $password === 'user') {
            // Redirect ke halaman dashboard user
            return redirect()->route('user.dashboard');
        } elseif ($username === 'admin' && $password === 'admin') {
            // Redirect ke halaman admin tanpa "dashboard"
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['error' => 'Invalid username or password']);
        }
    }
}    

