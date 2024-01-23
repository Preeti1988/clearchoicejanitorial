<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\State;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Constraint\Count;

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
            $key = trim(request("search"));
            $members = User::where("fullname", "LIKE", "%$key%")->where("userid", "!=", 1)->get();
            foreach ($members as  $value) {

                $value->projects_count = $value->projects ? $value->projects->count() . " projects" : "0 projects";
            }
            return $members;
        } else {
            return [];
        }
    }
    public function getState()
    {
        if (request()->has('id')) {
            $key = trim(request("id"));
            $members = State::where("country_id", $key)->get();
            return $members;
        } else {
            
            return [];
        }
    }
    public function getCountry()
    {
        $country_id=0;
        $state_id=0;
        $city_id=0;
        $cities=[];
        $states=[];

        if (request()->has('country')&&request()->has('state')&&request()->has('city')) {

            $key = trim(request("country"));
            $country = Country::where("name", $key)->first();
            $country_id= $country? $country->id:0;
            
         if($country_id){
            $key = trim(request("state"));
            $state = State::where("name", $key)->where("country_id",$country_id)->first();
            $state_id= $state? $state->id:0; 
            
            $states = State::where("country_id",$country_id)->get();
         }
           
         if($state_id){
            $key = trim(request("city"));
            $city = City::where("name", $key)->where("state_id",$state_id)->first();
            $city_id= $city? $city->id:0;

            $cities = City::where("state_id",$state_id)->get();
         }

          

            
            return ['country_id'=>$country_id,'state_id'=>$state_id,'city_id'=>$city_id,"cities"=>$cities,"states"=>$states];
        } else {
            return ['country_id'=>$country_id,'state_id'=>$state_id,'city_id'=>$city_id,];
        }
    }
    public function getCity()
    {
        if (request()->has('id')) {
            $key = trim(request("id"));
            $members = City::where("state_id", $key)->get();
            return $members;
        } else {
            return [];
        }
    }

    public function uploadImage(Request $request)
    {
        // dd($request->all());
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $image = uniqid() . "." . $file->getClientOriginalExtension();
            $file->move('public/upload/services/', $image);
            return $image;
        }
    }

    public function deleteImage(Request $request)
    {
        // dd($request->all());
        if (File::exists("public/upload/service/$request->filename")) {
            // File::delete("uploads/products/$request->filename");
            return $request->filename;
        }
    }

   
}