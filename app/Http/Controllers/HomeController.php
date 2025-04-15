<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('account-setting-view');
    }
}
