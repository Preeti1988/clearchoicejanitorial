<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            }
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                $user = Auth::user();
                $token = $user->createToken('clear-choicejanitorial')->plainTextToken;
                $success['token'] = $token;
                $success['userId'] = $user->userid;
                $success['fullname'] = $user->fullname;
                $success['emailid'] = $user->email;
                $success['phonenumber'] = ($user->phonenumber) ?? '';
                $success['designation_id'] = ($user->designation_id) ?? '';
                $success['DOB'] = ($user->DOB) ?? '';
                $success['marital_status'] = ($user->marital_status) ?? '';
                $success['dependents'] = ($user->dependents) ?? '';
                $success['address'] = ($user->address) ?? '';
                $success['city'] = ($user->city) ??'';
                $success['state_id'] = ($user->state_id) ?? '';
                $success['country_id'] = ($user->country_id) ?? '';
                $success['zipcode'] = ($user->zipcode) ??'';
                $success['resume'] = ($user->resume) ?? '';
                $success['applying_letter'] = ($user->applying_letter) ?? '';
                $success['status'] = $user->status;
                $success['created_date'] = $user->created_date;
                return response()->json(["status" => true, "message" => "Logged in successfully.", "data" => $success]);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } catch (\Exception $e) {
            return errorMsg("Exception -> " . $e->getMessage());
        }
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:user',
            'phonenumber' => 'required|unique:user',
            'designation_id' => 'required',
            'DOB' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',
            'dependents' => 'required',/* No of dependents people*/
            'profile_image' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $token = $user->createToken('clear-choicejanitorial')->plainTextToken;
        $success['token'] = $token;
        $success['userId'] = $user->userid;
        $success['fullname'] = $user->fullname;
        $success['email'] = $user->email;
        $success['phonenumber'] = ($user->phonenumber) ?? '';
        $success['designation_id'] = ($user->designation_id) ?? '';
        $success['DOB'] = ($user->DOB) ?? '';
        $success['marital_status'] = ($user->marital_status) ?? '';
        $success['dependents'] = ($user->dependents) ?? '';
        $success['address'] = ($user->address) ?? '';
        $success['city'] = ($user->city) ??'';
        $success['state_id'] = ($user->state_id) ?? '';
        $success['country_id'] = ($user->country_id) ?? '';
        $success['zipcode'] = ($user->zipcode) ??'';
        $success['resume'] = ($user->resume) ?? '';
        $success['applying_letter'] = ($user->applying_letter) ?? '';
        $success['status'] = $user->status;
        $success['created_date'] = $user->created_date;
        return response()->json(["status" => true, "message" => "Registered successfully.", "data" => $success]);
        //return response()->json(['success' => $success], $this->successStatus);
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function userDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function country()
    {
        $country = Country::get();
        return response()->json(["status" => true, "message" => "Country list.", "data" => $country]);
    }

    public function state(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $state = State::where('country_id',$request->country_id)->get();
        return response()->json(["status" => true, "message" => "State list.", "data" => $state]);
    }

    public function city(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $city = City::where('state_id',$request->state_id)->get();
        return response()->json(["status" => true, "message" => "State list.", "data" => $city]);
    }
}