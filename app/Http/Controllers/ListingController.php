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
            'listings' => Listing::latest()->filter(request(['tags', 'search']))->paginate(6)->withQueryString()
        ]);
    }
    //Show Single Listing
    public function show(Listing $listing){
        $flag = 1;
        
            if($listing->user_id != auth()->id()){
                $flag = 0;
            }

        return view('listings.show',[
            'listing' => $listing,
            'flag' => $flag
        ]);
    }
    //Show Create Form
    public function create(){
        return view('listings.create');
    }
    
    //Store Listing Data
    public function store(Request $request){
        // dd($request->file('logo'));
        $formField = $request->validate([
            'title'=> 'required|max:255',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags'=> 'required',
            'description' => 'required|max:1000'
        ]);

        if($request->hasFile('logo')){
            $formField['logo'] = $request->file('logo')->store('logos','public');
        }

        $formField['user_id'] = auth()->user()->id;

        Listing::create($formField);
        
        return redirect('/')->with('message','Listing Created!');
    }

    public function edit(Listing $listing){
        $flag = 1;
        if($listing->user_id != auth()->user()->id){
            $flag = 0;
            abort(403, 'Unautharized action');
        }

        return view('listings.edit',[
            'listing' => $listing,
            'flag' => $flag
        ]);
    }

    public function update(Request $request, Listing $listing){

        //Make sure logged in owner is user
        $flag = 1;
        if($listing->user_id != auth()->user()->id){
            $flag = 0;
            abort(403, 'Unautharized action');
        }

        $formField = $request->validate([
            'title'=> 'required|max:255',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags'=> 'required',
            'description' => 'required|max:1000'
        ]);

        if($request->hasFile('logo')){
            $formField['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formField);
        
        return back()->with('message','Listing Updated!');
    }
    
    public function destroy(Listing $listing){
        if($listing->user_id != auth()->user()->id){
            abort(403, 'Unautharized action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted');
    }
    public function manage(){
        return view('listings.manage',[
            'listings' => auth()->user()->listings()->get()
        ]);
    }
}
