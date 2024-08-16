<x-layout>
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Saved Job Listings</h1>
    
        @if ($savedListings->isEmpty())
            <p class="text-gray-600">You haven't saved any job listings yet.</p>
        @else
            <ul class="space-y-4">
                @foreach ($savedListings as $savedListing)
                    <li class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                        <a href="{{ route('listings.show', $savedListing->listing->id) }}" 
                           class="text-lg font-semibold text-green-600 hover:text-green-700 transition duration-200">
                            {{ $savedListing->listing->title }}
                        </a>
                        <form method="POST" action="{{ route('saved-listings.destroy', $savedListing->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 transition duration-200">
                                Remove
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    
</x-layout>
