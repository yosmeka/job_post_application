<x-layout>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-6">
            <div class="flex flex-col items-center mb-6">
                <!-- Employer Profile Image -->
                <img class="w-24 h-24 rounded-full mb-4" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('/images/no-profile.png') }}" alt="Employer Profile Image">
                <h3 class="text-lg font-semibold">{{ auth()->user()->name }}</h3>
            </div>
            
            <!-- Navigation Links -->
            <nav class="flex flex-col space-y-2">
                <a href="employer-dashboard" data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="/manage" data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-briefcase mr-3"></i>
                    My Jobs
                </a>
                <a href="/messages"  data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-envelope mr-3"></i>
                    Messages
                </a>
                <a href="/listings/create"  data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-upload mr-3"></i>
                    Submit Jobs
                </a>
                <a href="/saved-candidates" data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-user-check mr-3"></i>
                    Saved Candidates
                </a>
                <a href="/membership" data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-id-card-alt mr-3"></i>
                    Membership
                </a>
                <a href="/settings" data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-cogs mr-3"></i>
                    Account Settings
                </a>
                <a href="/account/delete" data-link class="flex items-center p-2 text-red-500 hover:bg-red-600 rounded transition">
                    <i class="fas fa-trash-alt mr-3"></i>
                    Delete Account
                </a>
                <a href="/logout" data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div id="content" class="flex-1 p-8 bg-gray-100">
            <!-- Dashboard Overview -->
            <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Dashboard Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <div class="flex items-center">
                            <div class="bg-blue-500 text-white p-3 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h3M7 10h3M7 14h10M7 18h6M13 10h7M3 6h18m-9 8h7m-7 4h7"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-600">Active Listings</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $activeListingsCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <div class="flex items-center">
                            <div class="bg-green-500 text-white p-3 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h3m0 0h3m-3 0v3m0-3V9m-9 0h3m0 0H6m3 0v3m0-3V6m4 8h3m0 0h3m-3 0v3m0-3V9"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-600">Applications Received</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $applicationsCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <div class="flex items-center">
                            <div class="bg-red-500 text-white p-3 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l2 2m6-6a9 9 0 11-6-2.001m0 0V7m0 2a9 9 0 01-6 8.707"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-600">Upcoming Deadlines</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $applicationsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manage Job Listings -->
            <div class="mb-8 p-6 bg-gray-50 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Manage Job Listings</h2>
                    <a href="{{ url('/listings/create') }}" class="bg-purple-600 text-white rounded-full py-2 px-6 hover:bg-purple-700 transition duration-200 ease-in-out">Create New Listing</a>
                </div>
                <table class="w-full bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <tr>
                            <th class="p-4 text-left">Title</th>
                            <th class="p-4 text-left">Company</th>
                            <th class="p-4 text-left">Status</th>
                            <th class="p-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listings as $listing)
                        <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="p-4 border-b">{{ $listing->title }}</td>
                            <td class="p-4 border-b">{{ $listing->company }}</td>
                            <td class="p-4 border-b">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $listing->status == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $listing->status }}
                                </span>
                            </td>
                            <td class="p-4 border-b">
                                <a href="{{ url('/listings/' . $listing->id . '/edit') }}" class="text-blue-600 hover:underline">Edit</a> |
                                <form action="{{ url('/listings/' . $listing->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- View Applications -->
            <div class="mb-8 p-6 bg-gray-50 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">View Applications</h2>

                @foreach($listings as $listing)
                    <div class="mb-6 p-4 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">{{ $listing->title }}</h3>
                        <ul class="space-y-4">
                            @forelse($listing->applications as $application)
                                <li class="flex items-center justify-between p-4 bg-gray-100 rounded-lg">
                                    <div>
                                        <p class="text-gray-800 font-medium">{{ $application->user->name }}</p>
                                        <p class="text-gray-600 text-sm">applied for this job</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="text-blue-600 hover:underline">View Resume</a>
                                </li>
                            @empty
                                <li class="p-4 text-gray-500">No applications for this job yet.</li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
