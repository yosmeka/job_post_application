<x-layout>
    <h1>User Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <!-- Profile management section -->
    <section>
        <h2>Manage Profile</h2>
        {{-- <a href="{{ route('profile.edit') }}">Edit Profile</a> --}}
    </section>

    <!-- Application history section -->
    <section>
        <h2>Your Applications</h2>
        @if ($applications->isEmpty())
            <p>You haven't applied for any jobs yet.</p>
        @else
            <ul>
                @foreach ($applications as $application)
                    <li>{{ $application->listing->title }} - {{ $application->status }}</li>
                @endforeach
            </ul>
        @endif
    </section>

    <!-- Saved job listings section -->
    {{-- <section>
        <h2>Saved Job Listings</h2>
        @if ($savedListings->isEmpty())
            <p>You haven't saved any job listings yet.</p>
        @else
            <ul>
                @foreach ($savedListings as $savedListing)
                    <li>{{ $savedListing->listing->title }}</li>
                @endforeach
            </ul>
        @endif
    </section> --}}
</x-layout>
