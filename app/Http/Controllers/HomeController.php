<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Designation;
use App\Models\MaritalStatus;
use App\Models\ServicesValue;
use App\Models\InScope;
use App\Models\OutScope;
use App\Models\Service;
use App\Models\Country;
use App\Models\ChatCount;
use App\Models\State;
use App\Models\City;
use App\Models\Notification;
use App\Models\ServiceItemTimesheet;
use Carbon\Carbon;
use App\Models\ServiceMember;
use App\Models\ServiceTimesheet;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
// use Spatie\LaravelPdf\Facades\Pdf;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::query();

        $services = $services->count();
        $members = User::where('user_type', 2)->where("status", 1)->count();



        $ongoing = Service::has("members");
        if (request()->has('date')) {
            $ongoing = $ongoing->whereDate("created_date", Carbon::parse(request('date')));
        }
        if (request()->has('search')) {
            $ongoing = $ongoing->where("name", "LIKE", "%" . trim(request('search')) . "%");
        }
        $ongoing = $ongoing->orderBy("id", "desc")->get();

        $unassigned = Service::doesntHave("members");
        if (request()->has('date')) {
            $unassigned = $unassigned->whereDate("created_date", Carbon::parse(request('date')));
        }
        if (request()->has('search')) {
            $unassigned = $unassigned->where("name", "LIKE", "%" . trim(request('search')) . "%");
        }
        // $msgs = User::where('status', 1)->orderByDesc(function ($query) {
        //     // Replace 'getCountByUserId' with the actual name of your helper function
        //     $query->selectRaw(CountMSG('users.userid') . ' as user_count')->orderBy('user_count', 'desc');
        // })->get();
        // $msgs = User::where("userid", "!=", 1)->get()->sortByDesc(function ($user) {
        //     return $user->getMessageCount();
        // });
        $userOrder = ChatCount::whereNotNull("sent_at")->where("sender_id", "!=", 1)->orderBy("sent_at", "desc")->groupBy("sender_id")->pluck("sender_id")->toArray();
        $msgs = [];
        foreach ($userOrder as $id) {
            $msgs[] = User::find($id);
        }
        // Retrieve and display remaining users
        $remainingUsers = User::whereNotIn('userid', $userOrder)->where("userid", "!=", 1)
            ->get();
        foreach ($remainingUsers as $id) {
            $msgs[] = $id;
        }

        $unassigned = $unassigned->orderBy("id", "desc")->get();
        $request_members = User::where('status', 0)->where('userid', '!=', 1)->orderBy('userid', 'DESC')->count();


        return view('admin.dashboard', compact('services', 'members', 'msgs', 'ongoing', 'request_members', 'unassigned'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function clients()
    {
        $datas = Client::query();
        if (request()->has('search')) {
            $datas = $datas->where(function ($query) {
                $query->where("name", "LIKE", "%" . trim(request('search')) . "%")->orwhereDate("created_at", Carbon::parse(request('date')))->orWhere("address", "LIKE", "%" . request('search'));
            });
        }
        $datas = $datas->orderBy('id', 'DESC')->paginate(10);
        return view('admin.clients.index', compact('datas'));
    }

    public function EditTeamMember($id)
    {
        $id = encryptDecrypt('decrypt', $id);
        $designation = Designation::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $state = State::orderBy('id', 'DESC')->get();

        $MaritalStatus = MaritalStatus::orderBy('id', 'DESC')->get();
        $data = User::where('userid', $id)->first();
        $city = City::where("state_id", $data->state_id)->orderBy('id', 'DESC')->get();
        return view('admin.teams.edit', compact('data', 'designation', 'country', 'state', 'city', 'data', 'MaritalStatus'));
    }

    public function SaveClient(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255|min:1',
                'last_name' => 'required|string|max:255|min:1',
                'email_address' => "required|email|unique:clients|unique:user,email",
                'mobile_number' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user = Client::create([
                'email_address' => $request->email_address,
                'name' => $request->first_name . ' ' . $request->last_name,
                'mobile_number' => $request->mobile_number,
                'address' => $request->address,
                'display_name' => $request->display_name,
                'company' => $request->company,
                'mobile_number' => $request->mobile_number,
                'home_number' => $request->home_number,
                'client_work_number' => $request->client_work_number,
                'role' => $request->role,
                'ownertype' => $request->ownertype,
                'address_notes' => $request->address_notes,
                'contractor' => $request->contractor,
                'street' => $request->street,
                'unit' => $request->unit,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'client_notes' => $request->client_notes,
                'client_tags' => $request->client_tags,
                'client_bills_to' => $request->client_bills_to,
                'lead_source' => $request->lead_source,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect(route("services.create"))->with('message', 'client created successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }

    public function UpdateClient(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255|min:1',
                'last_name' => 'required|string|max:255|min:1',
                'email_address' => "required|email",
                'mobile_number' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (Client::where('id', $request->id)->first()) {


                $Client = Client::where('id', $request->id)->first();
                if ($Client->email_address === $request->email_address || Client::where('email_address', $request->email_address)->count() == 0) {
                } else {
                    return redirect('client')->with('error', 'Email Already exists');
                }
                $Client->email_address = $request->email_address;
                $Client->name = $request->first_name . ' ' . $request->last_name;
                $Client->mobile_number = $request->mobile_number;
                $Client->address = $request->address;
                $Client->display_name = $request->display_name;
                $Client->company = $request->company;
                $Client->home_number = $request->home_number;
                $Client->client_work_number = $request->client_work_number;
                $Client->role = $request->role;
                $Client->ownertype = $request->ownertype;
                $Client->address_notes = $request->address_notes;
                $Client->contractor = $request->contractor;
                $Client->street = $request->street;
                $Client->unit = $request->unit;
                $Client->country_id = $request->country_id;
                $Client->state_id = $request->state_id;
                $Client->city = $request->city;
                $Client->zipcode = $request->zipcode;
                $Client->client_notes = $request->client_notes;
                $Client->client_tags = $request->client_tags;
                $Client->client_bills_to = $request->client_bills_to;
                $Client->lead_source = $request->lead_source;
                $Client->save();
            }
            return redirect('client')->with('success', 'Client updated successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }

    public function SaveTeamMember(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'resume' => 'required|mimes:pdf,doc,docx|max:5120',
                'first_name' => 'required|string|max:255|min:1',
                'last_name' => 'required|string|max:255|min:1',
                'email' => 'required|email|unique:user',
                'mobile_phone' => 'required',
                'password' => ['required', 'min:8'],
                'c_password' => ['required', 'same:password', 'min:8'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user = new User();
            $resume = '';
            $resume_file_name = '';
            if ($request->hasFile('resume')) {

                $file = $request->file("resume");
                $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/resume'), $imageName);
                $resume = public_path('upload/resume') . $imageName;
                $resume_file_name = $imageName;
            }
            $user->resume = $resume;
            $user->resume = $resume_file_name;

            $user->fullname = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->status = 1;
            $user->address = $request->address;
            $user->display_name = $request->display_name;
            $user->company_name = $request->company_name;
            $user->phonenumber = $request->mobile_phone;
            $user->home_phone = $request->home_phone;
            $user->work_phone = $request->work_phone;
            $user->emergency_phone = $request->emergency_phone;
            $user->rate_of_pay = $request->rate_of_pay;
            $user->duration_of_rate = $request->duration_of_rate;


            $user->designation_id = $request->role;
            $user->marital_status = $request->marital_status;
            $user->DOB = $request->dob;
            $user->ownertype = $request->ownertype;
            $user->address_notes = $request->address_notes;
            $user->contractor = $request->contractor;
            $user->street = $request->street;
            $user->unit = $request->unit;
            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->city = $request->city;
            $user->zipcode = $request->zipcode;


            // Newly added parameter
            $user->bank = $request->bank;
            $user->ssn = $request->ssn;
            $user->account = $request->account;
            $user->routing_number = $request->routing_number;

            $user->save();

            return redirect('teams-active')->with('success', 'Team member created successfully');
        } catch (\Exception $e) {
            // return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
            return redirect('teams-active')->with('error', $e->getMessage());
        }
    }

    public function add_member()
    {
        try {
            $designation = Designation::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $state = State::orderBy('id', 'DESC')->get();
            $city = City::orderBy('id', 'DESC')->take(1000)->get();
            $MaritalStatus = MaritalStatus::orderBy('id', 'DESC')->get();
            return view('admin.members.create', compact('designation', 'country', 'state', 'city', 'MaritalStatus'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function UpdateTeamMember(Request $request)
    {
        try {
            $user = User::where('userid', $request->userid)->first();
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255|min:1',
                'last_name' => 'required|string|max:255|min:1',
                'email' => "required|email",
                'mobile_phone' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->file('resume')) {
                $file = $request->file('resume');
                $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path("upload/resume"), $imageName);
                User::where('userid', $request->userid)->update(['resume' => $imageName, 'resume_file_name' => $imageName]);
            }

            $user->fullname = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->display_name = $request->display_name;
            $user->company_name = $request->company_name;
            $user->phonenumber = $request->mobile_phone;
            $user->home_phone = $request->home_phone;
            $user->work_phone = $request->work_phone;
            $user->emergency_phone = $request->emergency_phone;
            $user->rate_of_pay = $request->rate_of_pay;
            $user->duration_of_rate = $request->duration_of_rate;


            $user->designation_id = $request->role;
            $user->marital_status = $request->marital_status;
            $user->DOB = $request->dob;
            $user->ownertype = $request->ownertype;
            $user->address_notes = $request->address_notes;
            $user->contractor = $request->contractor;
            $user->street = $request->street;
            $user->unit = $request->unit;
            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->city = $request->city;
            $user->zipcode = $request->zipcode;


            // Newly added parameter
            $user->bank = $request->bank;
            $user->ssn = $request->ssn;
            $user->account = $request->account;
            $user->routing_number = $request->routing_number;

            $user->save();

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect('teams-active')->with('success', 'Team member updated successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }

    public function Updateuser(Request $request)
    {
        try {
            $user = User::where('userid', $request->userid)->first();
            $validator = Validator::make($request->all(), [
                'fullname' => 'required|string|max:255|min:1',
                'email' => "required|email",
                'phonenumber' => 'required',
                'address' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->file('profile_image')) {
                $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $request->profile_image->extension();
                $request->profile_image->move(public_path('upload/user-profile'), $imageName);
                User::where('userid', $request->userid)->update(['profile_image' => $imageName]);
            }

            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->phonenumber = $request->phonenumber;
            $user->save();

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }

    public function changeSetting(Request $request)
    {
        try {
            $user = Auth::user();
            if (Hash::check($request->old_password, $user->password)) {
                if (!Hash::check($request->new_password, $user->password)) {
                    $user->password = Hash::make($request->new_password);
                    if ($user->save()) {
                        return redirect()->back()->with('success', 'Password setting successfully updated');
                    }
                } else {
                    return redirect()->back()->with('error', 'New password and Current password can\'t be same');
                }
            } else {
                return redirect()->back()->with('error', 'Wrong old password. Try again...');
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function Savemaster(Request $request)
    {
        try {
            $tag_id = $request->tag_id;
            if ($tag_id == 4) {
                $name = 'Designation';
                $user = Designation::create([
                    'name' => $request->name,
                    'status' => 1,
                ]);
            } elseif ($tag_id == 5) {
                $name = 'Marital Status';
                $user = MaritalStatus::create([
                    'name' => $request->name,
                    'status' => 1,
                ]);
            } elseif ($tag_id == 3) {

                $name = 'Services';
                $user = ServicesValue::create([
                    'name' => $request->name,
                    'price' => $request->price,
                    'status' => 1,
                ]);
                // dd($request->all());
            } elseif ($tag_id == 2) {
                $name = 'Out Of Scope';
                $user = OutScope::create([
                    'name' => $request->name,
                    'status' => 1,
                ]);
            } elseif ($tag_id == 1) {
                $name = 'In Scope';
                $user = InScope::create([
                    'name' => $request->name,
                    'status' => 1,
                ]);
            } else {
            }
            return redirect('master')->with('message', $name . 'created successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }
    public function UpdateMaster(Request $request)
    {
        try {
            $tag_id = $request->tag_id;
            if ($tag_id == 4) {
                $name = 'Designation';

                Designation::where("id", $request->id)->update(['name' => $request->name]);
            } elseif ($tag_id == 5) {
                $name = 'Marital Status';

                MaritalStatus::where("id", $request->id)->update(['name' => $request->name]);
            } elseif ($tag_id == 3) {

                $name = 'Services';

                ServicesValue::where("id", $request->id)->update([
                    'name' => $request->name,
                    'price' => $request->price,
                ]);

                // dd($request->all());
            } elseif ($tag_id == 2) {
                $name = 'Out Of Scope';

                OutScope::where("id", $request->id)->update([
                    'name' => $request->name,
                ]);
            } elseif ($tag_id == 1) {
                $name = 'In Scope';

                InScope::where("id", $request->id)->update([
                    'name' => $request->name,
                ]);
            } else {
            }
            return redirect('master')->with('message', $name . ' update successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }
    public function delete_master_items($type, $id)
    {
        try {
            $id = encryptDecrypt('decrypt', $id);
            if ($type == 1) {
                $name = 'In Scope';
                $data = InScope::where('id', $id)->delete();
                return redirect('master')->with('message', $name . 'Deleted successfully');
            } elseif ($type == 2) {
                $name = 'Out Of Scope';
                $data = OutScope::where('id', $id)->delete();
                return redirect('master')->with('message', $name . 'Deleted successfully');
            } elseif ($type == 3) {
                $name = 'Services';
                $data = ServicesValue::where('id', $id)->delete();
                return redirect('master')->with('message', $name . 'Deleted successfully');
            } elseif ($type == 4) {
                $name = 'Designation';
                $data = Designation::where('id', $id)->delete();
                return redirect('master')->with('message', $name . 'Deleted successfully');
            } elseif ($type == 5) {
                $name = 'Marital Status';
                $data = MaritalStatus::where('id', $id)->delete();
                return redirect('master')->with('message', $name . 'Deleted successfully');
            } else {
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function team_active(Request $request)
    {
        try {
            if ($request->has("search")) {
                $search = $request->search;
                $type = 1;
                $datas = User::where('status', 1)->where('user_type', 2)->where(function ($query) use ($search) {
                    $query->orwhere('fullname', 'like', '%' . $search . '%')
                        ->orwhere('email', 'like', '%' . $search . '%')
                        ->orwhere('userid', 'like', '%' . $search . '%')
                        ->orwhere('phonenumber', 'like', '%' . $search . '%');
                })->orderBy('userid', 'DESC')->paginate(10);
                return view('admin.teams.index', compact('datas', 'search', 'type'));
            } else {
                $search = '';
                $type = 1;
                $datas = User::where('status', 1)->where('user_type', 2)->orderBy('userid', 'DESC')->paginate(10);


                return view('admin.teams.index', compact('datas', 'search', 'type'));
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function team_inactive(Request $request)
    {
        try {
            if ($request->has("search")) {
                $search = $request->search;
                $type = 2;
                $datas = User::where('status', 2)->where('user_type', 2)->where(function ($query) use ($search) {
                    $query->orwhere('fullname', 'like', '%' . $search . '%')
                        ->orwhere('email', 'like', '%' . $search . '%')
                        ->orwhere('userid', 'like', '%' . $search . '%')
                        ->orwhere('phonenumber', 'like', '%' . $search . '%');
                })->orderBy('userid', 'DESC')->paginate(10);
                return view('admin.teams.index', compact('datas', 'search', 'type'));
            } else {
                $search = '';
                $type = 2;
                $datas = User::where('status', 2)->where('userid', '!=', 1)->orderBy('userid', 'DESC')->paginate(10);
                return view('admin.teams.index', compact('datas', 'search', 'type'));
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function team_detail($id)
    {
        try {
            $id = encryptDecrypt('decrypt', $id);
            $data = User::where('userid', $id)->first();
            $service_ids = ServiceMember::where("member_id", $id)->groupBy("service_id")->pluck("service_id")->toArray();

            $services = Service::has("members");
            if (request()->has('date')) {
                $services = $services->whereDate("created_at", Carbon::parse(request('date')));
            }
            $services = $services->whereIn("id", $service_ids)->orderBy("id", "desc")->get();

            $completed_services = Service::where("status", "completed");
            if (request()->has('date')) {
                $completed_services = $completed_services->whereDate("created_at", Carbon::parse(request('date')));
            }
            $completed_services = $completed_services->whereIn("id", $service_ids)->orderBy("id", "desc")->get();


            $currentWeekStartDate = Carbon::now()->startOfWeek();
            $currentWeekEndDate = Carbon::now()->endOfWeek();

            $this_week = ServiceTimesheet::select([
                'assign_member_id',
                DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)) ) as total_hours_worked_on_week'),
            ])
                ->where('assign_member_id', $id)

                ->whereBetween('date', [$currentWeekStartDate, $currentWeekEndDate])
                ->groupBy('assign_member_id')
                ->first();

            $this_week = $this_week ? $this->formatTime($this_week->total_hours_worked_on_week) : '0 hours';

            $currentDate = Carbon::now()->toDateString();

            $total_hours = ServiceTimesheet::select([
                'assign_member_id',
                DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time))) as total_hours_worked_till_date'),
            ])
                ->where('assign_member_id', $id)

                ->where('date', '<=', $currentDate)
                ->groupBy('assign_member_id')
                ->first();
            $total_hours = $total_hours ? $this->formatTime($total_hours->total_hours_worked_till_date) : '0 hours';
            return view('admin.teams.show', compact('data', 'services', 'completed_services', 'this_week', 'total_hours'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
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
    public function approve_member($id)
    {
        try {
            $userid = encryptDecrypt('decrypt', $id);
            $data = User::where('userid', $userid)->update(['status' => 1]);
            // create notification
            $notification = new Notification();
            $notification->title = "Account Approved by admin";
            // $notification->details = "By $user->fullname";
            $notification->image = $data->profile_image != "" ? asset('public/upload/user-profile/' . $user->profile_image) : "";
            $notification->redirect_url = null;
            $notification->user_id = $data->id;
            $notification->save();
            return redirect('/teams-active')->with('success', 'Team member approved successfully');

            sendWebNotification($notification, []);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function reject_member($id)
    {
        try {
            $userid = encryptDecrypt('decrypt', $id);
            $data = User::where('userid', $userid)->update(['status' => 2]);
            return redirect('/teams-inactive')->with('success', 'Team member rejected successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function member_request_detail($id)
    {
        try {
            $id = encryptDecrypt('decrypt', $id);
            $data = User::where('userid', $id)->first();
            $count = User::where('status', 0)->where('userid', '!=', 1)->orderBy('userid', 'DESC')->count();
            return view('admin.member-registration-request-detail', compact('data', 'count'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function client_details($id)
    {
        try {
            $id = encryptDecrypt('decrypt', $id);
            $data = Client::where('id', $id)->first();
            $ongoing = Service::has("members")->where("assigned_client_id", $id)->where("status", "ongoing");
            if (request()->has('date')) {
                $ongoing = $ongoing->whereDate("created_date", Carbon::parse(request('date')));
            }
            if (request()->has('search')) {
                $ongoing = $ongoing->where("name", "LIKE", "%" . request('search') . "%");
            }
            $ongoing = $ongoing->orderBy("id", "desc")->get();

            $completed = Service::where("assigned_client_id", $id)->where("status", "completed");
            if (request()->has('date')) {
                $completed = $completed->whereDate("created_date", Carbon::parse(request('date')));
            }
            if (request()->has('search')) {
                $completed = $completed->where("name", "LIKE", "%" . request('search') . "%");
            }
            $completed = $completed->orderBy("id", "desc")->get();

            $unassigned = Service::doesntHave("members")->where("assigned_client_id", $id);
            if (request()->has('date')) {
                $unassigned = $unassigned->whereDate("created_date", Carbon::parse(request('date')));
            }
            if (request()->has('search')) {
                $unassigned = $unassigned->where("name", "LIKE", "%" . request('search') . "%");
            }
            $unassigned = $unassigned->orderBy("id", "desc")->get();

            return view('admin.clients.show', compact('data', 'ongoing', 'completed', 'unassigned'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function create_schedular()
    {
        try {
            return view('admin.create_schedular');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function profile()
    {
        try {
            return view('admin.profile');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function master()
    {
        try {
            $InScope = InScope::where('status', 1)->orderBy('id', 'desc')->get();
            $OutScope = OutScope::where('status', 1)->orderBy('id', 'desc')->get();
            $ServicesValue = ServicesValue::where('status', 1)->orderBy('id', 'desc')->get();
            $Designation = Designation::where('status', 1)->orderBy('id', 'desc')->get();
            $MaritalStatus = MaritalStatus::where('status', 1)->orderBy('id', 'desc')->get();
            return view('admin.master', compact('ServicesValue', 'MaritalStatus', 'Designation', 'InScope', 'OutScope'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function member_request()
    {
        try {
            $datas = User::where('status', 0)->where('userid', '!=', 1)->orderBy('userid', 'DESC')->paginate(5);
            $count = User::where('status', 0)->where('userid', '!=', 1)->orderBy('userid', 'DESC')->count();
            return view('admin.member-registration-request', compact('datas', 'count'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function submit_chat_count(Request $request)
    {
        try {
            $serviceID = $request['serviceID']; /*service_id Id*/
            $receiver_id = $request['receiver_id']; /*receiver_id Id*/
            $user = Auth::user();
            $chat = ChatCount::where('sender_id', 1)->where('receiver_id', $receiver_id)->first();
            if (!empty($chat)) {
                $count = $chat->read_status + 1;
                //dd($count);
                ChatCount::where('sender_id', 1)->where('receiver_id', $receiver_id)->update(['read_status' => $count]);
            } else {
                $ChatCount = new ChatCount;
                $ChatCount->sender_id = 1;
                $ChatCount->receiver_id = $receiver_id;
                // $ChatCount->service_id = $serviceID;
                $ChatCount->read_status = 1;
                $ChatCount->save();
            }
            return 1;
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function update_chat_count(Request $request)
    {
        try {
            // $serviceID = $request['serviceID']; /*service Id*/
            $receiver_id = $request['receiver_id']; /*receiver Id*/

            $chat = ChatCount::where('sender_id', $receiver_id)->where('receiver_id', 1)->first();
            if (!empty($chat)) {
                $count = 0;
                ChatCount::where('sender_id', $receiver_id)->where('receiver_id', 1)->update(['read_status' => $count]);
                return 'Updated';
            }
            return 'not Updated';
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function add_client()
    {
        try {
            $designation = Designation::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $state = State::orderBy('id', 'DESC')->get();
            $city = City::orderBy('id', 'DESC')->take(1000)->get();
            $MaritalStatus = MaritalStatus::orderBy('id', 'DESC')->get();
            $data = null;
            return view('admin.clients.create', compact('designation', 'country', 'state', 'city', 'MaritalStatus', 'data'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function chats(Request $request)
    {
        try {
            if (isset($request->search)) {
                $search = $request->search;
                $datas = User::where('fullname', 'like', '%' . $search . '%')->where('status', 1)->get()->sortByDesc(function ($user) {
                    return $user->getMessageCount();
                });;

                $firstData = $datas->first();
                $servise_list = $firstData ? ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->get() : [];
                $servise_first = $firstData ? ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->first() : null;
                return view('admin.chat', compact('datas', 'firstData', 'search', 'servise_first', 'servise_list'));
            } else {
                $search = '';
                $datas = User::where('status', 1)->get()->sortByDesc(function ($user) {
                    return $user->getMessageCount();
                });
                $userOrder = ChatCount::whereNotNull("sent_at")->where("sender_id", "!=", 1)->orderBy("sent_at", "desc")->groupBy("sender_id")->pluck("sender_id")->toArray();
                $datas = [];
                foreach ($userOrder as $id) {
                    $datas[] = User::find($id);
                }
                // Retrieve and display remaining users
                $remainingUsers = User::whereNotIn('userid', $userOrder)->where("userid", "!=", 1)
                    ->get();
                foreach ($remainingUsers as $id) {
                    $datas[] = $id;
                }
                $firstData = $datas[0];
                $servise_list = ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->get();
                $servise_first = ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->first();
                return view('admin.chat', compact('datas', 'firstData', 'search', 'servise_first', 'servise_list'));
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function chatsID(Request $request, $id)
    {
        try {
            if (isset($request->search)) {
                $id = encryptDecrypt('decrypt', $id);
                $search = $request->search;
                $datas = User::where('status', 1)->where('fullname', 'like', '%' . $search . '%')->get()->sortByDesc(function ($user) {
                    return $user->getMessageCount();
                });
                $firstData = User::find($id);
                $servise_list = ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->get();
                $servise_first = ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->first();
                return view('admin.chat', compact('datas', 'firstData', 'search', 'servise_list', 'servise_first'));
            } else {
                $id = encryptDecrypt('decrypt', $id);
                $search = '';
                $userOrder = ChatCount::whereNotNull("sent_at")->where("sender_id", "!=", 1)->orderBy("sent_at", "desc")->groupBy("sender_id")->pluck("sender_id")->toArray();
                $datas = [];
                foreach ($userOrder as $userid) {
                    $datas[] = User::find($userid);
                }
                // Retrieve and display remaining users
                $remainingUsers = User::whereNotIn('userid', $userOrder)->where("userid", "!=", 1)
                    ->get();
                foreach ($remainingUsers as $item) {
                    $datas[] = $item;
                }
                $firstData = User::find($id);
                $servise_list = ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->get();
                $servise_first = ServiceMember::where('member_id', $firstData->userid)->orderBy('id', 'DESC')->first();
                $chat = ChatCount::where('sender_id', 1)->where('receiver_id', $id)->first();
                // if(!empty($chat))
                // {
                //     ChatCount::where('sender_id', 1)->where('receiver_id', $id)->update(['read_status' => 0]);
                // }
                return view('admin.chat', compact('datas', 'firstData', 'search', 'servise_list', 'servise_first'));
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function EditClient($id)
    {
        try {
            $id = encryptDecrypt('decrypt', $id);
            $designation = Designation::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();


            $MaritalStatus = MaritalStatus::orderBy('id', 'DESC')->get();
            $data = Client::where('id', $id)->first();
            $state = State::where("country_id", $data->country_id)->orderBy('id', 'DESC')->get();
            $city = City::where("state_id", $data->state_id)->orderBy('id', 'DESC')->get();
            return view('admin.clients.edit', compact('designation', 'country', 'state', 'city', 'MaritalStatus', 'data'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
    public function help_support_save_img(Request $request)
    {
        try {

            $file = $request->file("image");
            $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/chat'), $imageName);
            return response()->json(['status' => true, 'url' => $imageName, 'message' => 'image upload successfully.']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function timecard(Request $request, $id)
    {

        $member_id = $id;

        $member = User::find($member_id);
        $startPeriod = date('Y-m-01');
        $endPeriod = date('Y-m-t');
        if ($request->has("month")) {
            $startPeriod = date("Y-$request->month-01");
            $endPeriod = date("Y-$request->month-t");
        }
        if ($request->has("year")) {
            $startPeriod = date("$request->year-m-01");
            $endPeriod = date("$request->year-m-t");
        }
        if ($request->has("year") && $request->has("month")) {
            $startPeriod = date("$request->year-$request->month-01");
            $endPeriod = date("$request->year-$request->month-t");
        }


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
            DB::raw('MONTH(date) as month'),
            DB::raw('MIN(date - INTERVAL WEEKDAY(date) DAY) AS start_of_week'),
            DB::raw('MAX(date + INTERVAL (6 - WEEKDAY(date)) DAY) AS end_of_week'),
            DB::raw('DATE_FORMAT(date, "%Y-%m-%d") as formatted_date'),
            DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)) / 3600) as total_hours_worked_on_day'),
            DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time))) as total_hours_worked_on_day_format'),
        ])
            ->where('assign_member_id', $member_id)

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
                        'start_of_week' => (new DateTime())->setISODate($request->has('year') ? $request->year : date("Y"), $currentWeek, 1)->format('d-m-Y'),
                        'end_of_week' => (new DateTime())->setISODate($request->has('year') ? $request->year : date("Y"), $currentWeek, 7)->format('d-m-Y'),

                        'total_hours_in_week' => $totalHoursInWeek,
                        'total_hours_in_week_format' => $this->formatime($totalHoursInWeekFormat),
                        'avg_hours_in_week' => $this->formatime(intval($totalHoursInWeekFormat / count($daysInWeek))),
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

            $service_items_records =    ServiceItemTimesheet::where('assign_member_id', $record->assign_member_id)->where('service_id', $record->service_id)
                ->whereDate('date', $record->date)->get();

            foreach ($service_items_records as  $item) {
                if ($item->start_time != "" && $item->end_time != "") {
                    $startTime = Carbon::parse($item->start_time);
                    $endTime = Carbon::parse($item->end_time);

                    // Calculate the difference in seconds
                    $totalSeconds = $this->formatTime($endTime->diffInSeconds($startTime));
                    $items[] = [
                        'name' => ServicesValue::find($item->service_item_id) ? ServicesValue::find($item->service_item_id)->name : "",
                        'total_hours' => $totalSeconds
                    ];
                } else {
                    $items[] = [
                        'name' => ServicesValue::find($item->service_item_id) ? ServicesValue::find($item->service_item_id)->name : "",
                        'total_hours' => "0 hours"
                    ];
                }
            }
            // Record the details for the current day
            $daysInWeek[] = [
                'date' => $record->formatted_date,
                'start_time' => $record->start_time,
                'end_time' => $record->end_time,
                'total_hours_worked_on_day' => $record->total_hours_worked_on_day,
                'total_hours_worked_on_day_format' => $this->formatTime($record->total_hours_worked_on_day_format),
                'service_items' => $items,
                'service_name' => Service::find($record->service_id) ? Service::find($record->service_id)->name : ""

            ];

            // Update the total hours for the week
            $totalHoursInWeek += $record->total_hours_worked_on_day;
            $totalHoursInWeekFormat += $record->total_hours_worked_on_day_format;
        }

        // Add the last week
        if ($currentWeek !== null) {
            $result[] = [
                'week_number' => $currentWeek,
                'start_of_week' => (new DateTime())->setISODate($request->has('year') ? $request->year : date("Y"), $currentWeek, 1)->format('d-m-Y'),
                'end_of_week' => (new DateTime())->setISODate($request->has('year') ? $request->year : date("Y"), $currentWeek, 7)->format('d-m-Y'),

                'total_hours_in_week' => $totalHoursInWeek,
                'total_hours_in_week_format' => $this->formatime($totalHoursInWeekFormat),
                'avg_hours_in_week' => $this->formatime(intval($totalHoursInWeekFormat / count($daysInWeek))),
                'days' => $daysInWeek,
                'total_days_worked' => count($daysInWeek)

            ];
            $totalHours += $totalHoursInWeekFormat;
        }


        $total_days = 0;

        foreach ($result as $data) {
            $total_days += $data['total_days_worked'];
        }


        $data = [
            'data' => $member,
            'start_period' => $startPeriod,
            'end_period' => $endPeriod,

            'timesheet' => $result, 'total_hours' => $this->formatime($totalHoursInWeekFormat), 'total_days' => $total_days


        ];
        // dd($data['timesheet']);

        return view("admin.teams.timecard", $data);
    }
    function formatime($totalSeconds)
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

    function AddTeamMember()
    {
        $designation = Designation::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $state = State::orderBy('id', 'DESC')->get();

        $MaritalStatus = MaritalStatus::orderBy('id', 'DESC')->get();

        $city = City::orderBy('id', 'DESC')->take(1000)->get();
        $data = null;
        return view('admin.teams.edit', compact('designation', 'data', 'country', 'state', 'city',  'MaritalStatus'));
    }

    public function calender()
    {

        $arr = Service::has("members")->get();
        $services = [];
        foreach ($arr as $value) {
            $services[] = [

                'start' => Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d", strtotime($value->created_date)) . " " . $value->service_start_time),
                'title' => $value->name,
                'url' => route("services.edit", $value),


            ];
        }

        return view("admin.calender", compact('services'));
    }
    function clear_notifications()
    {
        DB::table("notifications")->where('user_id', 1)->update(['read' => 1]);
        return redirect()->back();
    }
}
