<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/about', [DashboardController::class, 'aboutme'])->name('about');
Route::get('/download-cv', [AdminController::class, 'downloadCV'])->name('download.cv');
Route::get('/skill', [DashboardController::class, 'layoutskill'])->name('layoutskill');
Route::get('/certification', [DashboardController::class, 'certificationLayout'])->name('certification');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('custom.auth')->group(function () {
    // =================
    // DASHBOARD ROUTES
    // =================
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // =================
    // ABOUT ROUTES
    // =================
    Route::get('/admin/about', [AdminController::class, 'about'])->name('admin.about');
    Route::post('/admin/about', [AdminController::class, 'aboutStore'])->name('admin.about.store');
    Route::put('/admin/about/{id}', [AdminController::class, 'aboutUpdate'])->name('admin.about.update');
    Route::delete('/admin/about/{id}', [AdminController::class, 'aboutDelete'])->name('admin.about.delete');
    
    // =================
    // SKILL ROUTES
    // =================
    Route::get('/admin/skill', [AdminController::class, 'skills'])->name('admin.skill');
    Route::post('/admin/skills/create', [AdminController::class, 'storeSkill'])->name('admin.skills.create');
    Route::delete('/admin/skills/{id}/delete', [AdminController::class, 'deleteSkill'])->name('admin.skills.delete');
    Route::post('/admin/skills/{id}/details/create', [AdminController::class, 'storeSkillDetail'])->name('admin.skills.details.create');
    Route::delete('/admin/skills/details/{id}/delete', [AdminController::class, 'deleteSkillDetail'])->name('admin.skills.details.delete');
    Route::put('/admin/skills/{skill}', [AdminController::class, 'updateSkill'])->name('admin.skills.update');
    Route::put('/admin/skills/details/{detail}', [AdminController::class, 'updateSkillDetail'])->name('admin.skills.details.update');

    // Certificate Routes
    Route::get('/admin/sertif', [AdminController::class, 'sertif'])->name('admin.sertif');
    Route::post('/admin/sertif/create', [AdminController::class, 'storeCertificate'])->name('admin.sertif.create');
    Route::delete('/admin/sertif/{id}/delete', [AdminController::class, 'deleteCertificate'])->name('admin.sertif.delete');
    Route::post('/admin/sertif/{id}/detail/create', [AdminController::class, 'storeCertificateDetail'])->name('admin.sertif.detail.create');
    Route::delete('/admin/sertif/detail/{id}/delete', [AdminController::class, 'deleteCertificateDetail'])->name('admin.sertif.detail.delete');
    Route::delete('/admin/sertif/detail/{id}/image/delete', [AdminController::class, 'deleteCertificateImage'])->name('admin.sertif.detail.image.delete');
    Route::put('/admin/sertif/{id}/update', [AdminController::class, 'updateCertificate'])->name('admin.sertif.update');
    Route::put('/admin/sertif/detail/{id}/update', [AdminController::class, 'updateCertificateDetail'])->name('admin.sertif.detail.update');


    Route::get('/admin/portf', [AdminController::class, 'portofolio'])->name('admin.portf');
    Route::post('/admin/portf/store', [AdminController::class, 'storePortofolio'])->name('admin.portf.store');
    Route::put('/admin/portf/update/{id}', [AdminController::class, 'updatePortofolio'])->name('admin.portf.update');
    Route::delete('/admin/portf/delete/{id}', [AdminController::class, 'deletePortofolio'])->name('admin.portf.delete');

    // ================
    // MEDSOS ROUTES
    // =================
    Route::get('/admin/medsos', [AdminController::class, 'medsos'])->name('admin.medsos');
    Route::post('/admin/medsos/create', [AdminController::class, 'storeSosmed'])->name('admin.medsos.create');
    Route::put('/admin/medsos/{id}/update', [AdminController::class, 'updateSosmed'])->name('admin.medsos.update');
    Route::delete('/admin/medsos/{id}/delete', [AdminController::class, 'deleteSosmed'])->name('admin.medsos.delete');

    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/emaillog', [ContactController::class, 'index'])->name('admin.emaillog');
