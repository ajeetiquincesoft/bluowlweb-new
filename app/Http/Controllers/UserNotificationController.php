<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->ids;
        $notification = Notification::where('id', '=', $id)->first();
        $notification->status = '1';
        $notification->save();
        return response()->json(array("statusCode" => 201));
    }
    public function ReadAllNotification()
    {
        Notification::where('user_id', Auth::user()->id)->update(['status' => '1']);
        return response()->json(array("statusCode" => 201));
    }

}
