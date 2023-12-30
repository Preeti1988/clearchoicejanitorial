<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\User;

trait NotificationTrait
{
    public function sendNotification($data)
    {

        $user = User::find($data['user_id']);
        $notification = new  Notification();
        $notification->title = $data["title"];
        $notification->details = $data["details"];

        $notification->user_id = $data["user_id"];

        $notification->save();

        if (is_null($user->device_key)) {
            $user->device_key = $data["device_key"];
            $user->save();
        }

        $this->sendWebNotification($notification, []);
    }
    public function sendWebNotification($notification, $data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::where("id", $notification->user_id)->whereNotNull('device_key')->pluck('device_key')->all();

        $serverKey = config("app.server_key");

        $data = [
            "registration_ids" => $FcmToken,
            'data' =>  $data,
            "notification" => [
                "title" => $notification->title,
                "body" => $notification->message,
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);

        // FCM response
        // dd($result);
    }
}
