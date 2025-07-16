@extends('dashboard.layouts.index')

@section('content')
    <section class="contact-form-section">
        <div class="form-container">
            <h2>Contact Me</h2>

            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Message (optional)</label>
                    <textarea name="message" rows="4"></textarea>
                </div>

                <button type="submit" class="submit-button">
                    Send Message
                </button>
            </form>
        </div>
    </section>
@endsection
