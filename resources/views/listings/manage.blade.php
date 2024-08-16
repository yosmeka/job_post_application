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
      </div>
  </div>
</x-layout>

