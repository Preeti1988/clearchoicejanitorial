<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function fetchClient()
    {
        $client = Client::find(request('id'));
        return response()->json(['client' => $client]);
    }
    public function searchUser()
    {
        if (request()->has('search')) {
            $key = request("search");
            $members = User::where("fullname", "LIKE", "%$key%")->where("admin", "!=", 1)->get();
            foreach ($members as  $value) {

                $value->projects_count = $value->projects->count() . " projects";
            }
            return $members;
        } else {
            return [];
        }
    }
}
