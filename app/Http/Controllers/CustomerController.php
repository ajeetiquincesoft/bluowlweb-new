<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
   public function index()
   {
    $customers=User::where('role',"1")->get();
    return view("allCustomerView",compact('customers'));
   }
}
