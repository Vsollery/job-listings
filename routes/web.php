<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');
//Store Listing Data
Route::post('/listings',[ListingController::class,'store'])->middleware('auth');
//Show edit form
Route::get('/listing/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');
//Update Listing
Route::put('/listing/{listing}',[ListingController::class,'update'])->middleware('auth');
//DELETE
Route::delete('/listing/{listing}',[ListingController::class,'destroy'])->middleware('auth');
//Show single Listings
Route::get('/listings/{listing}', [ListingController::class, 'show']);
//Show regiater form
Route::get('/register',[UserController::class, 'create'])->middleware('guest');
//Store New Users
Route::post('/users',[UserController::class,'store'])->middleware('guest');
//Logout
Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');
//Login Form
Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');
//Authenticate User
Route::post('/users/authenticate',[UserController::class, 'authenticate'])->middleware('guest');