<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
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
    protected function respondWithToken($token)
    {
        return response()->json([
            'token'      => $token,
            'token_type' => 'bearer',
            'User_type'  => Auth::user()->role,
            'expires_in' => auth('api')->factory()->getTTL() * 600000,
            'success'    => true,
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
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => "1",
            'phone'    => $request->phone,
            'gender' => $request->gender,
        ]);
        return response()->json([
            'user_id' => $user->id,
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
            'website_url'    => 'required',
            'yelp_url'    => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => "2",
            'phone'    => $request->phone,
            'website' => $request->website_url,
            'yelp_url' => $request->yelp_url,
            'licence_number' => $request->licence_number,
        ]);
        return response()->json([
            'user_id' => $user->id,
            'message' => 'User Registered successfully',
            'success' => true,
        ]);
    }
    public function getservices()
    {
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
            $user->profile_pic = $request->profile_pic;
            if ($request->profile_pic) {
                $imageData = $request->profile_pic;
                $ext       = explode('/', mime_content_type($imageData))[1];
                if ($ext == 'jpeg') {
                    $ext = 'jpg';
                }
                $filename = 'image_Profile' . time() . '.' . $ext;
                $image    = str_replace('data:image/' . $ext . ';base64,', '', $imageData);
                $image    = str_replace(' ', '+', $image);
                Storage::put('public/uploads/' . $filename, base64_decode($image));
                $user->profile_pic = $filename;
            }
            $user->save();

            //save Gallery
            if ($request->gallery_image) {
                foreach ($request->gallery_image as $index => $imageData) {
                    $ext = explode('/', mime_content_type($imageData))[1];
                    if ($ext == 'jpeg') {
                        $ext = 'jpg';
                    }
                    $filename = 'gallery_image_' . time() . '_' . $index . '.' . $ext;
                    $image = str_replace('data:image/' . $ext . ';base64,', '', $imageData);
                    $image = str_replace(' ', '+', $image);
                    Storage::put('public/uploads/' . $filename, base64_decode($image));
                    $userGallery=UserGallery::make();
                    $userGallery->user_id =Auth::user()->id;
                    $userGallery->image =$filename;
                    $userGallery->save();
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
                'message' => 'Something went wrong!',
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
            $employeeData=new User();
            $employeeData->name=$request->employee_name;
            if ($request->employee_pic) {
                $imageData = $request->employee_pic;
                $ext       = explode('/', mime_content_type($imageData))[1];
                if ($ext == 'jpeg') {
                    $ext = 'jpg';
                }
                $filename = 'image_Profile' . time() . '.' . $ext;
                $image    = str_replace('data:image/' . $ext . ';base64,', '', $imageData);
                $image    = str_replace(' ', '+', $image);
                Storage::put('public/uploads/' . $filename, base64_decode($image));
                $employeeData->profile_pic = $filename;
            }
            $employeeData->save();

            //Create reletion employee and vendor
            $vendorEmployee=new VendorEmployee();
            $vendorEmployee->vendor_user_id = Auth::id();
            $vendorEmployee->employee_user_id  =$employeeData->id;
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
}
