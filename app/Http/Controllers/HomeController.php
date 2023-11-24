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
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
        return view('admin.dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function clients()
    {
        $datas = Client::orderBy('id', 'DESC')->paginate(10);
        return view('admin.client', compact('datas'));
    }

    public function EditTeamMember($id)
    {
        $id = encryptDecrypt('decrypt', $id);
        $designation = Designation::orderBy('id','DESC')->get(); 
        $country = Country::orderBy('id','DESC')->get(); 
        $state = State::orderBy('id','DESC')->get(); 
        $city = City::orderBy('id','DESC')->get();
        $MaritalStatus = MaritalStatus::orderBy('id','DESC')->get();
        $data = User::where('userid', $id)->first();
        return view('admin.editteammember', compact('data','designation','country','state','city','data','MaritalStatus'));
    }

    public function SaveClient(Request $request)
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
            $user = Client::create([
                'email_address' =>$request->email_address,
                'name' => $request->first_name.' '.$request->last_name,
                'mobile_number' => $request->mobile_number,
                'address' => $request->address,
                'display_name' => $request->display_name,
                'company' => $request->company,
                'mobile_number' => $request->mobile_number,
                'home_number' => $request->home_number,
                'client_work_number' => $request->client_work_number,
                'designation_id' => $request->role,
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
            return redirect('client')->with('message', 'client created successfully');
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
            $Client = Client::where('id', $request->id)->first();
            $Client->email_address = $request->email_address;
            $Client->name = $request->first_name.' '.$request->last_name;
            $Client->mobile_number = $request->mobile_number;
            $Client->address = $request->address;
            $Client->display_name = $request->display_name;
            $Client->company = $request->company;
            $Client->home_number = $request->home_number;
            $Client->client_work_number = $request->client_work_number;
            $Client->designation_id = $request->role;
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
            return redirect('client')->with('success', 'Client updated successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }

    public function SaveTeamMember(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'resume' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'first_name' => 'required|string|max:255|min:1',
                'last_name' => 'required|string|max:255|min:1',
                'email' => 'required|email|unique:user',
                'phonenumber' => 'required|unique:user',
                'password' => ['required','min:8'],
                'c_password' => ['required','same:password','min:8'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->file('resume')) {
                $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $request->resume->extension();  
                $request->resume->move(public_path('upload/user-profile'), $imageName);
                $resume = $imageName;
                $resume_file_name = $request->resume->getClientOriginalName();
            }else{
                $resume = '';
                $resume_file_name = '';
            }
            $user = User::create([
                'fullname' => $request->first_name . ' ' . $request->last_name,
                'email' => strtolower($request->email),
                'address' => $request->address,
                'display_name' => $request->display_name,
                'company_name' => $request->company_name,
                'phonenumber' => $request->mobile_phone,
                'home_phone' => $request->home_phone,
                'work_phone' => $request->work_phone,
                'designation_id' => $request->role,
                'marital_status' => $request->marital_status,
                'DOB' => $request->dob,
                'ownertype' => $request->ownertype,
                'address_notes' => $request->address_notes,
                'contractor' => $request->contractor,
                'street' => $request->street,
                'unit' => $request->unit,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'resume' => $resume,
                'resume_file_name' => $resume_file_name,
                'password' => Hash::make($request->password),
                'status' => 0,
            ]);
            return redirect('teams-active')->with('success', 'Team member created successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
        }
    }
    
    public function add_member()
    {
        try {
            $designation = Designation::orderBy('id','DESC')->get(); 
            $country = Country::orderBy('id','DESC')->get(); 
            $state = State::orderBy('id','DESC')->get(); 
            $city = City::orderBy('id','DESC')->get(); 
            $MaritalStatus = MaritalStatus::orderBy('id','DESC')->get();
            return view('admin.newteammember',compact('designation','country','state','city','MaritalStatus'));
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
                $imageName = 'IMG_' . date('Ymd') . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $request->resume->extension();  
                $request->resume->move(public_path('upload/user-profile'), $imageName);
                $resume = $imageName;
                $resume_file_name = $request->resume->getClientOriginalName();
                User::where('userid',$request->userid)->update(['resume'=>$imageName,'resume_file_name'=>$resume_file_name]);
            }
            
            $user->fullname = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->display_name = $request->display_name;
            $user->company_name = $request->company_name;
            $user->phonenumber = $request->mobile_phone;
            $user->home_phone = $request->home_phone;
            $user->work_phone = $request->work_phone;
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
                User::where('userid',$request->userid)->update(['profile_image'=>$imageName]);
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
                // dd($request->all());
                $name = 'Services';

                $user = ServicesValue::create([
                    'name' => $request->name,
                    'price' => $request->price,
                    'status' => 1,
                ]);
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
            if (isset($request->search)) {
                $search = $request->search;
                $type = 1;
                $datas = User::where('status', 1)->where('userid', '!=', 1)
                    ->orwhere('fullname', 'like', '%' . $search . '%')
                    ->orwhere('email', 'like', '%' . $search . '%')
                    ->orwhere('userid', 'like', '%' . $search . '%')
                    ->orwhere('phonenumber', 'like', '%' . $search . '%')
                    ->orderBy('userid', 'DESC')->paginate(10);
                return view('admin.team', compact('datas', 'search', 'type'));
            } else {
                $search = '';
                $type = 1;
                $datas = User::where('status', 1)->where('userid', '!=', 1)->orderBy('userid', 'DESC')->paginate(10);
                return view('admin.team', compact('datas', 'search', 'type'));
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function team_inactive(Request $request)
    {
        try {
            if (isset($request->search)) {
                $search = $request->search;
                $type = 2;
                $datas = User::where('status', 2)->where('userid', '!=', 1)
                    ->orwhere('fullname', 'like', '%' . $search . '%')
                    ->orwhere('email', 'like', '%' . $search . '%')
                    ->orwhere('userid', 'like', '%' . $search . '%')
                    ->orwhere('phonenumber', 'like', '%' . $search . '%')
                    ->orderBy('userid', 'DESC')->paginate(10);
                return view('admin.team', compact('datas', 'search', 'type'));
            } else {
                $search = '';
                $type = 2;
                $datas = User::where('status', 2)->where('userid', '!=', 1)->orderBy('userid', 'DESC')->paginate(10);
                return view('admin.team', compact('datas', 'search', 'type'));
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
            return view('admin.team-detail', compact('data'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function approve_member($id)
    {
        try {
            $userid = encryptDecrypt('decrypt', $id);
            $data = User::where('userid', $userid)->update(['status' => 1]);
            return redirect('/teams-active')->with('success', 'Team member approved successfully');
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
            return view('admin.client-details', compact('data'));
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

    public function add_client()
    {
        try {
            $designation = Designation::orderBy('id','DESC')->get(); 
            $country = Country::orderBy('id','DESC')->get(); 
            $state = State::orderBy('id','DESC')->get(); 
            $city = City::orderBy('id','DESC')->get(); 
            $MaritalStatus = MaritalStatus::orderBy('id','DESC')->get();
            return view('admin.newclient',compact('designation','country','state','city','MaritalStatus'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
    
    public function EditClient($id)
    {
        try {
            $id = encryptDecrypt('decrypt', $id);
            $designation = Designation::orderBy('id','DESC')->get(); 
            $country = Country::orderBy('id','DESC')->get(); 
            $state = State::orderBy('id','DESC')->get(); 
            $city = City::orderBy('id','DESC')->get();
            $MaritalStatus = MaritalStatus::orderBy('id','DESC')->get();
            $data = Client::where('id', $id)->first();
            return view('admin.editclient',compact('designation','country','state','city','MaritalStatus','data'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}