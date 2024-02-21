<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Country;
use App\Models\Designation;
use App\Models\Service;
use App\Models\ChatCount;
use App\Models\MaritalStatus;
use App\Models\Notification;

if (!function_exists('successMsg')) {
    function successMsg($msg, $data = [])
    {
        return response()->json(['status' => true, 'message' => $msg, 'data' => $data]);
    }
}
// app/helpers.php

if (!function_exists('custom_asset')) {
    function custom_asset($path, $secure = null)
    {
        // if (request()->isSecure()) {

        //     $scheme = request()->isSecure() ? 'https' : null;

        //     if (is_null($secure)) {
        //         $secure = request()->isSecure();
        //     }

        //     return app('url')->assetFrom($secure, $path, $scheme);
        // } else {
        return  asset($path);
        // }
    }
}

if (!function_exists('errorMsg')) {
    function errorMsg($msg, $data = [])
    {
        return response()->json(['status' => false, 'message' => $msg, 'data' => $data]);
    }
}

if (!function_exists('CountryCode')) {
    function CountryCode($id)
    {
        $country = Country::where('id', $id)->first();
        $phonecode = $country ? $country->phonecode : "1";
        return $phonecode;
    }
}

if (!function_exists('CountMSG')) {
    function CountMSG($id)
    {
        $chats = ChatCount::where('sender_id', $id)->sum('read_status');

        return $chats;
    }
}
if (!function_exists('TotalCountMSG')) {
    function TotalCountMSG()
    {
        $chats = ChatCount::where('sender_id', '!=', 1)->sum('read_status');

        return $chats;
    }
}

if (!function_exists('ServiceName')) {
    function ServiceName($id)
    {
        $Service = Service::where('id', $id)->first();
        $name = $Service->name;
        return $name;
    }
}

if (!function_exists('encryptDecrypt')) {
    function encryptDecrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Roadmann_Secret_Key@2022';
        $secret_iv = 'Roadmann_Secret_IV@2022';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

if (!function_exists('TotalYear')) {
    function TotalYear($Year)
    {
        $dob = $Year;
        $year = (date('Y') - date('Y', strtotime($dob)));
        return $year;
    }
}

if (!function_exists('Designation')) {
    function Designation($id)
    {
        $Designation = Designation::where('id', $id)->first();
        if (!empty($Designation)) {
            return $Designation->name;
        } else {
            return '';
        }
    }
}

if (!function_exists('MaritalStatus')) {
    function MaritalStatus($id)
    {

        $MaritalStatus = MaritalStatus::where('id', $id)->first();
        if (!empty($Designation)) {
            return $MaritalStatus->name;
        } else {
            return '';
        }
    }
}
if (!function_exists('formatTime')) {
    function formatTime($totalSeconds)
    {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        $formattedTime = '';

        if ($hours > 0) {
            $formattedTime .= $hours . ' hours ';
        }

        if ($minutes > 0) {
            $formattedTime .= $minutes . ' minutes ';
        }

        if ($seconds > 0) {
            $formattedTime .= $seconds . ' seconds';
        }

        if ($totalSeconds == 0) {
            $formattedTime = "0 hours";
        }

        return trim($formattedTime);
    }
}
if (!function_exists('getNotification')) {
    function getNotification($unseen = false)
    {
        $notifications = [];
        $notifications = Notification::where("user_id", 1)->when($unseen, function ($query) use ($unseen) {
            $query->where("read", 0);
        })->orderBy("id", 'desc')->get();

        return $notifications;
    }
}
if (!function_exists('sendWebNotification')) {
    function sendWebNotification($notification, $data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::where("userid", $notification->user_id)->whereNotNull('device_key')->pluck('device_key')->all();

        $serverKey = config("app.server_key");

        $data = [
            "registration_ids" => $FcmToken,
            'data' =>  $data,
            "notification" => [
                "title" => $notification->title,
                "body" => $notification->details,
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
        $notification->sent = true;
        $notification->save();
        // FCM response
        // dd($result);
    }
}
