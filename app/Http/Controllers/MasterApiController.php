<?php

namespace App\Http\Controllers;

use App\Models\HelpCenter;
use App\Models\Service;
use App\Models\ServiceCategory;
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
            'expires_in' => auth('api')->factory()->getTTL() * 600000,
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
                'cetegory_id'     => 'required|array',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'success' => false
                ], 400);
            }
            $user = User::findOrFail(Auth::id());
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
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'error'   => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
