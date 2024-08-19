<x-layout>
  <x-card class="p-8 max-w-4xl mx-auto mt-12 bg-white shadow-lg rounded-lg">
    <header class="text-center mb-8">
      <h2 class="text-3xl font-bold uppercase text-gray-800 mb-2">Create a Gig</h2>
      <p class="text-gray-600">Post a gig to find a developer</p>
    </header>

    <form method="POST" action="/listings" enctype="multipart/form-data">
      @csrf

      <!-- JOB DETAILS -->
      <h3 class="text-xl font-semibold text-gray-800 mb-6">Job Details</h3>

      <div class="mb-6">
        <label for="title" class="block text-lg font-medium text-gray-700 mb-2">Job Title</label>
        <input type="text" id="title" name="title" placeholder="Example: Senior Laravel Developer" value="{{ old('title') }}"
          class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Job Description</label>
        <textarea id="description" name="description" rows="6" placeholder="Include tasks, requirements, salary, etc"
          class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="category_id" class="block text-lg font-medium text-gray-700 mb-2">Job Category</label>
        <select id="category_id" name="category_id" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Select a category</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $listing->category_id ?? '') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        @error('category_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="job_type" class="block text-lg font-medium text-gray-700 mb-2">Job Type</label>
        <select id="job_type" name="job_type" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Select job type</option>
          <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
          <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
          <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
        </select>
        @error('job_type')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="salary" class="block text-lg font-medium text-gray-700 mb-2">Salary (Monthly or Hourly)</label>
        <div class="flex space-x-4">
          <select name="salary_type" class="border border-gray-300 rounded-lg p-3 flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="monthly" {{ old('salary_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="hourly" {{ old('salary_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
          </select>
          <input type="text" name="min_salary" placeholder="Min" value="{{ old('min_salary') }}"
            class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          <input type="text" name="max_salary" placeholder="Max" value="{{ old('max_salary') }}"
            class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        @error('salary')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- SKILL & EXPERIENCE -->
      <h3 class="text-xl font-semibold text-gray-800 mb-6">Skill & Experience</h3>

      <div class="mb-6">
        <label for="experience" class="block text-lg font-medium text-gray-700 mb-2">Experience</label>
        <select id="experience" name="experience" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="no-experience" {{ old('experience') == 'no-experience' ? 'selected' : '' }}>No Experience</option>
          <option value="intermediate" {{ old('experience') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
          <option value="expert" {{ old('experience') == 'expert' ? 'selected' : '' }}>Expert</option>
        </select>
        @error('experience')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- LOCATION -->
      <h3 class="text-xl font-semibold text-gray-800 mb-6">Location</h3>

      <div class="mb-6">
        <label for="city" class="block text-lg font-medium text-gray-700 mb-2">City</label>
        <select id="city" name="city" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Select city</option>
          <option value="addis-ababa" {{ old('city') == 'addis-ababa' ? 'selected' : '' }}>Addis Ababa</option>
          <option value="hawasa" {{ old('city') == 'hawasa' ? 'selected' : '' }}>Hawasa</option>
          <option value="bahirdar" {{ old('city') == 'bahirdar' ? 'selected' : '' }}>Bahirdar</option>
        </select>
        @error('city')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="state" class="block text-lg font-medium text-gray-700 mb-2">State</label>
        <select id="state" name="state" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Select state</option>
          <option value="state-1" {{ old('state') == 'state-1' ? 'selected' : '' }}>State 1</option>
          <option value="state-2" {{ old('state') == 'state-2' ? 'selected' : '' }}>State 2</option>
          <option value="state-3" {{ old('state') == 'state-3' ? 'selected' : '' }}>State 3</option>
        </select>
        @error('state')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="country" class="block text-lg font-medium text-gray-700 mb-2">Country</label>
        <select id="country" name="country" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Select country</option>
          <option value="ethiopia" {{ old('country') == 'ethiopia' ? 'selected' : '' }}>Ethiopia</option>
          <option value="america" {{ old('country') == 'america' ? 'selected' : '' }}>America</option>
          <option value="london" {{ old('country') == 'london' ? 'selected' : '' }}>London</option>
        </select>
        @error('country')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">
          Contact Email
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" />

        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label for="website" class="inline-block text-lg mb-2">
          Website/Application URL
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
          value="{{old('website')}}" />

        @error('website')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <!-- LOGO UPLOAD -->
      <div class="mb-6">
        <label for="logo" class="block text-lg font-medium text-gray-700 mb-2">Company Logo</label>
        <input type="file" id="logo" name="logo" accept="image/*"
          class="border border-gray-300 rounded-lg p-3 w-full text-gray-700 file:bg-gray-200 file:border-0 file:rounded-md file:p-2 file:text-sm file:font-semibold file:cursor-pointer hover:file:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('logo')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- BUTTONS -->
      <div class="flex justify-between items-center">
        <a href="{{ url()->previous() }}" class="bg-gray-500 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
          Back
        </a>
        <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
          Create Gig
        </button>
      </div>
    </form>
  </x-card>
</x-layout>
