<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\SavedListing;



use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Get the user's applications
        $applications = Application::where('user_id', $user->id)->get();

        // Get the user's saved listings
        $savedListings = SavedListing::where('user_id', $user->id)->get();

        return view('users.dashboard', [
            'applications' => $applications,
            'savedListings' => $savedListings,
            
            // Add any other necessary data
        ]);
    }
}
