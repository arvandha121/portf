<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Skill;
use App\Models\SkillDetail; 

class AdminController extends Controller
{
    public function index() {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalUsers = User::count();
        $totalSkills = Skill::count();

        return view('dashboard.admin.dashboard', compact('totalSkills', 'totalUsers', 'user'));
    }

    public function about() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.about', compact('user'));
    }

    // Skills
    public function skills() {
        $user = User::find(session('user_id'));

        $skills = Skill::with('details')->where('user_id', $user->id)->get();

        return view('dashboard.admin.skill', compact('skills', 'user'));
    }

    public function storeSkill(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Skill::create([
            'user_id' => session('user_id'),
            'title' => $request->title,
        ]);

        return back()->with('success', 'Skill berhasil ditambahkan.');
    }

    public function updateSkill(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->title = $request->title;
        $skill->save();

        return redirect()->route('admin.skill')->with('success', 'Skill title updated successfully.');
    }

    public function deleteSkill($id) {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return back()->with('success', 'Skill berhasil dihapus.');
    }

    public function storeSkillDetail(Request $request, $skillId) {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'experience' => 'required|string',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        SkillDetail::create([
            'skill_id' => $skillId,
            'subtitle' => $request->subtitle,
            'experience' => $request->experience,
            'percentage' => $request->percentage,
        ]);

        return back()->with('success', 'Detail skill berhasil ditambahkan.');
    }

    public function updateSkillDetail(Request $request, $id) {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'experience' => 'required|string',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        $detail = SkillDetail::findOrFail($id);
        $detail->subtitle = $request->subtitle;
        $detail->experience = $request->experience;
        $detail->percentage = $request->percentage;
        $detail->save();

        return redirect()->route('admin.skill')->with('success', 'Skill detail updated.');
    }

    public function deleteSkillDetail($id) {
        $detail = SkillDetail::findOrFail($id);
        $detail->delete();

        return back()->with('success', 'Detail skill berhasil dihapus.');
    }

    // Sertif
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

    // Skills
    // public function skills() {
    //     $user = User::find(session('user_id'));

    //     $skills = Skill::with('details')->where('user_id', $user->id)->get();

    //     return view('dashboard.admin.skill', compact('skills', 'user'));
    // }
}
