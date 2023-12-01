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
use App\Models\Client;
use App\Models\ServiceTimesheet;
use App\Models\ServiceReview;
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
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
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
    /*Last Seven Date for mobile home screen */
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
    
    /*Last Seven Date for mobile home screen */
    public function DateOfWeek()
    {
        $user = Auth::user();
        $m= date("m");
        $de= date("d");
        $y= date("Y");
        $response = array();
        for($i=0; $i<=7; $i++){
            $date_array = date('d-m-y:D',mktime(0,0,0,$m,($de-$i),$y));
            $response[] = $date_array;
        }
        return response()->json(["status" => true, "message" => "Date Listing.", "data" => $response]);
    }
    
    public function home(Request $request)
    {
        $user = Auth::user();
        if (isset($request->date)) {
            
            //$servise_list = ServiceMember::where('member_id',$user->userid)->whereDate('created_at', '=', $request->date)->get();
        } else {
            
            $servise_list = ServiceMember::where('member_id',$user->userid)->orderBy('id','DESC')->get();
        }
        
        $response = array();
        foreach ($servise_list as $key => $value) {
            $service = Service::where('id',$value->service_id)->first();
            $temp['service_name'] = isset($service->name) ? $service->name : '';
            $temp['service_id'] = isset($service->id) ? $service->id : '';
            
            $timesheet = ServiceTimesheet::where('assign_member_id',$user->userid)->where('service_id',$service->id)->whereDate('date',date('Y-m-d'))->first();
            if(!empty($timesheet))
            {
                if ($timesheet->status == 1) {
                    $status = 'Scheduled';
                }elseif($timesheet->status == 2){
                    $status = 'On the way';
                }elseif($timesheet->status == 3){
                    $status = 'Start';
                } elseif($timesheet->status == 4){
                    $status = 'Finish';
                }else {
                    $status = 'Scheduled';
                } 
            }else{
                $status = 'Scheduled';
            }
            
            $temp['status'] = $status;
            $temp['status_id'] = isset($timesheet->status) ? $timesheet->status:'';
            $temp['on_the_way_time'] = isset($timesheet->on_the_way_time) ? $timesheet->on_the_way_time : '';
            $temp['start_time'] = isset($timesheet->start_time) ? $timesheet->start_time : '';
            $temp['finish_time'] = isset($timesheet->end_time) ? $timesheet->end_time : '';
            $temp['service_image'] = asset('public/assets/admin-images/hbgimg.png');
            $temp['client_id'] = isset($service->assigned_client_id) ? $service->assigned_client_id : '';
            $client = Client::where('id',$service->assigned_client_id)->first();
            $temp['clientname'] = isset($client->name) ? $client->name : '';
            $temp['clientemail'] = isset($client->email_address) ? $client->email_address: '';
            $temp['clientphone'] = isset($client->mobile_number) ? $client->mobile_number: '+(987)4563210';
            $temp['address'] = isset($client->address) ? $client->address : '';
            $temp['lat'] = '28.23654';
            $temp['long'] = '78.9654123';
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "Home page", "data" => $response]);
    }
    
    public function services(Request $request)
    {
        $user = Auth::user();
        if (isset($request->date)) {
            
            $servise_list = ServiceMember::where('member_id',$user->userid)->whereDate('created_at', '=', $request->date)->where('status',1)->get();
        } else {
            
            $servise_list = ServiceMember::where('member_id',$user->userid)->orderBy('id','DESC')->where('status',1)->get();
        }
        
        $response = array();
        foreach ($servise_list as $key => $value) {
            $service = Service::where('id',$value->service_id)->first();
            $temp['service_name'] = isset($service->name) ? $service->name : '';
            $temp['service_id'] = isset($service->id) ? $service->id : '';
            
            $timesheet = ServiceTimesheet::where('assign_member_id',$user->userid)->where('service_id',$service->id)->whereDate('date',date('Y-m-d'))->first();
            if(!empty($timesheet))
            {
                if ($timesheet->status == 1) {
                    $status = 'Scheduled';
                }elseif($timesheet->status == 2){
                    $status = 'On the way';
                }elseif($timesheet->status == 3){
                    $status = 'Start';
                } elseif($timesheet->status == 4){
                    $status = 'Finish';
                }else {
                    $status = 'Scheduled';
                } 
            }else{
                $status = 'Scheduled';
            }
            
            $temp['status'] = $status;
            $temp['status_id'] = isset($timesheet->status) ? $timesheet->status:'';
            $temp['on_the_way_time'] = isset($timesheet->on_the_way_time) ? $timesheet->on_the_way_time : '';
            $temp['start_time'] = isset($timesheet->start_time) ? $timesheet->start_time : '';
            $temp['finish_time'] = isset($timesheet->end_time) ? $timesheet->end_time : '';
            $temp['service_image'] = asset('public/assets/admin-images/hbgimg.png');
            $temp['client_id'] = isset($service->assigned_client_id) ? $service->assigned_client_id : '';
            $client = Client::where('id',$service->assigned_client_id)->first();
            $temp['clientname'] = isset($client->name) ? $client->name : '';
            $temp['clientemail'] = isset($client->email_address) ? $client->email_address: '';
            $temp['clientphone'] = isset($client->mobile_number) ? $client->mobile_number: '+(987)4563210';
            $temp['address'] = isset($client->address) ? $client->address : '';
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
        $value = ServiceMember::where('member_id',$user->userid)->where('service_id',$request->service_id)->first();
        $service = Service::where('id',$request->service_id)->first();
        $temp['service_name'] = isset($service->name) ? $service->name : '';
        $temp['service_id'] = isset($service->id) ? $service->id : '';
        $temp['service_type'] = $service->service_type;
        $temp['service_frequency'] = $service->frequency;
        
        $timesheet = ServiceTimesheet::where('assign_member_id',$user->userid)->where('service_id',$request->service_id)->whereDate('date',date('Y-m-d'))->first();
        if(!empty($timesheet))
        {
            if ($timesheet->status == 1) {
                $status = 'Scheduled';
            }elseif($timesheet->status == 2){
                $status = 'On the way';
            }elseif($timesheet->status == 3){
                $status = 'Start';
            } elseif($timesheet->status == 4){
                $status = 'Finish';
            }else {
                $status = 'Scheduled';
            } 
        }else{
            $status = 'Scheduled';
        }
        
        $temp['status'] = $status;
        $temp['status_id'] = isset($timesheet->status) ? $timesheet->status:'';
        $temp['on_the_way_time'] = isset($timesheet->on_the_way_time) ? $timesheet->on_the_way_time : '';
        $temp['start_time'] = isset($timesheet->start_time) ? $timesheet->start_time : '';
        $temp['finish_time'] = isset($timesheet->end_time) ? $timesheet->end_time : '';
        $temp['service_image'] = asset('public/assets/admin-images/hbgimg.png');
        $temp['client_id'] = isset($service->assigned_client_id) ? $service->assigned_client_id : '';
        $client = Client::where('id',$service->assigned_client_id)->first();
        $temp['clientname'] = isset($client->name) ? $client->name : '';
        $temp['clientemail'] = isset($client->email_address) ? $client->email_address: '';
        $temp['clientphone'] = isset($client->mobile_number) ? $client->mobile_number: '+(999)999999';
        $temp['address'] = isset($client->address) ? $client->address : '';
        $temp['lat'] = '28.23654';
        $temp['long'] = '78.9654123';
        $inscope = json_decode($service->inscopes);
        $outscope = json_decode($service->outscopes);
        $service_items = json_decode($service->service_items);
        $temp['inscope'] = $inscope;
        $temp['OutScope'] = $outscope;
        $temp['ServicesItems'] = $service_items;
        $ServiceMember = ServiceMember::where('service_id',$request->service_id)->get();
        $response = array();
        foreach ($ServiceMember as $key => $value) {
            $user = User::where('service_id',$value->assign_member_id)->get();
            $temps['userphone'] = isset($user->phonenumber) ? $user->phonenumber: '+(987)4563210';
            $temps['fullname'] = isset($user->fullname) ? $user->fullname: '';
            $temps['userid'] = isset($user->userid) ? $user->userid: '';
            $response[] = $temps;
        }
        $temp['scheduled_list'] = $response;
        $temp['total'] = 200;
        
        
        return response()->json(["status" => true, "message" => "Service Details", "data" => $temp]);
    }
    
    public function UpdateStatus(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'status'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $status = $request->status; /*2:On the way, 3:Start timimg, 4: Finish*/
        if($status == 2){
            $key = 'on_the_way';
            $value = date('H:i:s');
            $date = date('Y-m-d');
        }elseif($status == 3){
            $key = 'start_time';
            $value = date('H:i:s');
            $date = date('Y-m-d');
        }elseif($status == 4){
            $key = 'end_time';
            $value = date('H:i:s');
            $date = date('Y-m-d');
        }
        $timesheet = ServiceTimesheet::where('assign_member_id',$user->userid)->where('service_id',$request->service_id)
        ->whereDate('date',date('Y-m-d'))->first();
        if(!empty($timesheet))
        {
            ServiceTimesheet::where('assign_member_id',$user->userid)->where('service_id',$request->service_id)->whereDate('date',date('Y-m-d'))->update(['status'=>$request->status,$key=>$value]);
        }else{
            $sheet = new ServiceTimesheet;
            $sheet->assign_member_id = $user->userid;
            $sheet->service_id = $request->service_id;
            $sheet->date = date('Y-m-d');
            $sheet->on_the_way_time = date('H:i:s');
            $sheet->start_time = '';
            $sheet->end_time = '';
            $sheet->status = 2;
            $sheet->save();
        }
        
        //ServiceMember::where('member_id',$user->userid)->where('service_id',$request->service_id)->update(['status'=>$request->status,$key=>$value]);
        return response()->json(["status" => true, "message" => "Status updated."]);
    }
    
    public function submit_review(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'member_id' => 'required',
            'service' => 'required',
            'equipment' => 'required',
            'burnisher' => 'required',
            'supplies' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        
        $ServiceReview = new ServiceReview;
        $ServiceReview->service = $request->service;
        $ServiceReview->service_comment = $request->service_comment;
        $ServiceReview->equipment = $request->equipment;
        $ServiceReview->equipment_comment = $request->equipment_comment;
        $ServiceReview->burnisher = $request->burnisher;
        $ServiceReview->burnisher_comment = $request->burnisher_comment;
        $ServiceReview->supplies = $request->supplies;
        $ServiceReview->supplies_comment = $request->supplies_comment;
        $ServiceReview->service_id = $request->service_id;
        $ServiceReview->member_id = $request->member_id;
        $ServiceReview->save();
        
        return response()->json(["status" => true, "message" => "Reviews Saved"]);
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