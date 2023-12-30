<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where("user_id", $request->user()->id)->get();

        return response()->json(["status" => true, "message" => "notifications fetched successfully", "data" => $notifications]);
    }
    public function read(Request $request)
    {
        try {
            if ($request->has('id')) {
                $notification =   Notification::find($request->id);
                $notification->read = 1;

                $notification->save();
                return response()->json(['message' => 'Notification updated successfully.', "success" => true,  'status' => 200], 200);
            } else {
                DB::table('notifications')->where("read", 0)->where("user_id", $request->user()->id)->update(array("read" => 1));
            }

            return response()->json(['message' => 'All Notifications updated successfully.', "success" => true,  'status' => 200], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), "success" => false, 'status' => 200], 200);
        }
    }
}
