<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // Login
    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);
            return redirect('/admin');
        }
        
        return redirect()->back()->with('error', 'Email atau password tidak cocok');
    }
    
    // Logout
    public function logout() {
        session()->forget('user_id'); 
        session()->flush();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
