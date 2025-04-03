<?php

namespace App\Http\Controllers;

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
}
