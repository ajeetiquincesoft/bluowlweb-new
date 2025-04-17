<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customer_count=User::where('role',"customer")->count();
        $vendor_count=User::where('role',"vendor")->count();
        return view('home',compact('customer_count','vendor_count'));
    }
    public function setting()
    {
        $setting=Setting::where("user_id",Auth::id())->first();
        return view('account-setting-view',compact('setting'));
    }
}
