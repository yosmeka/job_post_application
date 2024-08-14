{{-- <form method="GET" action="{{ url('/listings') }}">
    <select name="category" class="border border-gray-200 rounded p-2 w-full">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
        Filter
    </button>
</form> --}}