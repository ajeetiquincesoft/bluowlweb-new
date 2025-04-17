<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function updateNotification(Request $request)
    {
        $userId = auth()->id(); // or use your own logic for the user

        $notificationStatus = $request->has('notification_status') ? 1 : 0;

        DB::table('settings')->updateOrInsert(
            ['user_id' => $userId], // unique key
            ['notification' => $notificationStatus]
        );

        return redirect()->back()->with('success', 'Notification setting updated.');
    }
}
