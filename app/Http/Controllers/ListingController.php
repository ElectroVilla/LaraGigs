<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Listing;


class ListingController extends Controller
{
    public function index(){
        return view('listings.index', ['listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)]);
    }

    public function show(Listing $listing){
        // dd($listing);
        return view('listings.show', [ 'listing' => $listing ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
        // dd($request);
        $formField = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formField['user_id'] = auth()->id();
        Listing::create($formField);
        return redirect('/')->with('message', 'Listing created successfully');
    }


    public function edit(Listing $listing){
        return view('listings.edit', [ 'listing' => $listing ]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // dd($request, $listing);
        // dd($request);
        // Make sure Logged in user is owner
        if ($listing->user_id != auth()->id()) {
            about(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);
        // return redirect('/')->with('message', 'Listing created successfully');
        return back()->with('message', 'Listing updated successfully!');
    }


    public function delete(Listing $listing){
        // Make sure Logged in user is owner
        if ($listing->user_id != auth()->id()) {
            about(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
