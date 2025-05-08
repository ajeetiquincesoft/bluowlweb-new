<?php

use App\Models\Notification as ModelsNotification;
use App\Models\User;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Carbon\Carbon;

if (!function_exists('upload_image')) {
    function upload_image($data)
    {

        $filename = time() . rand() . "PI." . $data->getClientOriginalExtension();
        $data->storeAs('public/uploads', $filename);
        return  $filename;
    }
}
if (!function_exists('sendnotification')) {
    function sendnotification($user_id,$title,$body)
    {
        $notification=ModelsNotification::make();
        $notification->user_id=$user_id??"2";
        $notification->title=$title??"Got Gas";
        $notification->description=$body ??"Got Gas Notification";
        $notification->save();

        $user = User::find($user_id);
        if (!$user || !$user->fcm_token) {
            return response()->json(['error' => 'User or token not found'], 404);
        }
        $deviceToken = $user->fcm_token;
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials_file'));
        $messaging = $factory->createMessaging();
        $user = User::find($user_id);
        $message = CloudMessage::withTarget('token', $user->fcm_token)
        ->withNotification(Notification::create($title, $body));
        $messaging->send($message);
        return response()->json(['message' => 'Notification sent successfully']);

    }
}
function formatDate($date)
{
    $carbonDate = Carbon::parse($date);
    return $carbonDate->diffForHumans();
}
?>
