@extends('dashboard.layouts.index')

@section('content')
    <section class="hero bg-gray-50">
        <div class="hero-container">
            {{-- Image - mobile di atas, desktop di kanan --}}
            <div class="hero-img">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile Photo">
            </div>

            {{-- Text --}}
            <div class="hero-text">
                <h2>Hi, I'm</h2>
                <h1>Arief Nauvan Ramadha</h1>
                <h3>Informatics Engineering Graduate (GPA 3.62)<br>State Polytechnic of Malang, 2024</h3>
                <p>
                    I'm usually called Nauvan. I have a strong passion for website and mobile development.
                </p>
                <a href="{{ route('contact.create') }}" class="btn-contact">
                    Contact Me <i data-feather="arrow-right"></i>
                </a>

                {{-- <a href="https://mail.google.com/mail/u/0/?tf=cm&amp;fs=1&amp;to=cparvandha@gmail.com" class="btn-contact"
                    target="_blank">
                    Contact Me <i data-feather="arrow-right"></i>
                </a> --}}
            </div>
        </div>
    </section>
@endsection
