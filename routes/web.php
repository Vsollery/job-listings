<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Get all Listings
Route::get('/', [ListingController::class, 'index']);

// Route::get('/listing/{id}', function($id){
//     $listing = Listing::find($id);

//     if($listing){
//         return view('listing',[
//             'listing' => Listing::find($id)
//        ]);
//     }else{
//         abort('404');
//     }
// });

//Show create form
Route::get('/listings/create',[ListingController::class,'create']);
//Store Listing Data
Route::post('/listings',[ListingController::class,'store']);
//Show edit form
Route::get('/listing/{listing}/edit',[ListingController::class,'edit']);
//Update Listing
Route::put('/listing/{listing}',[ListingController::class,'update']);
//Show single Listings
Route::get('/listings/{listing}', [ListingController::class, 'show']);