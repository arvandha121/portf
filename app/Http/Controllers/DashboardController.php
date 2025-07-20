<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sosmed;
use App\Models\Skill;
use App\Models\SkillDetail;
use App\Models\AboutMe;
use App\Models\Certificate;
use App\Models\CertificateDetail;
use App\Models\ProjectPortofolio;

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

    public function aboutme() {
        $about = AboutMe::first();
        return view('dashboard.layouts.about', compact('about'));
    }

    public function certificationLayout()
    {
        $certificates = Certificate::with('details')->get();
        return view('dashboard.layouts.certificate', compact('certificates'));
    }

    public function portofolio() {
        $projects = ProjectPortofolio::all();
        return view('dashboard.layouts.portofolio', compact('projects'));
    }

}
