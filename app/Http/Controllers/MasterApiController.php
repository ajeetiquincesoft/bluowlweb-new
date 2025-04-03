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

        // Check if the user's status is "1"
        $user = auth()->user();
        if ($user->status != 1) {
            return response()->json(['message' => ' Your account is pending approval. Once the GotGas admin approves your account, we will notify you via email.', 'success' => false], 403);
        }

        // Generate token and respond
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
            'gender'=> $request->gender,
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
            'website'=> $request->website_url,
            'yelp_url'=> $request->yelp_url,
            'licence_number'=> $request->licence_number,
        ]);
        return response()->json([
            'user_id' => $user->id,
            'message' => 'User Registered successfully',
            'success' => true,
        ]);
    }
    public function getservices()
    {
        $services=Service::where('status',1)->get();
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
        $offereddata=ServiceCategory::where('service_id',$request->servive_id)->get();
        return response()->json([
            'data' => $offereddata,
            'message' => 'Services Offered data',
            'success' => true,
        ]);

    }
    public function vendorMetaData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_pic'     => 'required',
            'service_id'    => 'required|email|unique:users',
            'cetegory_id' => 'required|array',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors, 'success' => false], 400);
        }
        $user=User::findorFail(Auth::user()->id);
        $user->profile_pic=$request->profile_pic;
        $user->save();

        return response()->json([
            'user_id' => $user->id,
            'message' => 'User Registered successfully',
            'success' => true,
        ]);
    }


}
