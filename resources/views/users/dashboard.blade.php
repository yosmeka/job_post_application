<x-layout>
    <div class="p-8 bg-gray-100 min-h-screen">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">User Dashboard</h1>
        <p class="text-lg text-gray-600 mb-8">Welcome, {{ auth()->user()->name }}!</p>
    
        <!-- Profile management section -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Manage Profile</h2>
            {{-- <a href="{{ route('profile.edit') }}" 
               class="inline-block bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition duration-200">
               Edit Profile
            </a> --}}
        </section>
    
        <!-- Application history section -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Your Applications</h2>
            @if ($applications->isEmpty())
                <p class="text-gray-600">You haven't applied for any jobs yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach ($applications as $application)
                        <li class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-800">
                                    {{ $application->listing->title }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Status: {{ $application->status }}
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    
        <!-- Saved job listings section -->
        <section>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Saved Job Listings</h2>
            @if ($savedListings->isEmpty())
                <p class="text-gray-600">You haven't saved any job listings yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach ($savedListings as $savedListing)
                        <li class="bg-white p-4 rounded-lg shadow-sm">
                            {{-- <a href="{{ route('listings.show', $savedListing->listing->id) }}"  --}}
                               class="text-lg font-semibold text-green-600 hover:text-green-700 transition duration-200">
                                {{ $savedListing->listing->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
    
</x-layout>
