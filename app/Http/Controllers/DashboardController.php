<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sosmed;
use App\Models\Skill;
use App\Models\SkillDetail;

class DashboardController extends Controller
{
    public function index() {
        $user = null;
        $sosmeds = collect();

        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));

            if ($user) {
                $sosmeds = Sosmed::where('user_id', $user->id)->get();
            }
        }

        return view('dashboard.layouts.home', compact('user', 'sosmeds'));
    }

    public function layoutskill() {
        $skills = Skill::with('details')->get();
        return view('dashboard.layouts.skill', compact('skills'));
    }

    public function details() {
        return $this->hasMany(SkillDetail::class);
    }
}
