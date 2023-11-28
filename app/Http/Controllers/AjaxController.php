<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;



class AjaxController extends Controller
{

    //**** developer: Rahul Katre  *
    //**** date: 24/11/23  */ 
    //**** function: fetch client details by id for any ajax request  */ 
    public function fetchClient()
    {
        $client = Client::find(request('id'));
        return response()->json(['client' => $client]);
    }
    //**** developer: Rahul Katre  *
    //**** date: 24/11/23  */ 
    //**** function: search user using fullname  */ 
    public function searchUser()
    {
        if (request()->has('search')) {
            $key = request("search");
            $members = User::where("fullname", "LIKE", "%$key%")->where("admin", "!=", 1)->get();
            foreach ($members as  $value) {

                $value->projects_count = $value->projects ? $value->projects->count() . " projects" : "0 projects";
            }
            return $members;
        } else {
            return [];
        }
    }
}
