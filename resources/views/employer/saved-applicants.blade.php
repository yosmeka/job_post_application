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
            <a href="{{ route('employer.saved-applicants') }}" data-link class="flex items-center p-2 hover:bg-gray-700 rounded transition">
            
                <i class="fas fa-user-check mr-3"></i>
              Save Candidates

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
    <div class="bg-white p-6 rounded-lg shadow-md flex-grow">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Saved Applicants</h1>
        
        @if ($savedApplicants->isEmpty())
            <p class="text-gray-500">No saved applicants yet.</p>
        @else
            <ul class="space-y-4">
                @foreach ($savedApplicants as $savedApplicant)
                    <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                        <div class="text-gray-700 font-medium">
                            {{ $savedApplicant->application->user->name }}
                        </div>
                        <form action="{{ route('employer.delete-saved-applicant', $savedApplicant->id) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-semibold py-1 px-3 rounded-full shadow-md transition duration-300 ease-in-out transform hover:bg-red-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 active:scale-95 text-sm">
                                Remove
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>  
    
</div>
</x-layout>
