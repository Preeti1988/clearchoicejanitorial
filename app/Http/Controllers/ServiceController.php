<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\InScope;
use App\Models\OutScope;
use App\Models\Service;
use App\Models\ServiceMember;
use App\Models\ServicesValue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        $completed = 0;
        $earning = 0;

        return view("admin.services.index", compact('services', 'completed', 'earning'));
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
        return view("admin.services.create", compact('clients', 'serviceValues', 'InScope', 'OutScope'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new Service();
        $service->name = $request->name;

        $service->assigned_member_id = $request->assigned_member_id;
        $service->discount_amount = $request->discount_amount;
        $service->due_amount = $request->due_amount;
        $service->gross_profit = $request->gross_profit;
        $service->frequency = $request->frequency;
        $service->scheduled_for = $request->scheduled_for;
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
        $service->save();
        return response()->json(['message' => 'Service Created Successfully', 'status' => 200]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
            $value->projects = $value->member->projects->count() . " projects";
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
        $services = Service::doesntHave("members")->get();
        return view("admin.services.scheduler", compact('services'));
    }
}
