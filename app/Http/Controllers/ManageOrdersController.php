<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ManageOrdersController extends Controller
{
    public function ShowOrderdatadetails($id)
    {
        $OrderId = Crypt::decrypt($id);
        $Order   = Order::with('OrderitemDartaWithOrder')->where('id', $OrderId)->first();
        return view('ViewAllOrderDetails', compact('Order'));
    }
}
