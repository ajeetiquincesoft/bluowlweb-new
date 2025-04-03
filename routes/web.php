<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicesAndPricingController;
use App\Http\Controllers\ServiceCategoriesController;
use Illuminate\Support\Facades\Auth;

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
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
   return redirect('/login');
});

Auth::routes();
Route::middleware(['auth', 'admin'])->group(function () {
   //HomeController
   Route::get('/home', [HomeController::class, 'index'])->name('home');
   Route::get('/setting', [HomeController::class, 'setting'])->name('setting');

   //VendorController
   Route::get('/vendors', [VendorController::class, 'index'])->name('vendors');
   Route::get('/vendor-details', [VendorController::class, 'vendordetail'])->name('vendor-details');

   //TransactionController
   Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');

   //ServicesAndPricingController
   Route::get('/services-pricing', [ServicesAndPricingController::class, 'index'])->name('servicesAndPricing');
   Route::get('/our-services', [ServicesAndPricingController::class, 'ourServices'])->name('our-services');
   Route::POST('/add-service', [ServicesAndPricingController::class, 'addServices'])->name('add-service');
   Route::POST('/edit-service-pricing/{id}', [ServicesAndPricingController::class, 'editServicePricing'])->name('edit-service-pricing');
   Route::POST('/add-service-pricing', [ServicesAndPricingController::class, 'addServicePricing'])->name('add-service-pricing');
   Route::POST('/edit-Service/{id}', [ServicesAndPricingController::class, 'editServices'])->name('edit-Service');


   //UserController
   Route::post('changepassword', [UserController::class, 'changepassword'])->name('changepassword');
   Route::POST('Profile_Image_update', [UserController::class, 'profileImageUpdate'])->name('Profile_Image_update');
   Route::POST('update_profile', [UserController::class, 'updateProfile'])->name('update_profile');

   //ServiceCategoriesController
   Route::get('/service-category', [ServiceCategoriesController::class, 'index'])->name('service-category');
   Route::get('/get-categories', [ServiceCategoriesController::class, 'getCategories'])->name('get-categories');
   Route::POST('/add-cetegory', [ServiceCategoriesController::class, 'addCategory'])->name('add-cetegory');
   Route::POST('/edit-Service-category/{id}', [ServiceCategoriesController::class, 'editServiceCatogery'])->name('edit-Service-category');
   // Route::view('/vendors-details', 'vendors-details');
   // Route::view('/transactions', 'transactions');
   // Route::view('/settings', 'settings');

   // Route::get('vendors', [VendorController::class, 'vendors']);
   // Route::get('vendors-details/{id}', [VendorController::class, 'vendordetail']);
   // Route::post('change_password', [UserController::class, 'change_password'])->name('change_password');
});
