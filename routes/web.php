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

Route::get('/listing/{listing}', [ListingController::class, 'show']);
