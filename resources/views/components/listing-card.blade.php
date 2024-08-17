@props(['listing'])

<x-card>
  <div class="flex items-center bg-white p-6 rounded-lg shadow-md mb-6">
    <img class="hidden w-48 h-48 object-cover mr-6 rounded-lg md:block"
         src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}" 
         alt="company_logo" />
    
    <div class="flex-1" >
        <h3 class="text-2xl font-bold text-gray-800 mb-2">
            <a href="/listings/{{ $listing->id }}" class="hover:text-[#059669]  transition duration-200">
                {{ $listing->title }}
            </a>
        </h3>
        <div class="text-xl font-semibold text-[#059669] mb-4">{{ $listing->company }}</div>
        
        <div class="mb-4">
            <x-listing-tags :tagsCsv="$listing->tags" />
        </div>
        
        <div class="text-lg text-gray-700 mb-4 flex items-center">
            <i class="fa-solid fa-location-dot mr-2 text-purple-500"></i> 
            {{ $listing->location }}
        </div>

        <form method="POST" action="{{ route('saved-listings.store') }}" class="mt-4">
            @csrf
            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
            <button type="submit" class="bg-[#065f46] text-white py-2 px-6 rounded-full hover:bg-[#064637] transition duration-200">
                Save Listing
            </button>
        </form>
    </div>
</div>


</x-card>