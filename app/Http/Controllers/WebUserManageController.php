<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebUserManageController extends Controller
{
  public function index()
  {
    return view('UserPages.register');
  }
}
