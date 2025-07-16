<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Skill;
use App\Models\SkillDetail; 
use App\Models\Sosmed;
use App\Models\Activity;

class AdminController extends Controller
{
    public function index() {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalUsers = User::count();
        $totalSkills = Skill::count();
        $activities = Activity::where('user_id', $user->id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('dashboard.admin.dashboard', compact(
            'totalSkills', 'totalUsers', 'user', 'activities'
        ));
    }

    // =================
    // About
    // =================
    public function about() {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.about', compact('user'));
    }

    // =================
    // Skills
    // =================
    public function skills() {
        $user = User::find(session('user_id'));

        $skills = Skill::with('details')->where('user_id', $user->id)->get();

        return view('dashboard.admin.skill', compact('skills', 'user'));
    }

    public function storeSkill(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $skill = Skill::create([
            'user_id' => session('user_id'),
            'title' => $request->title,
        ]);

        // Tambah activity otomatis
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Added new skill: ' . $request->title,
            'icon' => 'plus-circle',
            'color' => 'cyan-500',
        ]);

        return back()->with('success', 'Skill berhasil ditambahkan.');
    }

    public function updateSkill(Request $request, $id) {
       $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $skill = Skill::findOrFail($id);
        $oldTitle = $skill->title;
        $skill->title = $request->title;
        $skill->save();

        // Tambah activity otomatis
        Activity::create([
            'user_id' => session('user_id'),
            'description' => "Updated skill: {$oldTitle} → {$skill->title}",
            'icon' => 'edit',
            'color' => 'yellow-500',
        ]);

        return redirect()->route('admin.skill')->with('success', 'Skill title updated successfully.');
    }

    public function deleteSkill($id) {
        $skill = Skill::findOrFail($id);
        $deletedTitle = $skill->title;
        $skill->delete();

        // Tambah activity otomatis
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Deleted skill: ' . $deletedTitle,
            'icon' => 'trash-2',
            'color' => 'red-500',
        ]);

        return back()->with('success', 'Skill berhasil dihapus.');
    }

    public function storeSkillDetail(Request $request, $skillId) {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'experience' => 'required|string',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        $detail = SkillDetail::create([
            'skill_id' => $skillId,
            'subtitle' => $request->subtitle,
            'experience' => $request->experience,
            'percentage' => $request->percentage,
        ]);

        // Logging activity
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Added new skill detail: ' . $request->subtitle,
            'icon' => 'plus',
            'color' => 'cyan-500',
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
        $oldSubtitle = $detail->subtitle;

        $detail->subtitle = $request->subtitle;
        $detail->experience = $request->experience;
        $detail->percentage = $request->percentage;
        $detail->save();

        // Logging activity
        Activity::create([
            'user_id' => session('user_id'),
            'description' => "Updated skill detail: {$oldSubtitle} → {$detail->subtitle}",
            'icon' => 'edit-2',
            'color' => 'yellow-500',
        ]);

        return redirect()->route('admin.skill')->with('success', 'Skill detail updated.');
    }

    public function deleteSkillDetail($id) {
        $detail = SkillDetail::findOrFail($id);
        $deletedSubtitle = $detail->subtitle;
        $detail->delete();

        // Logging activity
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Deleted skill detail: ' . $deletedSubtitle,
            'icon' => 'trash-2',
            'color' => 'red-500',
        ]);

        return back()->with('success', 'Detail skill berhasil dihapus.');
    }

    // =================
    // Sertif
    // =================
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

    // =================
    // Profile
    // =================
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

        $oldName = $user->name;
        $oldEmail = $user->email;

        $user->name = $request->name;
        $user->email = $request->email;

        $passwordChanged = false;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $passwordChanged = true;
        }

        $user->save();

        // Logging
        $activityText = 'Updated profile';
        if ($oldName !== $request->name) {
            $activityText .= ": name changed from $oldName to $request->name";
        }
        if ($oldEmail !== $request->email) {
            $activityText .= ", email changed from $oldEmail to $request->email";
        }
        if ($passwordChanged) {
            $activityText .= ", password updated";
        }

        Activity::create([
            'user_id' => session('user_id'),
            'description' => $activityText,
            'icon' => 'user',
            'color' => 'indigo-500',
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    // =================
    // Medsos
    // ==================

    // Tampilkan semua sosial media user
    public function medsos() {
        $user = User::find(session('user_id'));
        $sosmeds = Sosmed::where('user_id', $user->id)->get();
        return view('dashboard.admin.medsos', compact('user', 'sosmeds'));
    }

    // Simpan sosial media baru
    public function storeSosmed(Request $request) {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        $sosmed = Sosmed::create([
            'user_id' => session('user_id'),
            'platform' => $request->platform,
            'username' => $request->username,
            'url' => $request->url,
        ]);

        // Logging aktivitas
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Added new social media: ' . $request->platform,
            'icon' => 'plus-circle',
            'color' => 'cyan-500',
        ]);

        return back()->with('success', 'Sosial media berhasil ditambahkan.');
    }

    // Update sosial media
    public function updateSosmed(Request $request, $id) {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        $sosmed = Sosmed::findOrFail($id);
        $oldPlatform = $sosmed->platform;

        $sosmed->update([
            'platform' => $request->platform,
            'username' => $request->username,
            'url' => $request->url,
        ]);

        // Logging aktivitas
        Activity::create([
            'user_id' => session('user_id'),
            'description' => "Updated social media: {$oldPlatform} → {$request->platform}",
            'icon' => 'refresh-ccw',
            'color' => 'yellow-500',
        ]);

        return back()->with('success', 'Sosial media berhasil diperbarui.');
    }

    // Hapus sosial media
    public function deleteSosmed($id) {
        $sosmed = Sosmed::findOrFail($id);
        $deletedPlatform = $sosmed->platform;
        $sosmed->delete();

        // Logging aktivitas
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Deleted social media: ' . $deletedPlatform,
            'icon' => 'trash-2',
            'color' => 'red-500',
        ]);

        return back()->with('success', 'Sosial media berhasil dihapus.');
    }
}
