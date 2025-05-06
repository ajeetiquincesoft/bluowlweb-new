<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orderData=Order::with('OrderitemDartaWithOrder')->paginate(getenv('PAGE_LIMIT'));
       return view('viewAllOrderData',compact('orderData'));
    }
}
