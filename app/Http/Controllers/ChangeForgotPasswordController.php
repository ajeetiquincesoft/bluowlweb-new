<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class ChangeForgotPasswordController extends Controller
{
    public function forgotPasswordChange(Request $request)
    {
        $user_id = Crypt::decrypt($request->query('key'));
        $user = User::findOrFail($user_id);
        return view('password_genrate',compact('user'));
    }
    public function set_password(Request $request, $id)
    {
        $user_id = Crypt::decrypt($id);
        $user = User::findOrFail($user_id);
        $user->update([
            'password' => bcrypt($request->get('new_password')),
        ]);
        $action = "Password Set";
        return redirect()->back()->with('success', 'Password Set Successfully');;
    }
}
