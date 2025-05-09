<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $totelService=Service::count();
        $orderData = Order::with('OrderitemDartaWithOrder')->latest()->take(7)->get();
        $vendorData=User::with('vendorservicedata','vendorwithserviceoffer')->where('role',"vendor")->latest()->take(10)->get();
        $serviceOrders  = DB::table('orders')
        ->join('vendor_services', 'orders.vendor_id', '=', 'vendor_services.user_id')
        ->join('services', 'vendor_services.service_id', '=', 'services.id')
        ->select('services.name as service_name', DB::raw('COUNT(orders.id) as total_orders'))
        ->groupBy('services.name')
        ->orderByDesc('total_orders')
        ->limit(5)
        ->get();
        return view('home',compact('totelService','customer_count','vendor_count','orderData','vendorData','serviceOrders'));
    }
    public function setting()
    {
        $setting=Setting::where("user_id",Auth::id())->first();
        return view('account-setting-view',compact('setting'));
    }
}
