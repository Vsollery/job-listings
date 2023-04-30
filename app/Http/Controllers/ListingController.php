<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ListingController extends Controller
{
    //Get All Listing
    public function index(){
        //dd(request()->tags);
        return view('listings.index',[
            'listings' => Listing::latest()->filter(request(['tags']))->get()
        ]);
    }
    //Show Single Listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
        ]);
    }
}
