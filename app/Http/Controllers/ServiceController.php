<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\InScope;
use App\Models\OutScope;
use App\Models\Service;
use App\Models\ServiceMember;
use App\Models\ServicesValue;
use App\Traits\NotificationTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ServiceController extends Controller
{
    use NotificationTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::has("members");
        if (request()->has('date')) {
            $services = $services->whereDate("created_date", Carbon::parse(request('date')));
        }
        if (request()->has('search')) {
            $services = $services->where("name", request('search'));
        }
        $services = $services->where("status", "ongoing")->orderBy("id", "desc")->get();

        $completed_services = Service::where("status", "completed");
        if (request()->has('date')) {
            $completed_services = $completed_services->whereDate("created_date", Carbon::parse(request('date')));
        }
        if (request()->has('search')) {
            $completed_services = $completed_services->where("name", request('search'));
        }
        $completed_services = $completed_services->orderBy("id", "desc")->get();
        $completed =  Service::where("status", 'completed')->count();
        $earning = Service::where("status", 'completed')->sum("total_service_cost");

        return view("admin.services.index", compact('services', 'completed', "completed_services", 'earning'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $serviceValues = ServicesValue::all();
        $InScope = InScope::whereNotNull('status')->orderBy('id', 'desc')->get();
        $OutScope = OutScope::whereNotNull('status')->orderBy('id', 'desc')->get();
        $scopes = [];
        $service = null;
        return view("admin.services.create", compact('clients', 'serviceValues', 'InScope', 'OutScope', 'service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $service = new Service();
        $service->name = $request->name;

        $service->assigned_client_id = $request->assigned_client_id;
        $service->discount_amount = $request->discount_amount;
        $service->due_amount = $request->due_amount;
        $service->gross_profit = $request->gross_profit;
        $service->frequency = $request->frequency;
        $service->scheduled_for = $request->scheduled_for;
        $service->scheduled_end_date = $request->scheduled_end_date;

        $service->lead_source = $request->lead_source;
        $service->service_source = $request->service_source;
        $service->revenue = $request->revenue;
        $service->created_date = $request->created_date;
        $service->service_duration = $request->service_duration;
        $service->travel_duration = $request->travel_duration;

        $service->service_tags = $request->service_tags;
        $service->service_window = $request->service_window;
        $service->service_type = $request->servicetype;
        $service->description = $request->description;

        $service->status = "ongoing";
        $service->labour_cost = $request->labour_cost;
        $service->labour_cost_percent = $request->labour_cost_percent;
        $service->material_cost = $request->material_cost;
        $service->material_cost_percent = $request->material_cost_percent;
        $service->miscellaneous_cost = $request->miscellaneous_cost;
        $service->paid_amount = $request->paid_amount;
        $service->profit_margin = $request->profit_margin;
        $service->service_cost = $request->service_cost;
        $service->tax_amount = $request->tax_amount;
        $service->tax_rate = $request->tax_rate;
        $service->tip_amount = $request->tip_amount;
        $service->total_duration = $request->total_duration;
        $service->total_service_cost = $request->total_service_cost;
        $service->total_labour_hours = $request->total_labour_hours;
        $service->total_time = $request->total_time;
        $service->tax_amount = $request->tax_amount;
        $service->service_start_time = $request->service_start_time;
        $service->service_end_time = $request->service_end_time;
        $service->inscopes = json_encode(json_decode($request->inscopes, true));
        $service->outscopes =  json_encode(json_decode($request->outscopes, true));
        $service->service_items =  json_encode(json_decode($request->service_items, true));


        $service->service_address = $request->service_address;
        $service->service_latlng = $request->service_latlng;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = uniqid() . "." . $file->getClientOriginalExtension();
            $service->image = $image;
            $file->move(public_path('upload/services'), $image);
        }
        if ($request->has('image')) {
            $service->image = $request->image;
        }
        $service->save();
        return response()->json(['message' => 'Service Created Successfully', 'status' => 200]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::find($id);
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $clients = Client::all();
        $serviceValues = ServicesValue::all();
        $InScope = InScope::whereNotNull('status')->orderBy('id', 'desc')->get();
        $OutScope = OutScope::whereNotNull('status')->orderBy('id', 'desc')->get();
        $scopes = [];
        $service = Service::find($id);
        return view("admin.services.create", compact('clients', 'serviceValues', 'InScope', 'OutScope', 'service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $service =  Service::find($id);
        $service->name = $request->name;

        $service->assigned_client_id = $request->assigned_client_id;
        $service->discount_amount = $request->discount_amount;
        $service->due_amount = $request->due_amount;
        $service->gross_profit = $request->gross_profit;
        $service->frequency = $request->frequency;
        $service->scheduled_for = $request->scheduled_for;
        $service->scheduled_end_date = $request->scheduled_end_date;

        $service->lead_source = $request->lead_source;
        $service->service_source = $request->service_source;
        $service->revenue = $request->revenue;
        $service->created_date = $request->created_date;
        $service->service_duration = $request->service_duration;
        $service->travel_duration = $request->travel_duration;

        $service->service_tags = $request->service_tags;
        $service->service_window = $request->service_window;
        $service->service_type = $request->servicetype;
        $service->description = $request->description;

        $service->status = "ongoing";
        $service->labour_cost = $request->labour_cost;
        $service->labour_cost_percent = $request->labour_cost_percent;
        $service->material_cost = $request->material_cost;
        $service->material_cost_percent = $request->material_cost_percent;
        $service->miscellaneous_cost = $request->miscellaneous_cost;
        $service->paid_amount = $request->paid_amount;
        $service->profit_margin = $request->profit_margin;
        $service->service_cost = $request->service_cost;
        $service->tax_amount = $request->tax_amount;
        $service->tax_rate = $request->tax_rate;
        $service->tip_amount = $request->tip_amount;
        $service->total_duration = $request->total_duration;
        $service->total_service_cost = $request->total_service_cost;
        $service->total_labour_hours = $request->total_labour_hours;
        $service->total_time = $request->total_time;
        $service->tax_amount = $request->tax_amount;
        $service->service_start_time = $request->service_start_time;
        $service->service_end_time = $request->service_end_time;
        $service->inscopes = json_encode(json_decode($request->inscopes, true));
        $service->outscopes =  json_encode(json_decode($request->outscopes, true));
        $service->service_items =  json_encode(json_decode($request->service_items, true));

        $service->service_address = $request->service_address;
        $service->service_latlng = $request->service_latlng;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = uniqid() . "." . $file->getClientOriginalExtension();
            $service->image = $image;
            $file->move(public_path('upload/services'), $image);
        }
        if ($request->has('image')) {
            $service->image = $request->image;
        }
        $service->save();
        return response()->json(['message' => 'Service updated Successfully', 'status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function assignMember($id)
    {
        $service = Service::find($id);
        foreach ($service->members as  $value) {
            $value->fullname = $value->member->fullname;
            $value->projects = $value->member->projects ? $value->member->projects->count() . " projects" : "0 projects";
        }
        return view('admin.services.assign', compact('service'));
    }

    public function assignMemberPost(Request $request)
    {
        $members = json_decode($request->assigned);
        $sst = null;
        $set = null;
        $existing_member = [];
        foreach ($members as  $item) {
            $serviceMember = new ServiceMember();
            $exists = ServiceMember::where("member_id", $item->id)->where("service_id", $request->service_id)->count();
            if ($exists) {
                $serviceMember = ServiceMember::where("member_id", $item->id)->where("service_id", $request->service_id)->first();
            } else {
                $data = [
                    'user_id' => $item->id,
                    'title' => 'Assigned to new service',
                    'details' => 'You are assigned to ' .  Service::find($request->service_id)->name,
                    'device_key' => null,
                ];
                $this->sendNotification($data);
            }

            $serviceMember->shift_start_time = $item->shift_start_time;
            $serviceMember->shift_end_time = $item->shift_end_time;
            $serviceMember->member_id = $item->id;
            $serviceMember->service_id = $request->service_id;
            $serviceMember->save();
            $existing_member[] = $item->id;
        }

        $deleteRepose =  ServiceMember::where("service_id", $request->service_id)->whereNOtIn("member_id", $existing_member)->delete();

        return response()->json(['message' => 'Member  Assigned  Successfully', 'status' => 200]);
    }
    public function serviceScheduler()
    {
        $services = Service::doesntHave("members");
        if (request()->has('date')) {
            $services = $services->whereDate("created_date", Carbon::parse(request('date')));
        }
        if (request()->has('search')) {
            $services = $services->where("name", "LIKE", "%" . trim(request('search')) . "%");
        }
        $services = $services->orderBy("id", "desc")->get();
        return view("admin.services.scheduler", compact('services'));
    }
}