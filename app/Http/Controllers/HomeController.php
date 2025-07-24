<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Homes;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes = Homes::all();
        $user = User::find(session('user_id'));
        return view('dashboard.admin.home', compact('homes', 'user'));
    }

    public function create()
    {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.homes.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'latarbelakang' => 'required|string',
            'teks' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('image', 'public');

        Homes::create([
            'nama' => $request->nama,
            'latarbelakang' => $request->latarbelakang,
            'teks' => $request->teks,
            'gambar' => 'storage/' . $gambarPath,
        ]);

        return redirect()->route('homes.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Homes $home)
    {
        $user = User::find(session('user_id'));
        return view('dashboard.admin.homes.edit', compact('home', 'user'));
    }

    public function update(Request $request, Homes $home)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'latarbelakang' => 'required|string',
            'teks' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus file lama
            if (File::exists(public_path($home->gambar))) {
                File::delete(public_path($home->gambar));
            }

            $gambarPath = $request->file('gambar')->store('image', 'public');
            $home->gambar = 'storage/' . $gambarPath;
        }

        $home->update([
            'nama' => $request->nama,
            'latarbelakang' => $request->latarbelakang,
            'teks' => $request->teks,
        ]);

        return redirect()->route('homes.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Homes $home)
    {
        // Hapus gambar dari storage
        if (File::exists(public_path($home->gambar))) {
            File::delete(public_path($home->gambar));
        }

        $home->delete();

        return redirect()->route('homes.index')->with('success', 'Data berhasil dihapus.');
    }
}
