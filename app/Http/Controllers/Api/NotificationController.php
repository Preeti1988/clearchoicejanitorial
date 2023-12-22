<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where("user_id", $request->user()->id)->get();

        return response()->json(["status" => true, "message" => "notifications fetched successfully", "data" => $notifications]);
    }
}
