<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\InScope;
use App\Models\OutScope;
use App\Models\ServicesValue;
use App\Models\ServiceMember;
use App\Models\Service;
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
                $success['city'] = ($user->city) ?? '';
                $success['state_id'] = ($user->state_id) ?? '';
                $success['country_id'] = ($user->country_id) ?? '';
                $success['zipcode'] = ($user->zipcode) ?? '';
                $success['resume'] = ($user->resume) ?? '';
                $success['applying_letter'] = ($user->applying_letter) ?? '';
                $success['status'] = $user->status;
                $success['created_date'] = $user->created_date;
                if ($user->resume) {
                    $success['resume'] = asset('public/assets/admin-images/').$user->resume;
                } else {
                    $success['resume'] = '';
                }
                
                
                $success['resume_file_name'] = $user->resume_file_name;
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
        $success['city'] = ($user->city) ?? '';
        $success['state_id'] = ($user->state_id) ?? '';
        $success['country_id'] = ($user->country_id) ?? '';
        $success['zipcode'] = ($user->zipcode) ?? '';
        $success['resume'] = ($user->resume) ?? '';
        $success['applying_letter'] = ($user->applying_letter) ?? '';
        $success['status'] = $user->status;
        $success['created_date'] = $user->created_date;
        if ($request->file('resume')) {
            $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $request->resume->extension();  
            $request->resume->move(public_path('upload/resume'), $imageName);
            $resume = $imageName;
            $resume_file_name = $request->resume->getClientOriginalName();
            $success['resume'] = asset('public/assets/admin-images/').$imageName;
            $success['resume_file_name'] = $resume_file_name;
            User::where('userid',$user->userid)->update(['resume'=>$imageName,'resume_file_name'=>$resume_file_name]);
        }else{
            $success['resume'] = '';
            $success['resume_file_name'] = '';
        }
        
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
        $token = $user->createToken('clear-choicejanitorial')->plainTextToken;
        $success['token'] = $token;
        $success['userid'] = $user->userid;
        $success['emp_id'] = $user->userid;
        $success['fullname'] = $user->fullname;
        $success['emailid'] = $user->email;
        $success['phonenumber'] = ($user->phonenumber) ?? '';
        $success['service_count'] = 01;
        $success['service_log'] = 03;
        $success['status'] = $user->status;
        $success['created_date'] = $user->created_date;
        return response()->json(["status" => true, "message" => "Profile.", "data" => $success]);
    }
    
    public function home()
    {
        $user = Auth::user();
        $servise_list = ServiceMember::where('member_id',$user->id)->where('status',1)->get();
        $response = array();
        foreach ($servise_list as $key => $value) {
            $service = Service::where('id',$servise_list->service_id)->first();
            $temp['service_name'] = isset($service->name) ?? '';
            $temp['service_id'] = isset($service->id) ?? '';
            // $temp['status'] = (($value->status == 1) ? "Scheduled" :($value->status == 2) ? "On the way" : ($value->status == 3) ? "Start": ($value->status == 4) ? "finish" : "Scheduled");
            $temp['status'] = ($value->status == 1) ?? "Scheduled";
            $temp['status_id'] = $value->status;
            $temp['service_image'] = asset('public/assets/admin-images/hbgimg.png');
            $temp['client_id'] = isset($service->billed_to) ?? '';
            $client = Client::where('id',$service->billed_to)->first();
            $temp['clientname'] = isset($client->name) ?? '';
            $temp['clientemail'] = isset($client->email_address) ?? '';
            $temp['clientphone'] = isset($client->mobile_number) ?? '+(987)4563210';
            $temp['address'] = isset($client->address) ?? '';
            $temp['lat'] = '28.23654';
            $temp['long'] = '78.9654123';
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "Home page", "data" => $response]);
    }
    
    public function services()
    {
        $user = Auth::user();
        $servise_list = ServiceMember::where('member_id',$user->id)->where('status',1)->get();
        $response = array();
        foreach ($servise_list as $key => $value) {
            $service = Service::where('id',$servise_list->service_id)->first();
            $temp['service_name'] = isset($service->name) ?? '';
            $temp['service_id'] = isset($service->id) ?? '';
            // $temp['status'] = (($value->status == 1) ? "Scheduled" :($value->status == 2) ? "On the way" : ($value->status == 3) ? "Start": ($value->status == 4) ? "finish" : "Scheduled");
            $temp['status'] = (($value->status == 1) ?? "Scheduled");
            $temp['status_id'] = $value->status;
            $temp['service_image'] = asset('public/assets/admin-images/profile-img.jpg');
            $temp['client_id'] = isset($service->billed_to) ?? '';
            $client = Client::where('id',$service->billed_to)->first();
            $temp['clientname'] = isset($client->name) ?? '';
            $temp['clientemail'] = isset($client->email_address) ?? '';
            $temp['clientphone'] = isset($client->mobile_number) ?? '+(987)4563210';
            $temp['address'] = isset($client->address) ?? '';
            $temp['lat'] = '28.23654';
            $temp['long'] = '78.9654123';
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "Services Listing", "data" => $response]);
    }
    
    public function service_details(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $servise_list = ServiceMember::where('member_id',$user->id)->where('service_id',$request->service_id)->where('status',1)->first();
        $service = Service::where('id',$request->service_id)->first();
        $temp['service_name'] = isset($service->name) ?? '';
        $temp['service_id'] = isset($service->id) ?? '';
        // $temp['status'] = (($value->status == 1) ?? "Scheduled" :($value->status == 2) ?? "On the way" : ($value->status == 3) ?? "Start": ($value->status == 4) ? "finish" : "Scheduled");
        $temp['status'] = ($value->status == 1) ?? "Scheduled";
        $temp['status_id'] = $value->status;
        $temp['service_image'] = asset('public/assets/admin-images/profile-img.jpg');
        $temp['client_id'] = isset($service->billed_to) ?? '';
        $client = Client::where('id',$service->billed_to)->first();
        $temp['clientname'] = isset($client->name) ?? '';
        $temp['clientemail'] = isset($client->email_address) ?? '';
        $temp['clientphone'] = isset($client->mobile_number) ?? '+(987)4563210';
        $temp['address'] = isset($client->address) ?? '';
        $temp['lat'] = '28.23654';
        $temp['long'] = '78.9654123';
        $inscope = InScope::orderBy('id','DESC')->get();
        $outscope = OutScope::orderBy('id','DESC')->get();
        $services_values = ServicesValue::orderBy('id','DESC')->get();
        $temp['inscope'] = $inscope;
        $temp['OutScope'] = $outscope;
        $temp['ServicesItems'] = $services_values;
        $temp['scheduled_list'] =[];
        $temp['total'] = 200;
        
        
        return response()->json(["status" => true, "message" => "Service Details", "data" => $temp]);
    }
    
    public function UpdateStatus(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        ServiceMember::where('member_id',$user->id)->where('service_id',$request->service_id)->update(['status'=>$request->status]);
        return response()->json(["status" => true, "message" => "Status updated.", "data" => $success]);
    }
    
    public function save_rating(Request $request)
    {
        $user = Auth::user();
        $token = $user->createToken('clear-choicejanitorial')->plainTextToken;
        $success['service_name'] = 'Schedulad';
        $success['Status'] = 'Schedulad';
        $success['current_status'] = 1;/* 1:On the way, 2:start , 3:finish*/
        $success['service_type'] = 1;
        $success['service_frequency'] = asset('public/assets/admin-images/profile-img.jpg');
        $success['service_image'] = asset('public/assets/admin-images/profile-img.jpg');
        $success['clientname'] = 'Neeti Alax';
        $success['clientemail'] = 'neetialax@gmail.com';
        $success['clientphone'] = '+(987)4563210';
        $success['address'] = 'T blog way, Jhartos, CA';
        $success['lat'] = '28.23654';
        $success['long'] = '78.9654123';
        $success['client_id'] = 1;
        $inscope = InScope::orderBy('id','DESC')->get();
        $outscope = OutScope::orderBy('id','DESC')->get();
        $services_values = ServicesValue::orderBy('id','DESC')->get();
        $success['inscope'] = $inscope;
        $success['OutScope'] = $outscope;
        $success['ServicesItems'] = $services_values;
        $success['scheduled_list'] =[];
        $success['total'] = 200;
        
        
        return response()->json(["status" => true, "message" => "Service Details", "data" => $success]);
    }
    

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'fullname' => 'required',
            'phonenumber' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        User::where('userid',$user->userid)->update(['fullname'=>$request->fullname,'email'=>$request->email,'phonenumber'=>$request->phonenumber]);
        $token = $user->createToken('clear-choicejanitorial')->plainTextToken;
        $success['token'] = $token;
        $success['userid'] = $user->userid;
        $success['emp_id'] = $user->userid;
        $success['fullname'] = $user->fullname;
        $success['emailid'] = $user->email;
        $success['phonenumber'] = ($user->phonenumber) ?? '';
        $success['service_count'] = 01;
        $success['service_log'] = 03;
        $success['status'] = $user->status;
        $success['created_date'] = $user->created_date;
        $success['DOB'] = $user->DOB;
        $success['address'] = $user->address;
        $success['applying_letter'] = $user->applying_letter ?? '';
        $success['city'] = $user->city;
        $success['country_id'] = $user->country_id;
        $success['dependents'] = $user->dependents;
        $success['designation_id'] = $user->designation_id;
        $success['resume'] = $user->resume;
        $success['state_id'] = $user->state_id;
        $success['zipcode'] = $user->zipcode;
        if ($user->resume) {
            $success['resume'] = asset('public/assets/admin-images/').$user->resume;
        } else {
            $success['resume'] = '';
        }
        $success['resume_file_name'] = $user->resume_file_name;
        return response()->json(["status" => true, "message" => "Profile updated", "data" => $success]);
    }

    public function country()
    {
        $country = Country::get();
        $response = array();
        foreach ($country as $key => $value) {
            $temp['value'] = $value->id;
            $temp['label'] = $value->name;
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "Country list.", "data" => $response]);
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
        $response = array();
        foreach ($state as $key => $value) {
            $temp['value'] = $value->id;
            $temp['label'] = $value->name;
            $temp['country_id'] = $value->country_id;
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "State list.", "data" => $response]);
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
        $response = array();
        foreach ($city as $key => $value) {
            $temp['value'] = $value->id;
            $temp['label'] = $value->name;
            $temp['state_id'] = $value->state_id;
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "State list.", "data" => $response]);
    }
}