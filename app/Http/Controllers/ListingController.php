<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;


use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    // public function index() {
    //     return view('listings.index', [
    //         'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
    //     ]);
    // }
    // public function index() {
    //     $listings = Listing::where(function($query) {
    //         $query->whereNull('expiry_date')
    //               ->orWhere('expiry_date', '>=', now());
    //     })->latest()->filter(request(['tag', 'search']))->paginate(6);
       
    
    //     return view('listings.index', ['listings' => $listings]);
    // }

    public function index(){
    $categories = Category::all();
    
    $listings = Listing::where(function($query) {
        $query->whereNull('expiry_date')
              ->orWhere('expiry_date', '>=', now());
    })
    ->when(request('category'), function ($query) {
        $query->where('category_id', request('category'));
    })
    ->latest()
    ->filter(request(['tag', 'search']))
    ->paginate(6);


    return view('listings.index', ['listings' => $listings, 'categories' => $categories]);
}


    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    // public function create() {
    //     return view('listings.create');
    // }

public function create()
{
    $categories = Category::all();
    return view('listings.create', compact('categories'));
}

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'expiry_date' => 'nullable|date|after_or_equal:today',
            'category_id' => 'required|exists:categories,id', // Validate category_id


            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    // public function edit(Listing $listing) {
    //     return view('listings.edit', ['listing' => $listing]);
    // }

    public function edit(Listing $listing)
{
    $categories = Category::all();
    return view('listings.edit', compact('listing', 'categories'));
}

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'expiry_date' => 'nullable|date|after_or_equal:today',
            'category_id' => 'required|exists:categories,id', // Validate category_id


            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
