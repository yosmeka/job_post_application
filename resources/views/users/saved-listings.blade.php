<x-layout>
    <h1>Saved Job Listings</h1>

    @if ($savedListings->isEmpty())
        <p>You haven't saved any job listings yet.</p>
    @else
        <ul>
            @foreach ($savedListings as $savedListing)
                <li>
                    <a href="{{ route('listings.show', $savedListing->listing->id) }}">
                        {{ $savedListing->listing->title }}
                    </a>
                    <form method="POST" action="{{ route('saved-listings.destroy', $savedListing->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</x-layout>
