<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Mail;

class VendorController extends Controller
{
    //
    public function vendors(Request $request)
    {
        $vendors = User::with('services.offers')->where('role', 'vendor')->orderBy('id', 'DESC')->paginate(10);
        return view('vendors', [
            'vendors' => $vendors
        ]);
    }
    public function index()
    {
        $userMeta = User::with('vendorservicedata.vendorserviveUserwithvendor', 'vendorwithserviceoffer.vendorserviceofferdata', 'vendorwithgallery')->where('role', "vendor")->get();
        return view('vendorsdata', compact('userMeta'));
    }


    public function vendordetail(Request $request, $id)
    {
        $vendor_id = Crypt::decrypt($id);
        $userMeta = User::with('vendorservicedata.vendorserviveUserwithvendor', 'vendorwithserviceoffer.vendorserviceofferdata', 'vendorwithemployee', 'vendorwithgallery')->where('id', $vendor_id)->first();
        return view('vendor-details-page', compact('userMeta'));
    }
    public function ChangeVendorStatus(Request $request, $id)
    {

        $customer_id = Crypt::decrypt($id);
        $userData = User::findOrFail($customer_id);
        $userData->status = $request->status;
        $userData->save();
        Alert::success('Congratulations!', 'User Status Updated Succesfully');
        return redirect()->back();
    }
    public function addvendor(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'license_no' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'website' => 'nullable|url',
            'phone' => 'required|string|max:20',
            'yelp_profile' => 'nullable|url',
        ]);
        $userdata = User::make();
        $userdata->name = $request->company_name;
        $userdata->email = $request->email;
        $defautpassword = Str::random(12);
        $userdata->password = Hash::make($defautpassword);
        $userdata->role = "vendor";
        $userdata->phone = $request->phone;
        $userdata->yelp_url = $request->yelp_profile ?? "";
        $userdata->website_url = $request->website ?? "";
        $userdata->licence_number = $request->license_no;
        $userdata->save();

        $link = URL::to('/');
        $url = $link . '/genrate_password?key=Xfqnx' . encrypt($userdata->id);
        $data['url'] = $url;
        $data['email'] = $request->email;
        $data['defautpassword'] = $defautpassword;
        $data['username'] = $request->company_name;
        $data['title'] = "Welcome to your new Aerie account with Blue Owl";
        $data['body'] = "Please check blow link to Genrate Password";
        $mail = Mail::send('Mail.Adminmail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });
        Alert::success('Congratulations!', 'Vendor  Addeded Succesfully');
        return redirect()->back();
    }
}
