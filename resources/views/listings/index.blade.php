<x-layout>
  @if (!Auth::check())
    @include('partials._hero')
  @endif

  @include('partials._search')

  <form method="GET" action="{{ url('/') }}" class="w-full max-w-lg ml-auto p-5 bg-white rounded-lg shadow-md">
    <div class="flex items-center space-x-4">
        <select name="category" 
                class="border border-gray-300 rounded-lg p-3 flex-1 bg-gray-50 text-gray-700 focus:outline-none focus:border-green-500 transition duration-200">
            <option value="" disabled selected>All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" 
                class="bg-green-600 text-white rounded-lg py-3 px-6 hover:bg-green-700 transition duration-200">
            Filter
        </button>
    </div>
</form>


  <div class="lg:grid lg:grid-cols-2 gap-4 mt-5 space-y-4 md:space-y-0 mx-4">

    @unless(count($listings) == 0)

    @foreach($listings as $listing)
    <x-listing-card :listing="$listing" />
    @endforeach

    @else
    <p>No listings found</p>
    @endunless

  </div>

  <div class="mt-6 p-4">
    {{$listings->links()}}
  </div>
</x-layout>
