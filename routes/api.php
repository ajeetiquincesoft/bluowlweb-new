<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\MasterApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Authentication Routes
Route::group(['middleware' => 'api'], function ($router) {
    Route::POST('customerRegister', [MasterApiController::class, 'customerRegister']);
    Route::POST('vendorRegister', [MasterApiController::class, 'vendorRegister']);
    Route::POST('login', [MasterApiController::class, 'Login']);
    Route::POST('signout', [MasterApiController::class, 'logout']);
});
Route::group(['middleware' => 'auth.jwt', 'prefix' => 'auth'], function ($router) {
    Route::GET('getservices', [MasterApiController::class, 'getservices']);
    Route::POST('gerServiceOffered', [MasterApiController::class, 'gerServiceOffered']);
    Route::POST('vendorMetaData', [MasterApiController::class, 'vendorMetaData']);
    Route::POST('ChangePassword', [MasterApiController::class, 'ChangePassword']);
    Route::POST('addVendorServiceArea', [MasterApiController::class, 'addVendorServiceArea']);
    Route::POST('addVendorEmployee', [MasterApiController::class, 'addVendorEmployee']);
    Route::GET('getUserData', [MasterApiController::class, 'getUserData']);
    Route::GET('getEmployeeData', [MasterApiController::class, 'getEmployeeData']);
    Route::GET('getVendorMetaData', [MasterApiController::class, 'getVendorMetaData']);
    Route::POST('deleteVendorEmployee', [MasterApiController::class, 'deleteVendorEmployee']);
});
// Route::post('login', [UserController::class, 'login']);
// Route::post('logout', [UserController::class, 'logout']);
// Route::post('register', [UserController::class, 'register']);
// Route::post('passwordUpdate', [UserController::class, 'passwordUpdate']);
// Route::post('getdetail', [UserController::class, 'getdetail']);
// Route::post('AddEmployee', [UserController::class, 'AddEmployee']);
// Route::post('profileImage', [UserController::class, 'profileImage']);
// Route::post('editemployee', [UserController::class, 'editemployee']);
// Route::post('employeelist', [UserController::class, 'employeelist']);
// Route::post('deleteemployee', [UserController::class, 'deleteemployee']);

// // Area Routes
// Route::post('addarea', [AreaController::class, 'addarea']);
// Route::post('allarea', [AreaController::class, 'allarea']);
// Route::post('editarea', [AreaController::class, 'editarea']);
// Route::post('deletearea', [AreaController::class, 'deletearea']);
// Route::post('area_module', [AreaController::class, 'area_module']);

// // Subscription Routes
// Route::post('subscription', [UserController::class, 'register']);
// Route::post('getlocationdetail', [UserController::class, 'getlocationdetail']);
// Route::post('cancelsubscription', [SubscriptionController::class, 'cancelsubscription']);
// Route::post('resubscribe', [SubscriptionController::class, 'resubscribe']);

// // Service Routes
// Route::post('servicecategory', [ServiceController::class, 'servicecategory']);
// Route::post('serviceoffered', [ServiceController::class, 'serviceoffered']);
// Route::post('getservicequestion', [ServiceController::class, 'getservicequestion']);
// Route::post('getserviceallquestion', [ServiceController::class, 'getserviceallquestion']);
// Route::post('updateservicedetail', [ServiceController::class, 'updateservicedetail']);

// // Customer Routes
// Route::post('customerrequest', [CustomerController::class, 'customerrequest']);
// Route::post('enquirylist', [CustomerController::class, 'enquirylist']);
// Route::post('markcomplete', [CustomerController::class, 'markcomplete']);

// // Transaction & Invoice Routes
// Route::post('gettoken', [UserController::class, 'gettoken']);
// Route::post('getinvoice', [UserController::class, 'getinvoice']);
// Route::post('gettransaction', [UserController::class, 'gettransaction']);
