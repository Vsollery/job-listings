<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class ListingController extends Controller
{
    //Get All Listing
    public function index(){
        //dd(request()->tags);
        return view('listings.index',[
            'listings' => Listing::latest()->filter(request(['tags', 'search']))->get()
        ]);
    }
    //Show Single Listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
        ]);
    }
    //Show Create Form
    public function create(){
        return view('listings.create');
    }
    
    //Store Listing Data
    public function store(Request $request){
        $formField = $request->validate([
            'title'=> 'required|max:255',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags'=> 'required',
            'description' => 'required|max:1000'
        ]);

        Listing::create($formField);
        
        return redirect('/');
    }
}
