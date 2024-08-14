<x-layout>
    <h1 class="text-2xl font-bold mb-4">Employer Dashboard</h1>
    <p class="mb-4">Welcome to your dashboard, {{ auth()->user()->name }}!</p>
    
    <!-- Dashboard Overview -->
    <div class="mb-6 p-4 bg-gray-100 rounded shadow-md">
        <h2 class="text-xl font-semibold">Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold">Active Listings</h3>
                <p>{{ $activeListingsCount }}</p>
                {{-- <p>45</p> --}}
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold">Applications Received</h3>
                <p>{{ $applicationsCount }}</p>
                {{-- <p>45</p> --}}

            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold">Upcoming Deadlines</h3>
                {{-- <p>{{ $upcomingDeadlinesCount }}</p> --}}
                <p>45</p>

            </div>
        </div>
    </div>
    
    <!-- Manage Job Listings -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Manage Job Listings</h2>
        <a href="{{ url('/listings/create') }}" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black mb-4 inline-block">Create New Listing</a>
        <table class="w-full bg-white border border-gray-200 rounded">
            <thead>
                <tr>
                    <th class="p-2 border-b">Title</th>
                    <th class="p-2 border-b">Company</th>
                    <th class="p-2 border-b">Status</th>
                    <th class="p-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listings as $listing)
                <tr>
                    <td class="p-2 border-b">{{ $listing->title }}</td>
                    <td class="p-2 border-b">{{ $listing->company }}</td>
                    <td class="p-2 border-b">{{ $listing->status }}</td>
                    <td class="p-2 border-b">
                        <a href="{{ url('/listings/' . $listing->id . '/edit') }}" class="text-blue-500">Edit</a> |
                        <form action="{{ url('/listings/' . $listing->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- View Applications -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">View Applications</h2>
        <!-- Application details and management would go here -->
        @foreach( $listings as $listing)
    <h2>{{ $listing->title }}</h2>
    <ul>
        @foreach($listing->applications as $application)
            <li>
                {{ $application->user->name }} applied for this job.
                <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">View Resume</a>
            </li>
        @endforeach
    </ul>
@endforeach

    </div>
    
    <!-- Profile Management -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Profile Management</h2>
        <a href="{{ url('/profile/edit') }}" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Edit Profile</a>
    </div>
    
    <!-- Notifications -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Notifications</h2>
        <!-- Display notifications here -->
    </div>
    
    <!-- Statistics and Reports -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Statistics and Reports</h2>
        <!-- Display reports and download options here -->
    </div>
    
    <!-- Settings -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Settings</h2>
        <a href="{{ url('/settings') }}" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Account Settings</a>
    </div>
</x-layout>
