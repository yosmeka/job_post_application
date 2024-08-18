<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedApplicant;

class SavedApplicantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
        ]);

        // Check if the applicant is already saved
        $existingSavedApplicant = SavedApplicant::where('employer_id', auth()->id())
                                                ->where('application_id', $request->application_id)
                                                ->first();

        if ($existingSavedApplicant) {
            return redirect()->back()->with('message', 'You have already saved this applicant.');
        }

        // Save the applicant
        SavedApplicant::create([
            'employer_id' => auth()->id(),
            'application_id' => $request->application_id,
        ]);

        return redirect()->back()->with('message', 'Applicant saved successfully!');
    }

    public function index()
    {
        $savedApplicants = SavedApplicant::where('employer_id', auth()->id())
                                          ->with('application.user')
                                          ->get();

        return view('employer.saved-applicants', ['savedApplicants' => $savedApplicants]);
    }

    public function destroy($id)
    {
        $savedApplicant = SavedApplicant::where('employer_id', auth()->id())
                                         ->where('id', $id)
                                         ->firstOrFail();
        $savedApplicant->delete();

        return redirect()->back()->with('message', 'Saved applicant removed successfully!');
    }
}
