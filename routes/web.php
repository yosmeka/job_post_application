<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;




use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedListingController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SavedApplicantController;
use App\Http\Controllers\EmployerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// All Listings
Route::get('/', [ListingController::class, 'index']);
// Route::middleware(['web'])->group(function () {
//     Route::get('/listings', [ListingController::class, 'index']);
// });

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// mine
Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/employer-dashboard', [EmployerDashboardController::class, 'dashboard'])->name('employer.dashboard');
    Route::post('/employer/save-applicant', [SavedApplicantController::class, 'store'])->name('employer.save-applicant');
    Route::get('/employer/saved-applicants', [SavedApplicantController::class, 'index'])->name('employer.saved-applicants');
    Route::delete('/employer/saved-applicants/{id}', [SavedApplicantController::class, 'destroy'])->name('employer.delete-saved-applicant');
    


});

// application route 
Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');

// dashbord
Route::get('/user/dashboard', [UserDashboardController::class, 'dashboard'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/saved-listings', [SavedListingController::class, 'store'])->name('saved-listings.store');
    Route::get('/saved-listings', [SavedListingController::class, 'index'])->name('saved-listings.index');
    Route::delete('/saved-listings/{id}', [SavedListingController::class, 'destroy'])->name('saved-listings.destroy');
});
