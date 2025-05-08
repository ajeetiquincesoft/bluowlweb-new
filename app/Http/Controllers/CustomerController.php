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
    //   $send= sendnotification('2',"demo","demo001");
    //   $send= sendnotification('3',"demo","demo001");
        $customers = User::with('OrderWithUser')->where('role', "customer")->paginate(getenv('PAGE_LIMIT'));
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
