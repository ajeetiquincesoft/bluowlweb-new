<?php

namespace App\Http\Controllers;

use App\Models\HelpCenter;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServicePricing;
use App\Models\Setting;
use Illuminate\Http\Request;
use JWTAuth;
use Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\UserGallery;
use App\Models\VendorEmployee;
use App\Models\VendorService;
use App\Models\VendorServiceArea;
use App\Models\VendorServiceOffere;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;

class MasterApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }

        // Validate user credentials
        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['message' => 'Your Credentials do not match.', 'success' => false]);
        }

        return $this->respondWithToken($token);
    }
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'success' => true,
            'message' => ' User logout',
        ], 200);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'token'      => $token,
            'token_type' => 'bearer',
            'User_type'  => Auth::user()->role,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'success'    => true,
            'message' => "User Login Successfully"
        ]);
    }
    public function customerRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:2|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'phone'    => 'required|numeric',
            'gender'    => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }
        $userdata = User::make();
        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->password = Hash::make($request->password);
        $userdata->role = "customer";
        $userdata->phone = $request->phone;
        $userdata->gender = $request->gender;
        $userdata->save();

        return response()->json([
            'user_id' => $userdata->id,
            'message' => 'User Registered successfully',
            'success' => true,
        ]);
    }
    public function vendorRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:2|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'phone'    => 'required|numeric',
            'licence_number'    => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }
        $userdata = User::make();
        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->password = Hash::make($request->password);
        $userdata->role = "vendor";
        $userdata->phone = $request->phone;
        $userdata->yelp_url = $request->yelp ?? "";
        $userdata->website_url = $request->website ?? "";
        $userdata->licence_number = $request->licence_number;
        $userdata->save();

        return response()->json([
            'user_id' => $userdata->id,
            'message' => 'User Registered successfully',
            'success' => true,
        ]);
    }
    public function getservices()
    {
        $user_id = Auth::user();
        $services = Service::where('status', 1)->get();

        return response()->json([
            'data' => $services,
            'message' => 'service data',
            'success' => true,
        ]);
    }
    public function gerServiceOffered(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'servive_id'    => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }
        $offereddata = ServiceCategory::where('service_id', $request->servive_id)->get();
        return response()->json([
            'data' => $offereddata,
            'message' => 'Services Offered data',
            'success' => true,
        ]);
    }
    public function vendorMetaData(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'profile_pic'  => 'required',
                'service_id'   => 'required',
                'cetegory_id'  => 'required|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }

            // Find authenticated user
            $user = User::findOrFail(Auth::id());
            $user->about_service = $request->service_note;
            if ($request->profile_pic) {
                $imageData = $request->profile_pic;
                if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                    $ext = strtolower($type[1]);
                    if ($ext === 'jpeg') {
                        $ext = 'jpg';
                    }
                    $filename = 'image_Profile' . time() . '.' . $ext;
                    $image = substr($imageData, strpos($imageData, ',') + 1);
                    $image = str_replace(' ', '+', $image);
                    Storage::put('public/uploads/' . $filename, base64_decode($image));
                    $user->profile_pic = $filename;
                }
            }
            $user->save();

            if ($request->gallery_image) {
                foreach ($request->gallery_image as $imageData1) {
                    if (preg_match('/^data:image\/(\w+);base64,/', $imageData1, $type)) {
                        $ext1 = strtolower($type[1]);
                        if ($ext1 === 'jpeg') {
                            $ext1 = 'jpg';
                        }
                        $filename1 = 'gallery_image_' . time() . rand(10, 100) . '.' . $ext1;
                        $image1 = substr($imageData1, strpos($imageData1, ',') + 1);
                        $image1 = str_replace(' ', '+', $image1);
                        Storage::put('public/uploads/' . $filename1, base64_decode($image1));

                        $userGallery = new UserGallery();
                        $userGallery->user_id = Auth::id();
                        $userGallery->image = $filename1;
                        $userGallery->save();
                    }
                }
            }

            // Save service
            $vendorService = new VendorService();
            $vendorService->user_id = Auth::id();
            $vendorService->service_id = $request->service_id;
            $vendorService->save();

            // Save service offered
            foreach ($request->cetegory_id as $c_id) {
                $vendorServiceOffered = new VendorServiceOffere();
                $vendorServiceOffered->user_id = Auth::id();
                $vendorServiceOffered->service_id = $request->service_id; // Fixed incorrect assignment
                $vendorServiceOffered->service_category_id = $c_id;
                $vendorServiceOffered->save();
            }
            DB::commit();
            return response()->json([
                'message' => 'User Meta Added successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function ChangePassword(Request $request)
    {
        $user      = auth()->user();
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'password'     => 'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }
        if (! Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['message' => 'Old password does not matched', 'success' => false], 401);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message' => 'Password Update successfully', 'success' => true]);
    }
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }
        $Userdata = User::where('email', $request->email)->first();

        if (!$Userdata) {
            return response()->json([
                'message' => 'User Not Found',
                'success' => false,
            ]);
        }
        $link = URL::to('/');

        $url = URL::temporarySignedRoute(
            'forgotPassword',  // Route name
            now()->addHour(),  // Expiration time (1 hour)
            ['key' => encrypt($Userdata->id)] // Parameters passed to route
        );
        $data = [
            'url' => $url,
            'email' => $request->email,
            'username' => $Userdata->name,
            'title' => "Welcome to your new Aerie account with Blue Owl",
            'body' => "Click the link below to reset your password. This link will expire in 1 hour."
        ];
        $mail =  Mail::send('Mail.forgotPassword', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])
                ->subject($data['title']);
        });
        return response()->json([
            'message' => "Mail Send",
            'success' => true,
        ]);
    }
    public function addVendorServiceArea(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'latitude'  => 'required',
                'longitude'   => 'required',
                'address'  => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $vendorServiceArea = new VendorServiceArea();
            $vendorServiceArea->user_id = Auth::id();
            $vendorServiceArea->latitude = $request->latitude;
            $vendorServiceArea->longitude = $request->longitude;
            $vendorServiceArea->address = $request->address;
            $vendorServiceArea->save();
            DB::commit();
            return response()->json([
                'message' => 'User Meta Added successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong!',
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function addVendorEmployee(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'employee_name'  => 'required',
                'employee_pic'   => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            //Create reletion employee and vendor
            $vendorEmployee = new VendorEmployee();
            $vendorEmployee->vendor_user_id = Auth::id();
            $vendorEmployee->name  = $request->employee_name;
            if ($request->employee_pic) {
                $imageData = $request->employee_pic;
                if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                    $ext = strtolower($type[1]);
                    if ($ext === 'jpeg') {
                        $ext = 'jpg';
                    }
                    $filename = 'image_Profile' . time() . '.' . $ext;
                    $image = substr($imageData, strpos($imageData, ',') + 1);
                    $image = str_replace(' ', '+', $image);
                    Storage::put('public/uploads/' . $filename, base64_decode($image));
                    $vendorEmployee->profile_pic = $filename;
                }
            }
            $vendorEmployee->save();
            DB::commit();
            return response()->json([
                'message' => 'User Meta Added successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong!',
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function getUserData()
    {
        $user = User::findOrFail(Auth::id());
        $services = Service::where('status', "1")->get();
        $services_category = VendorService::where('user_id', Auth::id())->first();
        return response()->json([
            'userData' => $user,
            'services' => $services,
            'services_category' => $services_category,
            'message' => 'User Data retrieved successfully.',
            'success' => true,
        ]);
    }
    public function getEmployeeData()
    {
        $auth_id = Auth::id();
        $Vendor_service = VendorService::with('vendorserviveUserwithvendor')->where('user_id', Auth::id())->first();
        $employeeData = VendorEmployee::with('employeeUserwithvendor')->where('vendor_user_id', $auth_id)->get();
        return response()->json([
            'employeeData' => $employeeData,
            'vendor_service' => $Vendor_service,
            'message' => 'Employee Data retrieved successfully.',
            'success' => true,
        ]);
    }
    public function deleteVendorEmployee(Request $request)
    {
        $employee_id = $request->employee_id;
        $vendorEmployee = VendorEmployee::findOrFail($employee_id);
        $vendorEmployee->delete();
        return response()->json([
            'message' => 'Employee data deleted successfully.',
            'success' => true,
        ]);
    }
    public function getVendorMetaData()
    {
        $user_id = Auth::id();
        $userMeta = User::with('vendorservicedata.vendorserviveUserwithvendor', 'vendorwithserviceoffer.vendorserviceofferdata', 'vendorwithgallery')->where('id', $user_id)->first();
        return response()->json([
            'data' => $userMeta,
            'message' => 'Vendor Data retrieved successfully.',
            'success' => true,
        ]);
    }
    public function updateVendorMetaData(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'service_id'      => 'required',
                'licence_number'      => 'required',
                'cetegory_id'     => 'required|array',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $user = User::findOrFail(Auth::id());
            $user->yelp_url = $request->yelp ?? $user->yelp_url;
            $user->website_url = $request->website ?? $user->website_url;
            $user->licence_number = $request->licence_number ?? $user->licence_number;

            $user->about_service = $request->service_note ?? $user->about_service;
            if ($request->profile_pic) {
                $imageData = $request->profile_pic;
                if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                    $ext = strtolower($type[1]);
                    if ($ext === 'jpeg') {
                        $ext = 'jpg';
                    }
                    $filename = 'image_Profile' . time() . '.' . $ext;
                    $image = substr($imageData, strpos($imageData, ',') + 1);
                    $image = str_replace(' ', '+', $image);
                    Storage::put('public/uploads/' . $filename, base64_decode($image));
                    $user->profile_pic = $filename;
                }
            }
            $user->save();

            VendorService::where('user_id', Auth::id())->delete();
            $vendorService = new VendorService();
            $vendorService->user_id = Auth::id();
            $vendorService->service_id = $request->service_id;
            $vendorService->save();

            // Update services offered
            VendorServiceOffere::where('user_id', Auth::id())->delete();
            foreach ($request->cetegory_id as $c_id) {
                $vendorServiceOffered = new VendorServiceOffere();
                $vendorServiceOffered->user_id = Auth::id();
                $vendorServiceOffered->service_id = $request->service_id;
                $vendorServiceOffered->service_category_id = $c_id;
                $vendorServiceOffered->save();
            }

            DB::commit();
            return response()->json([
                'message' => 'User Meta Updated successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function deleteGalleryImage(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'image_id'      => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $gallery = UserGallery::findOrFail($request->image_id);
            $gallery->delete();
            DB::commit();
            return response()->json([
                'message' => 'User Meta Updated successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function addGalleryImage(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'gallery_image' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }

            if ($request->gallery_image) {
                $imageData = $request->gallery_image;
                if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                    $ext = strtolower($type[1]);
                    if ($ext === 'jpeg') {
                        $ext = 'jpg';
                    }
                    $filename = 'gallery_image' . time() . '.' . $ext;
                    $image = substr($imageData, strpos($imageData, ',') + 1);
                    $image = str_replace(' ', '+', $image);
                    Storage::put('public/uploads/' . $filename, base64_decode($image));
                    $Gallery = UserGallery::make();
                    $Gallery->user_id = Auth::id();
                    $Gallery->image = $filename;
                    $Gallery->save();
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'User Meta Updated successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function addVendorArea(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $area = new VendorServiceArea();
            $area->user_id = Auth::id();
            $area->latitude = $request->latitude;
            $area->longitude = $request->longitude;
            $area->address = $request->address;
            $area->save();
            DB::commit();
            return response()->json([
                'message' => 'Area Added successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function editVendorArea(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required',
                'address' => 'required',
                'area_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $area = VendorServiceArea::findoFail($request->area_id);
            $area->latitude = $request->latitude;
            $area->longitude = $request->longitude;
            $area->address = $request->address;
            $area->save();
            DB::commit();
            return response()->json([
                'message' => 'Area  Updated successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function getHelpData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'category' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->all(), 'success' => false], 400);
            }
            $query = HelpCenter::whereStatus(1);
            if ($request->category !== "All") {
                $query->where('category', $request->category);
            }
            $FAQData = $query->get();
            if ($FAQData->isEmpty()) {
                return response()->json(['message' => 'Category not found', 'success' => false], 404);
            }
            return response()->json(['data' => $FAQData, 'message' => 'FAQ Data', 'success' => true]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred', 'success' => false], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred', 'success' => false], 500);
        }
    }
    public function getNotificationData()
    {
        $settingData = Setting::where("user_id", Auth::id())->first();
        return response()->json(['data' => $settingData, 'message' => 'Notification Data', 'success' => true]);
    }
    public function updateNotification(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'notification_status' => 'required|in:0,1',
            ]);
            $userId = auth()->id(); // or use your own logic for the user

            $notificationStatus = $request->notification_status;

            DB::table('settings')->updateOrInsert(
                ['user_id' => $userId], // unique key
                ['notification' => $notificationStatus]
            );
            DB::commit();
            return response()->json([
                'message' => 'Notification Data Submit',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function fetchServiceVendors(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'service_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $serviceVendor = VendorService::where('service_id', $request->service_id)->pluck('user_id');
            $vendorArea = VendorServiceArea::whereIn('user_id', $serviceVendor)
                ->where('status', '1')
                ->get();

            return response()->json([
                "data" =>  $vendorArea,
                'message' => 'Areas  data',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function getVendorArea()
    {
        $user_id = Auth::id();
        $vendorArea = VendorServiceArea::where('user_id', $user_id)->get();
        return response()->json(['data' => $vendorArea, 'message' => 'Area Data', 'success' => true]);
    }
    public function deleteVendorArea(Request $request)
    {

        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'area_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ]);
            }
            $area = VendorServiceArea::findorFail($request->area_id);
            $area->delete();
            DB::commit();
            return response()->json([
                'message' => 'Area  Delete successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ]);
        }
    }
    public function getUnicVendorData(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $vendorData = User::with('vendorservicedata.vendorserviveUserwithvendor', 'UserServicepricingdata.categorywithpricing', 'vendorwithgallery')->where('id', $request->user_id)->first();
            return response()->json([
                'data' => $vendorData,
                'message' => 'Vendor Data retrieved successfully.',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function getServicePricing()
    {
        DB::beginTransaction();
        try {
            $servicePricing = ServicePricing::with('servicewithpricing', 'categorywithpricing')->where('vendor_user_id', Auth::id())->get();
            return response()->json([
                'data' => $servicePricing,
                'message' => 'Pricing  Data retrieved successfully.',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function addServicePricing(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'value' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }

            $vendorServiceOffered = VendorServiceOffere::find($request->id);

            if (!$vendorServiceOffered) {
                return response()->json([
                    'message' => "Invalid Service ID.",
                    'success' => false
                ], 409); // Conflict
            }

            // Check for existing pricing data
            $exists = ServicePricing::where('vendor_user_id', $vendorServiceOffered->user_id)
                ->where('service_id', $vendorServiceOffered->service_id)
                ->where('service_category_id', $vendorServiceOffered->service_category_id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => "Data already exists, please update instead",
                    'success' => false
                ]); // Conflict
            }

            // Save new service pricing
            $price = new ServicePricing();
            $price->service_id = $vendorServiceOffered->service_id;
            $price->service_category_id = $vendorServiceOffered->service_category_id;
            $price->vendor_user_id = $vendorServiceOffered->user_id;
            $price->title = $request->title ?? "";
            $price->value = $request->value;
            $price->save();

            DB::commit();

            return response()->json([
                'message' => 'Service Price added successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
                'success' => false
            ]);
        }
    }
    public function getVendorServiceOffer()
    {
        $vendorService = VendorServiceOffere::with('vendorserviceofferdata')->where('user_id', Auth::id())->get();
        return response()->json([
            'data' => $vendorService,
            'message' => 'vendor Offer Data',
            'success' => true,
        ]);
    }
    public function editServicePricing(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'value' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ]);
            }

            $price = ServicePricing::findOrFail($request->id);
            $price->title = $request->title ?? "";
            $price->value = $request->value;
            $price->save();
            DB::commit();
            return response()->json([
                'message' => 'Service price has been updated successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
                'success' => false
            ]);
        }
    }
    public function getVendorPricing(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $vendorData = User::with('vendorservicedata.vendorserviveUserwithvendor', 'UserServicepricingdata.categorywithpricing')->where('id', $request->user_id)->first();
            return response()->json([
                'data' => $vendorData,
                'message' => 'Vendor Data retrieved successfully.',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function orderStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'vendor_id' => 'required',
                'area_id' => 'required',
                'total_amount' => 'required|numeric',
                'latitude' => 'nullable',
                'longitude' => 'nullable',
                'user_address' => 'required',
                'items' => 'required|array',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $order = Order::create([
                'customer_id' => Auth::id(),
                'area_id' => $request->area_id,
                'vendor_id' => $request->vendor_id,
                'total_amount' => $request->total_amount,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'user_address' => $request->user_address,
                'status' => '2',
            ]);
            foreach ($request->items as $item) {
                $serviceCatData = ServicePricing::with('categorywithpricing', 'servicewithpricing')
                    ->where('vendor_user_id', $request->vendor_id)
                    ->where('service_category_id', $item['service_categories_id'])
                    ->get();
                OrderItem::create([
                    'order_id' => $order->id,
                    'service_categories_id' => $item['service_categories_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'status' => '1',
                    'data' => $serviceCatData->toJson()

                ]);
            }
            DB::commit();
            return response()->json([
                'OrderId' => $order->id,
                'message' => 'Order Added Successfully.',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function getVendorOrders(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $query = Order::with([
                'OrderitemDartaWithOrder.ServiceCalegoryDataWithOrderitem',
                'CustomerDartaWithOrder'
            ])->where('vendor_id', Auth::id());
            if ($request->status === 'new') {
                $query->where('status', 0);
            } elseif ($request->status === 'completed') {
                $query->where('status', 1);
            }
            $vendorOrder = $query->get();
            return response()->json([
                'VendorOrderData' => $vendorOrder,
                'message' => 'Order data.',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function orderComplete(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required|exists:orders,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ]);
            }

            $orderData = Order::findOrFail($request->order_id);
            $orderData->status = "1";
            $orderData->save();

            DB::commit();

            return response()->json([
                'message' => 'Order completed.',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'An error occurred.',
                'error'   => $e->getMessage(),
                'success' => false
            ]);
        }
    }
    public function customerProfileUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'gender' => 'required',
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $user = User::findOrFail(Auth::id());
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            if ($request->profile_pic) {
                $imageData = $request->profile_pic;
                if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                    $ext = strtolower($type[1]);
                    if ($ext === 'jpeg') {
                        $ext = 'jpg';
                    }
                    $filename = 'image_Profile' . time() . '.' . $ext;
                    $image = substr($imageData, strpos($imageData, ',') + 1);
                    $image = str_replace(' ', '+', $image);
                    Storage::put('public/uploads/' . $filename, base64_decode($image));
                    $user->profile_pic = $filename;
                }
            }
            $user->save();
            DB::commit();
            return response()->json([
                'message' => 'User Meta Updated successfully',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
    public function getCustomerOrderHistory()
    {
        $customerOrder = Order::with([
            'OrderitemDartaWithOrder.ServiceCalegoryDataWithOrderitem',
            'CustomerDartaWithOrder',
            'VendorDartaWithOrder.vendorservicedata.vendorserviveUserwithvendor'
        ])->where('customer_id', Auth::id())->latest()
            ->take(20)
            ->get();
        return response()->json([
            'OrderHistory' => $customerOrder,
            'message' => 'User Meta Updated successfully',
            'success' => true,
        ]);
    }
    public function payWithCard(Request $request)
    {
        Stripe::setApiKey(config('STRIPE_SECRET'));


        try {
            $validator = Validator::make($request->all(), [
                'token_id' => 'required',
                'order_id' => 'required|exists:orders,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $orderData = Order::withoutGlobalScope('excludeStatus4')->find($request->order_id);
            $charge = Charge::create([
                'amount' => $orderData->total_amount * 100, // cents
                'currency' => 'usd',
                'description' => 'order Payment',
                'source' => $request->token_id,
            ]);

            if ($charge->status === 'succeeded') {
                $orderData->status = "0";
                $orderData->save();
                $Payment = Payment::make();
                $Payment->order_id = $request->order_id;
                $Payment->token_id = $request->token_id;
                $Payment->data =  json_encode($charge);
                $Payment->status = "1";
                $Payment->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Payment successful!',
                    'charge_id' => $charge->id,
                    'success' => true
                ]);
            } else {
                $Payment = Payment::make();
                $Payment->order_id = $request->order_id;
                $Payment->token_id = $request->token_id;
                $Payment->data = json_decode($charge);
                $Payment->status = "0";
                $Payment->save();
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Payment failed!',
                    'success' => false
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
