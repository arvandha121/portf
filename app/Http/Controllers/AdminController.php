<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Skill;
use App\Models\SkillDetail; 
use App\Models\Sosmed;
use App\Models\Activity;
use App\Models\Certificate;
use App\Models\CertificateDetail;
use App\Models\ProjectPortofolio;
use App\Models\AboutMe;

class AdminController extends Controller
{
    public function index() {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalUsers = User::count();
        $totalSkills = Skill::count();
        $totalCertificates = Certificate::count();
        $totalPortofolios = ProjectPortofolio::count();
        $activities = Activity::where('user_id', $user->id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('dashboard.admin.dashboard', compact(
            'totalSkills', 'totalUsers', 'totalCertificates', 'totalPortofolios', 'user', 'activities'
        ));
    }

    // =================
    // About
    // =================
    public function about()
    {
        $about = AboutMe::first();
        $user = User::find(session('user_id'));

        return view('dashboard.admin.about', compact('about', 'user'));
    }

    public function aboutStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'description' => 'required',
            'years_experience' => 'required|integer|min:0',
            'certification_total' => 'required|integer|min:0',
            'companies_worked' => 'required|integer|min:0',
            'cv_file' => 'nullable|mimes:pdf,doc,docx|max:4096',
        ]);

        $imagePath = $request->file('image')->store('about', 'public');
        $cvPath = $request->file('cv_file')?->store('cv_files', 'public');

        AboutMe::create([
            'image' => $imagePath,
            'description' => $request->description,
            'years_experience' => $request->years_experience,
            'certification_total' => $request->certification_total,
            'companies_worked' => $request->companies_worked,
            'cv_file' => $cvPath,
        ]);

        return back()->with('success', 'About Me berhasil ditambahkan.');
    }

    public function aboutUpdate(Request $request, $id)
    {
        $about = AboutMe::findOrFail($id);

        $request->validate([
            'description' => 'required',
            'years_experience' => 'required|integer|min:0',
            'certification_total' => 'required|integer|min:0',
            'companies_worked' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'cv_file' => 'nullable|mimes:pdf,doc,docx|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $about->image = $request->file('image')->store('about', 'public');
        }

        if ($request->hasFile('cv_file')) {
            if ($about->cv_file && Storage::disk('public')->exists($about->cv_file)) {
                Storage::disk('public')->delete($about->cv_file);
            }
            $about->cv_file = $request->file('cv_file')->store('cv_files', 'public');
        }

        $about->description = $request->description;
        $about->years_experience = $request->years_experience;
        $about->certification_total = $request->certification_total;
        $about->companies_worked = $request->companies_worked;
        $about->save();

        return back()->with('success', 'About Me berhasil diperbarui.');
    }

    public function aboutDelete($id)
    {
        $about = AboutMe::findOrFail($id);

        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }

        if ($about->cv_file && Storage::disk('public')->exists($about->cv_file)) {
            Storage::disk('public')->delete($about->cv_file);
        }

        $about->delete();

        return back()->with('success', 'About Me berhasil dihapus.');
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

    // ===============================
    // Sertificates
    // ===============================

    public function sertif()
    {
        $user = User::find(session('user_id'));
        $certificates = Certificate::with('details')
            ->where('user_id', session('user_id'))
            ->latest()
            ->get();

        return view('dashboard.admin.sertificate', compact('certificates', 'user'));
    }

    public function storeCertificate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        Certificate::create([
            'user_id' => session('user_id'),
            'title' => $request->title,
        ]);

        return back()->with('success', 'Sertifikat berhasil ditambahkan');
    }

    public function updateCertificate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $certificate = Certificate::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $certificate->update(['title' => $request->title]);

        return back()->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function deleteCertificate($id)
    {
        $certificate = Certificate::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $certificate->details()->delete();
        $certificate->delete();

        return back()->with('success', 'Sertifikat berhasil dihapus');
    }

    public function storeCertificateDetail(Request $request, $certificateId)
    {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $certificate = Certificate::where('id', $certificateId)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('certificate_images', 'public');
        }

        $certificate->details()->create([
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imagePath,
        ]);

        // Log aktivitas
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Menambahkan detail sertifikat: ' . $request->subtitle,
            'icon' => 'plus-circle',
            'color' => 'cyan-500',
        ]);

        return back()->with('success', 'Detail sertifikat berhasil ditambahkan.');
    }

    public function updateCertificateDetail(Request $request, $id)
    {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $detail = CertificateDetail::findOrFail($id);

        if ($detail->certificate->user_id != session('user_id')) {
            abort(403);
        }

        $data = $request->only(['subtitle', 'description', 'link']);

        if ($request->hasFile('image')) {
            if ($detail->image) {
                Storage::disk('public')->delete($detail->image);
            }
            $data['image'] = $request->file('image')->store('certificate_images', 'public');
        }

        $detail->update($data);

        return back()->with('success', 'Detail sertifikat berhasil diperbarui.');
    }

    public function deleteCertificateDetail($id)
    {
        $detail = CertificateDetail::findOrFail($id);

        // Cek kepemilikan sertifikat
        if ($detail->certificate->user_id != session('user_id')) {
            abort(403);
        }

        $deletedTitle = $detail->subtitle;

        if ($detail->image) {
            Storage::disk('public')->delete($detail->image);
        }

        $detail->delete();

        // Log aktivitas
        Activity::create([
            'user_id' => session('user_id'),
            'description' => 'Menghapus detail sertifikat: ' . $deletedTitle,
            'icon' => 'trash-2',
            'color' => 'red-500',
        ]);

        return back()->with('success', 'Detail sertifikat berhasil dihapus.');
    }

    public function deleteCertificateImage($id)
    {
        $detail = CertificateDetail::findOrFail($id);

        if ($detail->certificate->user_id != session('user_id')) {
            abort(403);
        }

        if ($detail->image) {
            Storage::disk('public')->delete($detail->image);
            $detail->update(['image' => null]);
        }

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    // ===========================
    // Portofolio
    // ===========================

    public function portofolio() {
        $user = User::find(session('user_id'));
        $portofolios = ProjectPortofolio::where('user_id', $user->id)->get();
        return view('dashboard.admin.portofolio', compact('user', 'portofolios'));
    }

    public function storePortofolio(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tipe' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'nullable|url|max:255',
        ]);

        $imagePath = $request->file('image')->store('portofolio', 'public');

        ProjectPortofolio::create([
            'user_id' => session('user_id'),
            'title' => $request->title,
            'tipe' => $request->tipe,
            'description' => $request->description,
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.portf')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function updatePortofolio(Request $request, $id)
    {
        $portofolio = ProjectPortofolio::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'tipe' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($portofolio->image) {
                Storage::disk('public')->delete($portofolio->image);
            }

            $imagePath = $request->file('image')->store('portofolio', 'public');
            $portofolio->image = $imagePath;
        }

        $portofolio->title = $request->title;
        $portofolio->tipe = $request->tipe;
        $portofolio->description = $request->description;
        $portofolio->link = $request->link;
        $portofolio->save();

        return redirect()->route('admin.portf')->with('success', 'Portofolio berhasil diupdate.');
    }

    public function deletePortofolio($id)
    {
        $portofolio = ProjectPortofolio::findOrFail($id);

        if ($portofolio->image) {
            Storage::disk('public')->delete($portofolio->image);
        }

        $portofolio->delete();
        return redirect()->route('admin.portf')->with('success', 'Portofolio berhasil dihapus.');
    }
}
