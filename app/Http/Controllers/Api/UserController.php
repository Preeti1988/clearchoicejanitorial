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
use App\Models\Designation;
use App\Models\Review;
use App\Models\ServiceTimesheet;
use App\Models\ChatCount;
use App\Models\ServiceItemTimesheet;
use App\Models\ServiceRating;
use App\Models\TimesheetRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                'email' => 'required|email|exists:user,email',
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
                $success['designation'] = Designation::find($user->designation_id) ? Designation::find($user->designation_id)->name : '';
                $success['DOB'] = ($user->DOB) ? date("m-d-Y", strtotime($user->DOB)) : '';
                $success['profile_image'] = ($user->profile_image) ? asset('public/upload/user-profile/' . $user->profile_image, 'https') : '';
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
                    $success['resume'] = asset('public/assets/admin-images/', 'https') . $user->resume;
                } else {
                    $success['resume'] = '';
                }


                $success['resume_file_name'] = $user->resume_file_name;
                if ($user->status == 0) {
                    return response()->json(["status" => false, "message" => "You are not approved by admin."]);
                }
                return response()->json(["status" => true, "message" => "Logged in successfully.", "data" => $success]);
            } else {
                return response()->json(["status" => false, "message" => "Wrong Password."], 200);
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
            'email' => 'required|email|unique:user|unique:clients,email_address',
            'phonenumber' => 'required|unique:user',
            'designation_id' => 'required',
            'DOB' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',
            'dependents' => 'required',/* No of dependents people*/
            // 'profile_image' => 'required',
            'address' => 'required',
            // 'country_id' => 'required',
            // 'state_id' => 'required',
            // 'city' => 'required',
            // 'zipcode' => 'required',
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
        $success = [];
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $image = uniqid() . "." . $file->getClientOriginalExtension();
            $file->move("public/upload/user-profile/", $image);
            $user->profile_image = $image;
            $user->save();
            $success['profile_image'] = asset('public/upload/user-profile', 'https') . "/" . $user->profile_image;
        }
        if ($request->hasFile('resume')) {
            $file = $request->file("resume");
            $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move("public/upload/resume/", $imageName);
            $user->resume = $imageName;
            $user->resume_file_name = asset('public/upload/resume/', 'https')  . "/" . $imageName;;
            $user->save();

            $success['resume'] = asset('public/upload/resume/', 'https') . "/" . $imageName;
            $success['resume_file_name'] = $imageName;
        } else {
            $success['resume'] = '';
            $success['resume_file_name'] = '';
        }

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
        $success['designation'] = Designation::find($user->designation_id) ? Designation::find($user->designation_id)->name : '';


        return response()->json(["status" => true, "message" => "Registered successfully.", "data" => $success]);
        //return response()->json(['success' => $success], $this->successStatus);
    }

    public function designation()
    {

        $designation = Designation::all();
        foreach ($designation as $item) {
            $item->value = $item->id;
            $item->label = $item->name;
            $item->makeHidden("id");
            $item->makeHidden("name");
            $item->makeHidden("created_date");
            $item->makeHidden("status");
        }
        return response()->json(["status" => true, "message" => "Designation.", "data" => $designation]);
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



        $assigned_services = ServiceMember::where("member_id", $user->userid)->groupBy("service_id")->pluck("service_id")->toArray();
        $completed_services = ServiceTimesheet::where("assign_member_id", $user->userid)->groupBy("service_id")->pluck("service_id")->toArray();
        $incomplete_services = [];
        $complete_services = [];

        foreach ($assigned_services as $id) {
            if (!in_array($id, $completed_services)) {
                $incomplete_services[] = $id;
            } else {
                $complete_services[] = $id;
            }
        }

        $timesheet = ServiceTimesheet::when(request()->filled("date"), function ($query) {
            return  $query->whereDate("date", Carbon::parse(request('date')));
        })->where("assign_member_id", auth()->user()->userid)->whereNotNull("end_time")->get();
        $timesheets = [];

        foreach ($timesheet as $item) {
            $service = Service::find($item->service_id);
            $service->address = $service->client ? $service->client->street : '';
            $item->service = $service;
        }
        $success['incomplete_service_count'] = Service::where("status", "completed")->whereIn("id", $incomplete_services)->count();
        $success['service_log'] = count($timesheet);
        $success['service_count'] = Service::where("status", "ongoing")->whereIn("id", $assigned_services)->count();

        $success['status'] = $user->status;
        $success['profile_image'] = $user->profile_image ? asset('public/upload/user-profile', 'https') . "/" . $user->profile_image : '';
        $success['designation_id'] = ($user->designation_id) ?? '';
        $success['DOB'] = ($user->DOB) ?? '';
        $success['marital_status'] = ($user->marital_status) ?? '';
        $success['dependents'] = ($user->dependents) ?? '';
        $success['address'] = ($user->address) ?? '';
        $success['city'] = ($user->city) ?? '';
        $success['gender'] = ($user->gender) ?? '';
        $success['state_id'] = ($user->state_id) ?? '';
        $success['country_id'] = ($user->country_id) ?? '';
        $success['zipcode'] = ($user->zipcode) ?? '';
        $success['resume'] = ($user->resume) ?? '';
        $success['applying_letter'] = ($user->applying_letter) ?? '';
        $success['status'] = $user->status;
        $success['created_date'] = $user->created_date;
        $success['designation'] = Designation::find($user->designation_id) ? Designation::find($user->designation_id)->name : '';

        if ($user->profile_image) {
            $success['profile_image'] = asset('public/upload/user-profile', 'https') . "/" . $user->profile_image;
        } else {
            $success['profile_image'] = '';
        }

        if ($user->resume) {
            $success['resume'] = asset('public/upload/resume/', 'https') . $user->resume;
        } else {
            $success['resume'] = '';
        }
        $success['resume_file_name'] = $user->resume_file_name;
        $success['created_date'] = $user->created_date;
        return response()->json(["status" => true, "message" => "Profile.", "data" => $success]);
    }

    /*Last Seven Date for mobile home screen */
    public function DateOfWeek()
    {
        $user = Auth::user();
        $m = date("m");
        $de = date("d");
        $y = date("Y");
        $response = array();
        for ($i = 0; $i <= 7; $i++) {
            $date_array = date('Y-m-d:D', mktime(0, 0, 0, $m, ($de - $i), $y));
            $response[] = $date_array;
        }
        return response()->json(["status" => true, "message" => "Date Listing.", "data" => array_reverse($response)]);
    }

    /* Upload file for firebase image */
    public function uploadchatimage(Request $request)
    {
        try {
            $file = $request->file("image");
            $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/chat'), $imageName);
            $chat = asset('public/upload/chat', 'https') . '/' . $imageName;
            return response()->json(['status' => true, 'url' => $chat, 'message' => 'image upload successfully.']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function home(Request $request)
    {
        $user = Auth::user();

        $servise_list_ids = ServiceMember::where('member_id', $user->userid)->groupBy('service_id')->pluck("service_id")->toArray();

        $services = Service::whereIn("id", $servise_list_ids);
        if ($request->filled("date")) {
            $services = $services->whereDate('created_date', '<=', Carbon::parse($request->date))->whereDate('scheduled_end_date', '>=', Carbon::parse($request->date));
        }
        $services = $services->where("status", "!=", "completed")->orderBy("created_date", "desc")->get();
        $response = array();

        foreach ($services as $key => $service) {

            $temp['service_name'] = isset($service->name) ? $service->name : '';
            $temp['service_id'] = isset($service->id) ? $service->id : '';
            $temp['service_id'] = isset($service->id) ? $service->id : '';
            $temp['admin_name'] = User::where("admin", 1)->first() ? User::where("admin", 1)->first()->fullname : "Admin";

            $temp['image'] = $service && $service->image ? asset('public/upload/services/' . $service->image, 'https') : '';

            $temp['serviceScheduleEndDate'] = isset($service->scheduled_end_date) ? $service->scheduled_end_date : '';

            $start_date = date("y-m-d", strtotime($service->created_date));
            $combinedDateTime = Carbon::parse(" $start_date $service->service_start_time");
            $temp['start']  = date("Y-m-d") . " " . $combinedDateTime->format('H:i:s');
            // $currentDate = Carbon::now()->toDateString();
            $end_date = date("y-m-d", strtotime($service->scheduled_end_date));
            $combinedDateTime = Carbon::parse("$end_date $service->service_end_time");
            $temp['end']  =  date("Y-m-d") . " " . $combinedDateTime->format('H:i:s');

            $timesheet = ServiceTimesheet::where('assign_member_id', $user->userid)->where('service_id', $service->id)->whereDate('date', date('Y-m-d'))->first();
            if (!empty($timesheet)) {
                if ($timesheet->status == 1) {
                    $status = 'Scheduled';
                } elseif ($timesheet->status == 2) {
                    $status = 'On the way';
                } elseif ($timesheet->status == Service::where("status", "!=", "completed")->count()) {
                    $status = 'Start';
                } elseif ($timesheet->status == 4) {
                    $status = 'Finish';
                } else {
                    $status = 'Scheduled';
                }
            } else {
                $status = 'Scheduled';
            }

            $temp['status'] = $status;
            $temp['status_id'] = $timesheet ? $timesheet->status : '';
            $temp['on_the_way_time'] = isset($timesheet->on_the_way_time) ? $timesheet->on_the_way_time : '';
            $temp['start_time'] = isset($timesheet->start_time) ? $timesheet->start_time : '';
            $temp['finish_time'] = isset($timesheet->end_time) ? $timesheet->end_time : '';
            $temp['service_image'] = $service && $service->image ? asset('public/upload/services/' . $service->image, 'https') : asset('public/assets/admin-images/hbgimg.png', 'https');
            $temp['client_id'] = isset($service->assigned_client_id) ? $service->assigned_client_id : '';
            $client = Client::where('id', $service->assigned_client_id)->first();
            $temp['clientname'] = isset($client->name) ? $client->name : '';
            $temp['clientemail'] = isset($client->email_address) ? $client->email_address : '';
            $temp['clientphone'] = isset($client->mobile_number) ? $client->mobile_number : '+(987)4563210';
            $temp['address'] = isset($client->street) ? $client->street : '';
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

            $servise_list = ServiceMember::where('member_id', $user->userid)->whereDate('created_at', '=', $request->date)->where('status', 1)->get();
        } else {

            $servise_list = ServiceMember::where('member_id', $user->userid)->orderBy('id', 'DESC')->where('status', 1)->get();
        }

        $response = array();
        foreach ($servise_list as $key => $value) {
            $service = Service::where('id', $value->service_id)->first();
            $temp['service_name'] = isset($service->name) ? $service->name : '';
            $temp['service_id'] = isset($service->id) ? $service->id : '';

            $timesheet = ServiceTimesheet::where('assign_member_id', $user->userid)->where('service_id', $service->id)->whereDate('date', date('Y-m-d'))->first();
            if (!empty($timesheet)) {
                if ($timesheet->status == 1) {
                    $status = 'Scheduled';
                } elseif ($timesheet->status == 2) {
                    $status = 'On the way';
                } elseif ($timesheet->status == 3) {
                    $status = 'Start';
                } elseif ($timesheet->status == 4) {
                    $status = 'Finish';
                } else {
                    $status = 'Scheduled';
                }
            } else {
                $status = 'Scheduled';
            }

            $temp['status'] = $status;
            $temp['status_id'] = isset($timesheet->status) ? $timesheet->status : '';
            $temp['on_the_way_time'] = isset($timesheet->on_the_way_time) ? $timesheet->on_the_way_time : '';
            $temp['start_time'] = isset($timesheet->start_time) ? $timesheet->start_time : '';
            $temp['finish_time'] = isset($timesheet->end_time) ? $timesheet->end_time : '';
            $temp['service_image'] = $service && $service->image ? asset('public/upload/services/' . $service->image, 'https') : asset('public/assets/admin-images/hbgimg.png', 'https');

            $temp['client_id'] = isset($service->assigned_client_id) ? $service->assigned_client_id : '';
            $client = Client::where('id', $service->assigned_client_id)->first();
            $temp['clientname'] = isset($client->name) ? $client->name : '';
            $temp['clientemail'] = isset($client->email_address) ? $client->email_address : '';
            $temp['clientphone'] = isset($client->mobile_number) ? $client->mobile_number : '+(987)4563210';
            $temp['address'] = isset($client->street) ? $client->street : '';
            $temp['lat'] = '28.23654';
            $temp['long'] = '78.9654123';
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "Services Listing", "data" => $response]);
    }

    public function submit_chat_count(Request $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'service_id' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     return errorMsg($validator->errors()->first());
            // }
            $user = Auth::user();
            $chat = ChatCount::where('sender_id', $user->userid)->where('receiver_id', 1)
                // ->where('service_id', $request->service_id)
                ->first();
            if (!empty($chat)) {
                $count = $chat->read_status + 1;
                ChatCount::where('sender_id', $user->userid)->where('receiver_id', 1)
                    // ->where('service_id', $request->service_id)
                    ->update(['read_status' => $count]);
            } else {
                $ChatCount = new ChatCount;
                $ChatCount->sender_id = $user->userid;
                $ChatCount->receiver_id = 1;
                // $ChatCount->service_id = $request->service_id;
                $ChatCount->read_status = 1;
                $ChatCount->save();
            }
            return response()->json(["status" => true, "message" => "Message send"]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function update_chat_count(Request $request)
    {
        try {

            // $validator = Validator::make($request->all(), [
            //     'service_id' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     return errorMsg($validator->errors()->first());
            // }

            $user = Auth::user();

            $chat = ChatCount::where('sender_id', 1)->where('receiver_id', $user->userid)
                // ->where('service_id', $request->service_id)
                ->first();

            if (!empty($chat)) {
                $count = 0;
                ChatCount::where('sender_id', 1)->where('receiver_id', $user->userid)
                    // ->where('service_id', $request->service_id)
                    ->update(['read_status' => $count]);
            } else {
                $ChatCount = new ChatCount;
                $ChatCount->sender_id = $user->userid;
                $ChatCount->receiver_id = 1;
                // $ChatCount->service_id = $request->service_id;
                $ChatCount->read_status = 0;
                $ChatCount->save();
            }
            return response()->json(["status" => true, "message" => "Message updated"]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function sevice_list(Request $request)
    {
        try {
            $user = Auth::user();
            if (isset($request->date)) {

                $servise_list = ServiceMember::where('member_id', $user->userid)->whereDate('created_at', '=', Carbon::parse($request->date))->get();
            } else {

                $servise_list = ServiceMember::where('member_id', $user->userid)->orderBy('id', 'DESC')->get();
            }

            $response = array();
            foreach ($servise_list as $key => $value) {
                $service = Service::where('id', $value->service_id)->first();
                $temp['service_name'] = isset($service->name) ? $service->name : '';
                $temp['service_id'] = isset($service->id) ? $service->id : '';
                $temp['admin_name'] = 'Admin';

                $temp['service_description'] = isset($service->description) ? $service->description : '';

                $temp['admin_id'] = 1;
                $temp['admin_image'] =  $service && $service->image ? asset('public/upload/services/' . $service->image, 'https') : '';
                $count = ChatCount::where('sender_id', 1)->where('service_id', $service->id)->first();
                $temp['msg_count'] =  $count->read_status ?? '0';
                $response[] = $temp;
            }
            return response()->json(["status" => true, "message" => "Services Listing", "data" => $response]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
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
        $value = ServiceMember::where('member_id', $user->userid)->where('service_id', $request->service_id)->first();
        $service = Service::where('id', $request->service_id)->first();
        $temp['service_name'] = isset($service->name) ? $service->name : '';
        $temp['service_id'] = isset($service->id) ? $service->id : '';
        $temp['service_type'] = $service->service_type;
        $temp['service_frequency'] = $service->frequency;

        $timesheet = ServiceTimesheet::where('assign_member_id', $user->userid)->where('service_id', $request->service_id)->whereDate('date', date('Y-m-d'))->first();
        if (!empty($timesheet)) {
            if ($timesheet->status == 1) {
                $status = 'Scheduled';
            } elseif ($timesheet->status == 2) {
                $status = 'On the way';
            } elseif ($timesheet->status == 3) {
                $status = 'Start';
            } elseif ($timesheet->status == 4) {
                $status = 'Finish';
            } else {
                $status = 'Scheduled';
            }
        } else {
            $status = 'Scheduled';
        }

        $temp['status'] = $status;
        $temp['status_id'] = isset($timesheet->status) ? $timesheet->status : '';
        $temp['on_the_way_time'] = isset($timesheet->on_the_way_time) ? $timesheet->on_the_way_time : '';
        $temp['start_time'] = isset($timesheet->start_time) ? $timesheet->start_time : '';
        $temp['finish_time'] = isset($timesheet->end_time) ? $timesheet->end_time : '';
        $temp['service_image'] = $service && $service->image ? asset('public/upload/services/' . $service->image, 'https') : asset('public/assets/admin-images/hbgimg.png', 'https');
        $temp['admin_name'] = User::where("admin", 1)->first() ? User::where("admin", 1)->first()->fullname : "Admin";
        $temp['client_id'] = isset($service->assigned_client_id) ? $service->assigned_client_id : '';
        $client = Client::where('id', $service->assigned_client_id)->first();
        $temp['clientname'] = isset($client->name) ? $client->name : '';
        $temp['clientemail'] = isset($client->email_address) ? $client->email_address : '';
        $temp['clientphone'] = isset($client->mobile_number) ? $client->mobile_number : '+(999)999999';
        $temp['address'] = isset($client->street) ? $client->street : '';
        $temp['lat'] = '28.23654';
        $temp['long'] = '78.9654123';
        $inscope = InScope::orderBy('id', 'DESC')->get();
        $outscope = OutScope::orderBy('id', 'DESC')->get();
        $services_values = ServicesValue::orderBy('id', 'DESC')->get();
        $temp['inscope'] = json_decode($service->inscopes);
        $temp['OutScope'] =  json_decode($service->outscopes);

        $service_items = json_decode($service->service_items);
        $rating_submitted = true;
        foreach ($service_items as  $item) {

            $timesheet = ServiceItemTimesheet::where('assign_member_id', $user->userid)->where('service_id', $service->id)->where('service_item_id', $item->id)
                ->whereDate('date', date('Y-m-d'))->first();

            if ($timesheet) {
                $item->start_time = date("h:i A", strtotime($timesheet->start_time));
                $item->end_time =  date("h:i A", strtotime($timesheet->end_time));
            } else {
                $item->start_time = "";
                $item->end_time = "";
            }



            $sr = ServiceRating::where("service_id", $service->id)->where("service_item_id", $item->id)
                ->where("member_id", $user->userid)->first();
            if ($sr) {
                $item->rate = $sr->rating;
                $item->comment = $sr->review;
            } else {
                $item->rate = 0;
                $item->comment = "";
                $rating_submitted = false;
            }
        }

        $temp['ServicesItems'] = $service_items;
        // scrubber and burnisher machines
        $scrubber_timesheet = ServiceItemTimesheet::where('assign_member_id', $user->userid)->where('service_id', $service->id)->where('machine_type', "scrubber")
            ->whereDate('date', date('Y-m-d'))->first();
        $scrubber = [];
        if ($scrubber_timesheet) {
            $scrubber['start_time'] = date("h:i A", strtotime($scrubber_timesheet->start_time));
            $scrubber['end_time'] =  date("h:i A", strtotime($scrubber_timesheet->end_time));
        } else {
            $scrubber['start_time'] = "";
            $scrubber['end_time'] = "";
        }
        $burnisher_timesheet = ServiceItemTimesheet::where('assign_member_id', $user->userid)->where('service_id', $service->id)->where('machine_type', "burnisher")
            ->whereDate('date', date('Y-m-d'))->first();
        $burnisher = [];
        if ($burnisher_timesheet) {
            $burnisher['start_time'] = date("h:i A", strtotime($burnisher_timesheet->start_time));
            $burnisher['end_time'] =  date("h:i A", strtotime($burnisher_timesheet->end_time));
        } else {
            $burnisher['start_time'] = "";
            $burnisher['end_time'] = "";
        }
        $temp['scrubber'] = $scrubber;
        $temp['burnisher'] = $burnisher;


        $temp['rating_submitted'] = $rating_submitted;
        $temp['service'] = $service;

        $members = [];

        foreach ($service->members as $item) {
            if ($item->member && $item->member->userid != $user->userid) {
                $members[] = ["name" => $item->member->fullname, 'userid' => $item->member->userid, 'phone' => $item->member->phonenumber];
            }
        }

        $temp['scheduled_list'] = [
            'from' => [
                "date" => $service->created_date ? date("m-d-Y", strtotime($service->created_date)) : null,
                'time' => date("h:i A", strtotime($service->service_start_time))
            ],
            'to' => [
                "date" =>  $service->scheduled_end_date ? date("m-d-Y", strtotime($service->scheduled_end_date)) : null,
                'time' =>  date("h:i A", strtotime($service->service_end_time))
            ],
            'list' => $members
        ];
        $total = 0;
        foreach (json_decode($service->service_items) as  $value) {
            $total += $value->price;
        }
        $temp['total'] = $total;


        return response()->json(["status" => true, "message" => "Service Details", "data" => $temp]);
    }

    public function UpdateStatus(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $status = $request->status; /*2:On the way, 3:Start timimg, 4: Finish*/
        if ($status == 2) {
            $key = 'on_the_way_time';
            $value = date('H:i:s');
            $date = date('Y-m-d');
        } elseif ($status == 3) {
            $key = 'start_time';
            $value = date('H:i:s');
            $date = date('Y-m-d');
        } elseif ($status == 4) {
            $key = 'end_time';
            $value = date('H:i:s');
            $date = date('Y-m-d');
        }

        if ($request->has("date") && $request->has("time")) {
            $timesheet = ServiceTimesheet::where('assign_member_id', $user->userid)->where('service_id', $request->service_id)
                ->whereDate('date', Carbon::parse($request->date))->first();

            if (!empty($timesheet)) {
                ServiceTimesheet::where('assign_member_id', $user->userid)->where('service_id', $request->service_id)->whereDate('date', Carbon::parse($request->date))->update(['status' => $request->status, $key => Carbon::parse($request->time)]);
            }
        } else {
            $timesheet = ServiceTimesheet::where('assign_member_id', $user->userid)->where('service_id', $request->service_id)
                ->whereDate('date', Carbon::parse(date('Y-m-d')))->first();
            if (!empty($timesheet)) {
                ServiceTimesheet::where('assign_member_id', $user->userid)->where('service_id', $request->service_id)->whereDate('date', date('Y-m-d'))->update(['status' => $request->status, $key => $value]);
            } else {
                $sheet = new ServiceTimesheet;
                $sheet->assign_member_id = $user->userid;
                $sheet->service_id = $request->service_id;
                $sheet->date = date('Y-m-d');
                $sheet->on_the_way_time = date('H:i:s');
                $sheet->start_time = null;
                $sheet->end_time = null;
                $sheet->status = 2;
                $sheet->save();
            }
        }


        //ServiceMember::where('member_id',$user->userid)->where('service_id',$request->service_id)->update(['status'=>$request->status,$key=>$value]);
        return response()->json(["status" => true, "message" => "Status updated."]);
    }
    public function UpdateServiceItemsStatus(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'service_item_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        // $status = $request->status; /*2:On the way, 3:Start timimg, 4: Finish*/
        // if ($status == 2) {
        //     $key = 'on_the_way';
        //     $value = date('H:i:s');
        //     $date = date('Y-m-d');
        // } elseif ($status == 3) {
        //     $key = 'start_time';
        //     $value = date('H:i:s');
        //     $date = date('Y-m-d');
        // } elseif ($status == 4) {
        //     $key = 'end_time';
        //     $value = date('H:i:s');
        //     $date = date('Y-m-d');
        // }

        if ($request->has('machine_type')) {
            $timesheet = ServiceItemTimesheet::where('assign_member_id', $user->userid)->where('service_id', $request->service_id)
                ->where('machine_type', $request->machine_type)
                ->whereDate('date', date('Y-m-d'))->first();
            if (!empty($timesheet)) {
                ServiceItemTimesheet::where('assign_member_id', $user->userid)
                    ->where('service_id', $request->service_id)
                    ->where('machine_type', $request->machine_type)
                    ->whereDate('date', date('Y-m-d'))
                    ->update(['start_time' => $request->start_time, 'end_time' => $request->end_time,]);
            } else {
                $sheet = new ServiceItemTimesheet;
                $sheet->assign_member_id = $user->userid;
                $sheet->service_id = $request->service_id;
                $sheet->machine_type = $request->machine_type;
                $sheet->date = date('Y-m-d');
                $sheet->start_time = $request->start_time;
                $sheet->end_time = $request->end_time;
                $sheet->save();
            }
        } else {
            $timesheet = ServiceItemTimesheet::where('assign_member_id', $user->userid)->where('service_id', $request->service_id)->where('service_item_id', $request->service_item_id)
                ->whereDate('date', date('Y-m-d'))->first();
            if (!empty($timesheet)) {
                ServiceItemTimesheet::where('assign_member_id', $user->userid)
                    ->where('service_id', $request->service_id)->where('service_item_id', $request->service_item_id)
                    ->whereDate('date', date('Y-m-d'))
                    ->update(['start_time' => $request->start_time, 'end_time' => $request->end_time,]);
            } else {
                $sheet = new ServiceItemTimesheet;
                $sheet->assign_member_id = $user->userid;
                $sheet->service_id = $request->service_id;
                $sheet->service_item_id = $request->service_item_id;
                $sheet->date = date('Y-m-d');
                $sheet->start_time = $request->start_time;
                $sheet->end_time = $request->end_time;
                $sheet->save();
            }
        }


        //ServiceMember::where('member_id',$user->userid)->where('service_id',$request->service_id)->update(['status'=>$request->status,$key=>$value]);
        return response()->json(["status" => true, "message" => "Status updated."]);
    }

    public function submit_review(Request $request)
    {
        $review = new Review();
        $review->member_id = $request->member_id;
        $review->service_id = $request->service_id;

        $review->service = $request->service;
        $review->equipment = $request->equipment;
        $review->burnisher = $request->burnisher;
        $review->supplies = $request->supplies;

        $review->service_rating = $request->service_rating;
        $review->equipment_rating = $request->equipment_rating;
        $review->burnisher_rating = $request->burnisher_rating;
        $review->supplies_rating = $request->supplies_rating;
        $review->save();

        return response()->json(["status" => true, "message" => "Thanks for submitting your feedback.", "data" => $review]);
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


        $user =  User::where('userid', $user->userid)->first();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->gender = $request->gender;

        $user->marital_status = $request->marital_status;
        $user->gender = $request->gender;
        $user->dependents = $request->dependents;
        $user->address = $request->address;
        $user->zipcode = $request->zipcode;
        $user->country_id = $request->country_id;
        $user->city = $request->city;
        $user->state_id = $request->state_id;


        if ($request->has('designation_id')) {
            $user->designation_id = $request->designation_id;
        }

        $user->phonenumber = $request->phonenumber;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $image = uniqid() . "." . $file->getClientOriginalExtension();
            $file->move("public/upload/user-profile/", $image);
            $user->profile_image = $image;
        }
        $user->save();


        $token = $user->createToken('clear-choicejanitorial')->plainTextToken;
        $success['token'] = $token;
        $success['userId'] = $user->userid;
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
        $success['designation'] = Designation::find($user->designation_id) ? Designation::find($user->designation_id)->name : '';

        $success['resume'] = $user->resume;
        $success['state_id'] = $user->state_id;
        $success['zipcode'] = $user->zipcode;

        if ($user->profile_image) {
            $success['profile_image'] = asset('public/upload/user-profile', 'https') . "/" . $user->profile_image;
        } else {
            $success['profile_image'] = '';
        }

        if ($user->resume) {
            $success['resume'] = asset('public/upload/resume/', 'https') . $user->resume;
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
        $state = State::where('country_id', $request->country_id)->get();
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
        $city = City::where('state_id', $request->state_id)->get();
        $response = array();
        foreach ($city as $key => $value) {
            $temp['value'] = $value->id;
            $temp['label'] = $value->name;
            $temp['state_id'] = $value->state_id;
            $response[] = $temp;
        }
        return response()->json(["status" => true, "message" => "State list.", "data" => $response]);
    }

    public function sevice_timecard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'service_id' => 'required',
            'pay_period_start' => 'required',
            'pay_period_end' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $member_id = $request->user()->userid;
        $service_id = $request->service_id;
        $member = User::find($member_id);

        $startPeriod = $request->pay_period_start;
        $endPeriod = $request->pay_period_end;

        $service = Service::find($service_id) ? Service::find($service_id) : "";

        $timesheet = ServiceTimesheet::select([
            'id',
            'service_id',
            'assign_member_id',
            'date',
            'on_the_way_time',
            'start_time',
            'end_time',
            'status',
            'created_at',
            'updated_at',
            DB::raw('WEEK(date) as week_number'),
            DB::raw('DATE_FORMAT(date, "%Y-%m-%d") as formatted_date'),
            DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)) / 3600) as total_hours_worked_on_day'),
            DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time))) as total_hours_worked_on_day_format'),
        ])
            ->where('assign_member_id', $member_id)
            ->when($request->has('service_id'), function ($query) use ($service_id) {
                return  $query->where('service_id', $service_id);
            })
            ->whereBetween('date', [$startPeriod, $endPeriod])
            ->groupBy('id', 'service_id', 'assign_member_id', 'date', 'on_the_way_time', 'start_time', 'end_time', 'status', 'created_at', 'updated_at', DB::raw('WEEK(date)'))
            ->orderBy('date', 'asc')
            ->get();

        $result = [];
        $currentWeek = null;
        $totalHoursInWeek = 0;
        $totalHoursInWeekFormat = 0;
        $totalHours = 0;


        $daysInWeek = [];
        foreach ($timesheet as $record) {


            if ($currentWeek !== $record->week_number) {
                // Start a new week
                if ($currentWeek !== null) {
                    // Add total hours for the previous week
                    $result[] = [
                        'week_number' => $currentWeek,
                        'total_hours_in_week' => $totalHoursInWeek,
                        'total_hours_in_week_format' => $this->formatTime($totalHoursInWeekFormat),
                        'avg_hours_in_week' => $this->formatTime(intval($totalHoursInWeekFormat / count($daysInWeek))),
                        'days' => $daysInWeek,
                        'total_days_worked' => count($daysInWeek),

                    ];
                    $totalHours += $totalHoursInWeekFormat;
                }

                // Initialize for the new week
                $currentWeek = $record->week_number;
                $totalHoursInWeek = 0;
                $daysInWeek = [];
            }

            //    calculate hours in this records service items
            $items = [];


            $service_ = Service::find($record->service_id);
            if ($service_ && $service_->service_items != "") {
                $service_items = json_decode($service_->service_items);

                foreach ($service_items as $service_item) {
                    $si = [];
                    $service_item_id = $service_item->id;
                    $item =    ServiceItemTimesheet::where('assign_member_id', $record->assign_member_id)
                        ->where('service_item_id', $service_item_id)
                        ->whereDate('date', $record->date)->first();

                    if ($item && $item->start_time != "" && $item->end_time != "") {
                        $startTime = Carbon::parse($item->start_time);
                        $endTime = Carbon::parse($item->end_time);

                        // Calculate the difference in seconds
                        $totalSeconds = $this->formatTime($endTime->diffInSeconds($startTime));
                        $si = [
                            'id' => $service_item->id,
                            'name' => $service_item->name,
                            'total_hours' => $totalSeconds
                        ];
                    } else {
                        $si = [
                            'id' => $service_item->id,
                            'name' => $service_item->name,
                            'total_hours' => null
                        ];
                    }
                    $sr = ServiceRating::where("service_id", $record->service_id)->where("service_item_id", $service_item->id)
                        ->where("member_id", $member->userid)->first();
                    if ($sr) {
                        $si['rating'] = $sr->rating;
                        $si['review'] = $sr->review;
                    } else {
                        $si['rating'] = 0;
                        $si['review'] = "";
                    }

                    $items[] = $si;
                }
            }

            $scrubber = [];

            $scrubber_timesheet = ServiceItemTimesheet::where('assign_member_id', $record->assign_member_id)->where('service_id', $record->service_id)->where('machine_type', "scrubber")
                ->whereDate('date', $record->date)->first();

            if ($scrubber_timesheet) {
                $startTime = Carbon::parse($scrubber_timesheet->start_time);
                $endTime = Carbon::parse($scrubber_timesheet->end_time);

                // Calculate the difference in seconds
                $totalSeconds = $this->formatTime($endTime->diffInSeconds($startTime));
                $scrubber['total_hours'] =  $totalSeconds;
            } else {
                $scrubber['total_hours'] = null;
            }
            $burnisher_timesheet = ServiceItemTimesheet::where('assign_member_id', $record->assign_member_id)->where('service_id', $record->service_id)->where('machine_type', "burnisher")
                ->whereDate('date', $record->date)->first();
            $burnisher = [];
            if ($burnisher_timesheet) {
                $startTime = Carbon::parse($burnisher_timesheet->start_time);
                $endTime = Carbon::parse($burnisher_timesheet->end_time);
                // Calculate the difference in seconds
                $totalSeconds = $this->formatTime($endTime->diffInSeconds($startTime));
                $burnisher['total_hours'] =  $totalSeconds;
            } else {
                $burnisher['total_hours'] = null;
            }


            // Record the details for the current day
            $daysInWeek[] = [
                'date' => $record->formatted_date,
                'start_time' => date("H:i A", strtotime($record->start_time)),
                'end_time' => date("H:i A", strtotime($record->end_time)),
                'total_hours_worked_on_day' => $record->total_hours_worked_on_day,
                'total_hours_worked_on_day_format' => $this->formatTime($record->total_hours_worked_on_day_format),
                'service_items' => $items,
                'scrubber' => $scrubber,
                'burnisher' => $burnisher,

                'service_name' => $service_->name ?? "",
                'service_id' => $service_->id ?? "",



            ];

            // Update the total hours for the week
            $totalHoursInWeek += $record->total_hours_worked_on_day;
            $totalHoursInWeekFormat += $record->total_hours_worked_on_day_format;
        }

        // Add the last week
        if ($currentWeek !== null) {
            $result[] = [
                'week_number' => $currentWeek,
                'total_hours_in_week' => $totalHoursInWeek,
                'total_hours_in_week_format' => $this->formatTime($totalHoursInWeekFormat),
                'avg_hours_in_week' => $this->formatTime(intval($totalHoursInWeekFormat / count($daysInWeek))),
                'days' => $daysInWeek,
                'total_days_worked' => count($daysInWeek)

            ];
            $totalHours += $totalHoursInWeekFormat;
        }




        $timesheet_submitted = TimesheetRequest::whereDate("start_date", Carbon::parse($request->pay_period_start))->whereDate("end_date", Carbon::parse($request->pay_period_end))->where("member_id", $member->userid)->first();
        $data = [
            'start_period' => $startPeriod,
            'end_period' => $endPeriod,
            'name' => $member->fullname,
            'job_title' => $service->name ?? "",
            'job_location' =>  $service ? ($service->client ? $service->client->street : '') : "",
            'store_name' => $service ? ($service->client ? $service->client->name : '') : "",
            'store_number' => $service ? ($service->client ? $service->client->home_number : '') : '',
            'timesheet' => $result, 'total_hours' => $this->formatTime($totalHoursInWeekFormat),
            "timesheet_submitted" => $timesheet_submitted ? true : false,
            "timesheet_status" => $timesheet_submitted ? $timesheet_submitted->status : "Pending",
            'service' => $service,
            'pdf' => ''

        ];
        // if ($request->service_id) {
        $timecard = uniqid();
        Pdf::loadView("pdf.timecard", $data)->save("public/upload/pdfs/timcard$timecard.pdf");
        $data["pdf"] = custom_asset("public/upload/pdfs/timcard$timecard.pdf");
        // }

        return response()->json(["status" => true, "message" => "timesheet.", "data" => $data]);
    }
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

        return trim($formattedTime);
    }
    public function serviceLogs()
    {
        $user = Auth::user();
        $timesheet = ServiceTimesheet::when(request()->filled("date"), function ($query) {
            return  $query->whereDate("date", Carbon::parse(request('date')));
        })->where("assign_member_id", auth()->user()->userid)->whereNotNull("end_time")->get();
        $timesheets = [];

        foreach ($timesheet as $item) {
            $service = Service::find($item->service_id);
            $service->address = $service->client ? $service->client->street : '';
            $item->service = $service;
            $item->service->created_date = date("Y-m-d", strtotime($item->service->created_date));
        }
        // $assigned_services = ServiceMember::where("member_id", $user->userid)->groupBy("service_id")->pluck("service_id")->toArray();
        // $completed_services = ServiceTimesheet::where("assign_member_id", $user->userid)->groupBy("service_id")->pluck("service_id")->toArray();
        // $incomplete_services = [];
        // $complete_services = [];

        // foreach ($assigned_services as $id) {
        //     if (!in_array($id, $completed_services)) {
        //         $incomplete_services[] = $id;
        //     } else {
        //         $complete_services[] = $id;
        //     }
        // }

        $success = Service::where("status",  "completed")->whereIn("id", $timesheets)->get();


        return response()->json(["status" => true, "message" => "service logs.", "data" => $timesheet]);
    }
    public function incompleteServices()
    {
        $user = Auth::user();
        $assigned_services = ServiceMember::where("member_id", $user->userid)->groupBy("service_id")->pluck("service_id")->toArray();
        $completed_services = ServiceTimesheet::where("assign_member_id", $user->userid)->groupBy("service_id")->pluck("service_id")->toArray();

        $incomplete_services = [];
        foreach ($assigned_services as $id) {
            if (!in_array($id, $completed_services)) {
                $incomplete_services[] = $id;
            }
        }
        $services = Service::where("status", "completed")->whereIn("id", $incomplete_services)->get();

        foreach ($services as $service) {
            $service->address = $service->client ? $service->client->street : "";
            $service->service_image = $service && $service->image ? asset('public/upload/services/' . $service->image, 'https') : asset('public/assets/admin-images/hbgimg.png', 'https');
        }
        return response()->json(["status" => true, "message" => "incompleted services.", "data" => $services]);
    }
    function forget_password(Request $request)

    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email|exists:user',


        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $rand = rand(1000, 9999);
        return response()->json(["status" => true, "message" => "OTP sent successfully.", "data" => $rand]);
    }
    function reset_password(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:user',
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = User::where("email", $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(["status" => true, "message" => "Password updated successfully.", "data" => $user]);
    }

    function service_rating(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'service_item_id' => 'required',

            'rating' => 'required',



        ]);
        $user = Auth::user();
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        foreach ($request->service_item_id as $key => $value) {
            if (key_exists($key, $request->rating) && key_exists($key, $request->review) && key_exists($key, $request->service_id)) {
                $sr = ServiceRating::where("service_id", $request->service_id[$key])->where("service_item_id", $request->service_item_id[$key])
                    ->where("member_id", $user->userid)->first();

                if ($sr) {
                    $sr->rating = $request->rating[$key];
                    $sr->review = $request->review[$key];
                    $sr->save();
                } else {
                    $sr = new ServiceRating();
                    $sr->service_id = $request->service_id[$key];
                    $sr->service_item_id = $request->service_item_id[$key];
                    $sr->member_id = $user->userid;
                    $sr->rating = $request->rating[$key];
                    $sr->review = $request->review[$key];
                    $sr->save();
                }
            }
        }


        return response()->json(["status" => true, "message" => "Feedback saved successfully.", "data" => $user]);
    }

    function timesheet_request(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        $user = Auth::user();
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $sr = TimesheetRequest::where("start_date", $request->start_date)->where("end_date", $request->end_date)
            ->where("member_id", $user->userid)->first();
        if ($sr) {
            return response()->json(["status" => false, "message" => "This timesheet is already Submitted.",]);
        } else {
            $sr = new TimesheetRequest();
            $sr->start_date = $request->start_date;
            $sr->end_date = $request->end_date;

            $sr->member_id = $user->userid;
            if ($request->has('service_id')) {
                $sr->service_id = $request->service_id;
            }
            $sr->status = "Pending";
            $sr->save();
        }

        return response()->json(["status" => true, "message" => "Timesheet is  Submitted successfully.", "data" => $user]);
    }
}
