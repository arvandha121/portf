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

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('custom.auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/about', [AdminController::class, 'about'])->name('admin.about');
    Route::get('/admin/skill', [AdminController::class, 'skill'])->name('admin.skill');
    Route::get('/admin/sertif', [AdminController::class, 'sertif'])->name('admin.sertif');
    Route::get('/admin/portf', [AdminController::class, 'portf'])->name('admin.portf');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route::middleware(['auth.custom'])->prefix('admin')->group(function () {
//     Route::get('/', fn() => view('admin.dashboard'))->name('admin.dashboard');
//     Route::resource('projects', ProjectController::class);
// });

// Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);