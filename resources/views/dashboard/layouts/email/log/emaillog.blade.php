@extends('dashboard.layouts.index')

@section('page-title', 'Email Log')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">📬 Email Log</h2>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($contacts->count())
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Message</th>
                            <th class="px-6 py-3">Sent At</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($contacts as $index => $contact)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $contact->email }}</td>
                                <td class="px-6 py-4 whitespace-pre-line">
                                    @if ($contact->message)
                                        {{ $contact->message }}
                                    @else
                                        <em class="text-gray-400">No message</em>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $contact->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No email logs found.</p>
        @endif
    </div>
@endsection
