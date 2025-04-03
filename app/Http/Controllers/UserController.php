<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Validator;

class UserController extends Controller
{
    //
    // public function change_password(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'old_password' => 'required',
    //         'new_password' => 'required',
    //         'confirm_password' => 'required|same:new_password',
    //     ]);
    //     if ($validator->fails()) {
    //         return back()->withSuccess($validator->errors()->all());
    //     }

    //     $user  = User::find(Auth::user()->id);

    //     if(Hash::check($request->old_password, $user->password)){
    //         $user->password  = bcrypt($request->new_password);
    //         $user->save();
    //         return back()->withSuccess('Password changed successfully.');
    //     }else{
    //         return back()->withSuccess('Old password is Invalid.');
    //     }
    // }

    public function changepassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            Alert::error('Error Title', 'Your current password does not matches with the password');
            return redirect()->back();
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            // Current password and new password same
            Alert::error('Error Title', 'New Password cannot be same as your current password');
            return redirect()->back();
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        Alert::success('Congratulations!', 'Password has been changed!');
        return redirect()->back();
    }
    public function profileImageUpdate(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('file')) {
            $filename = upload_image($request->file('file'));
            $user->profile_pic = $filename;
            $user->save();
        }
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'website' => 'required',
            'description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $User=User::findorFail(Auth::user()->id);
            $User->name = $request->fullname;
            $User->phone = $request->phone;
            $User->website_url = $request->website;
            $User->about_service = $request->description;
            $User->save();
            DB::commit();
            Alert::success('Congratulations!', 'Profile Updated Succesfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('ErrorAlert', $e->getMessage());
            return redirect()->back();
        }

    }
}
