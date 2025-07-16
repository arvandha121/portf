<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sosmed;

class DashboardController extends Controller
{
    public function index() {
        $user = User::find(session('user_id'));

        // Pastikan user ditemukan
        if (!$user) {
            abort(404, 'User not found');
        }

        // Ambil semua sosmed milik user
        $sosmeds = Sosmed::where('user_id', $user->id)->get();

        return view('dashboard.layouts.home', compact('user', 'sosmeds'));
    }
}
