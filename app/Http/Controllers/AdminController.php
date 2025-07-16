<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalUsers = User::count();

        return view('dashboard.admin.dashboard', compact('totalUsers', 'user'));
    }

    public function about() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.about', compact('user'));
    }

    public function skill() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.skill', compact('user'));
    }

    public function sertif() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.sertif', compact('user'));
    }

    public function portf() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.portf', compact('user'));
    }

    public function settings() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.settings', compact('user'));
    }

    // Profile
    public function profile() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.profile', compact('user'));
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . session('user_id'),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::find(session('user_id'));
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
