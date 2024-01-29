<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Country;
use App\Models\Designation;
use App\Models\Service;
use App\Models\ChatCount;
use App\Models\MaritalStatus;

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
        $phonecode = $country ? $country->phonecode : "+1";
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
