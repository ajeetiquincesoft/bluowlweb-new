<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

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
        $userMeta = User::with('vendorservicedata.vendorserviveUserwithvendor', 'vendorwithserviceoffer.vendorserviceofferdata','vendorwithemployee','vendorwithgallery')->where('id',$vendor_id)->first();
        return view('vendor-details-page',compact('userMeta'));
    }
    public function ChangeVendorStatus(Request $request,$id)
    {

        $customer_id = Crypt::decrypt($id);
        $userData = User::findOrFail($customer_id);
        $userData->status = $request->status;
        $userData->save();
        Alert::success('Congratulations!', 'User Status Updated Succesfully');
        return redirect()->back();
    }

}
