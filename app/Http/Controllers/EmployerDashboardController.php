<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use App\Models\Application;


use Illuminate\Http\Request;
use App\Models\SavedCandidate;

class EmployerDashboardController extends Controller
{

    public function dashboard()
{
    $user = auth()->user();
    $listings = Listing::where('user_id', $user->id)->get();

    // Get all applications for these listings
    $applications = Application::whereIn('listing_id',  $listings->pluck('id'))->get();

    // Count of active listings
    $activeListingsCount = Listing::where('user_id', $user->id)
                                  ->where(function($query) {
                                      $query->whereNull('expiry_date')
                                            ->orWhere('expiry_date', '>=', now());
                                  })
                                  ->count();

    // Count of applications received (if needed)
    $applicationsCount = Application::whereIn('listing_id', function($query) use ($user) {
                                    $query->select('id')
                                          ->from('listings')
                                          ->where('user_id', $user->id);
                                })
                                ->count();

    // Count of upcoming deadlines (if needed)
    $upcomingDeadlinesCount = Listing::where('user_id', $user->id)
                                     ->whereDate('expiry_date', '>=', now())
                                     ->count();

    // Pass the counts to the view


    return view('employer.dashboard', [
        'activeListingsCount' => $activeListingsCount,
        'applicationsCount' => $applicationsCount,
        // 'applications' => $applications,
        'upcomingDeadlinesCount' => $upcomingDeadlinesCount,
        'listings' =>$listings,
        'applications' => $applications,

        // Add any other data you need
    ]);
}

   // saved candidates
    public function saveCandidate(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
        ]);

        $existingSavedCandidate = SavedCandidate::where('employer_id', auth()->id())
                                                ->where('application_id', $request->application_id)
                                                ->first();

        if ($existingSavedCandidate) {
            return redirect()->back()->with('message', 'This candidate is already saved.');
        }

        SavedCandidate::create([
            'employer_id' => auth()->id(),
            'application_id' => $request->application_id,
        ]);

        return redirect()->back()->with('message', 'Candidate saved successfully!');
    }

    public function viewSavedCandidates()
    {
        $savedCandidates = SavedCandidate::where('employer_id', auth()->id())->with('application.user')->get();

        return view('employer.saved-candidates', compact('savedCandidates'));
    }
}
