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

    public function SaveClient(Request $request)
    {
        try {
            $user = Client::create([
                'email_address' => strtolower($request->email),
                'address' => strtolower($request->address),
                'name' => $request->name,
                'mobile_number' => $request->mobile_number,
                'status' => 1,
            ]);
            return redirect('client')->with('message', 'client created successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Exception => ' . $e->getMessage()]);
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
            return redirect('/teams-active')->with('success', 'Status changed successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function reject_member($id)
    {
        try {
            $userid = encryptDecrypt('decrypt', $id);
            $data = User::where('userid', $userid)->update(['status' => 2]);
            return redirect('/teams-inactive')->with('success', 'Status changed successfully');
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
        return view('admin.create_schedular');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function master()
    {
        try {
            $InScope = InScope::where('status', 1)->orderBy('id', 'desc')->get();
            $OutScope = OutScope::where('status', 1)->orderBy('id', 'desc')->get();
            $ServicesValue = ServicesValue::orderBy('id', 'desc')->get();
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

    public function add_member()
    {
        try {
            return view('admin.newteammember');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function add_client()
    {
        try {
            return view('admin.newclient');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
