<?php

namespace App\Http\Controllers;
use App\Models\SavedListing;

use Illuminate\Http\Request;

class SavedListingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
        ]);

        // Check if the listing is already saved
        $existingSavedListing = SavedListing::where('user_id', auth()->id())
                                             ->where('listing_id', $request->listing_id)
                                             ->first();

        if ($existingSavedListing) {
            return redirect()->back()->with('message', 'You have already saved this listing.');
        }

        // Save the listing
        SavedListing::create([
            'user_id' => auth()->id(),
            'listing_id' => $request->listing_id,
        ]);

        return redirect()->back()->with('message', 'Job listing saved successfully!');
    }

    public function index()
    {
        $savedListings = SavedListing::where('user_id', auth()->id())->with('listing')->get();

        return view('users.saved-listings', ['savedListings' => $savedListings]);
    }

    public function destroy($id)
    {
        $savedListing = SavedListing::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $savedListing->delete();

        return redirect()->back()->with('message', 'Saved job listing removed successfully!');
    }
}
