<?php

// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;


class ContactController extends Controller
{
    public function create()
    {
        return view('dashboard.layouts.email.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        // Simpan ke database
        Contact::create([
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Kirim email ke nauvan
        Mail::to('nauvan121@gmail.com')->send(
            new ContactMessageMail($request->email, $request->message)
        );

        return redirect()->back()->with('success', 'Thank you for contacting me!');
    }

}
