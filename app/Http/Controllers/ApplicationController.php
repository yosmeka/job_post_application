<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;


class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'cover_letter' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx',
        ]);
    
        $application = new Application();
        $application->user_id = auth()->id();
        $application->listing_id = $request->listing_id;
        $application->cover_letter = $request->cover_letter;
    
        if ($request->hasFile('resume')) {
            $application->resume = $request->file('resume')->store('resumes', 'public');
        }
    
        $application->save();
    
        return redirect()->back()->with('message', 'Application submitted successfully!');
    }
    }
