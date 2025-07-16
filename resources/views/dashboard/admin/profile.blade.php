@extends('dashboard.admin.index')

@section('page-title', 'Profile')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Profile</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-100 focus:outline-none border-gray-300">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-100 focus:outline-none border-gray-300">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">New Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-100 focus:outline-none border-gray-300">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-100 focus:outline-none border-gray-300">
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition duration-200">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
@endsection
