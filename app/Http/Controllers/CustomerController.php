<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', "customer")->get();
        return view("allCustomerView", compact('customers'));
    }
    public function ChangeCustomerStatus(Request $request,$id)
    {
        $customer_id = Crypt::decrypt($id);
        $userData = User::findOrFail($customer_id);
        $userData->status = $request->status === 'Active' ? 1 : 0;
        $userData->save();
        Alert::success('Congratulations!', 'User Status Updated Succesfully');
        return redirect()->back();
    }
}
