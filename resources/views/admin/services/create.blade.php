@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/create-service.css') }}">
    <style>
        .dollar-sign::before {
            content: "$";
            position: absolute;
            margin-left: 1px;
            background: rgb(237, 233, 233);
            width: 20px;

            padding: 10px 5px;
            font-weight: normal;
            color: #000;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;

            /* Adjust the margin as needed */
        }

        .dollar-sign input {
            padding-left: 25px !important;
            /* Adjust the padding to make space for  the dollar sign */
        }

        .per-sign::before {
            content: "%";
            position: absolute;
            margin-left: 1px;
            background: rgb(237, 233, 233);
            width: 20px;

            padding: 10px 5px;
            font-weight: normal;
            color: #000;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;

            /* Adjust the margin as needed */
        }

        .per-sign input {
            padding-left: 25px !important;
            /* Adjust the padding to make space for  the dollar sign */
        }

        .screen {
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            color: white;
            display: flex;

        }

        .screen h2 {
            margin: auto;

        }

        .invalid-feedback {
            margin-top: 0px !important;
        }
    </style>
@endpush
@section('content')


    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>{{ $service ? 'Edit' : 'Create' }} Service</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ $service ? route('services.update', $service) : route('services.store') }}" method="POST"
                    id="create-service">
                    @csrf
                    @if ($service)
                        @method('PUT')
                    @endif
                    @if ($service)
                        <input type="hidden" id="redirect_url" value="{{ route('services.edit', $service) }}">
                    @else
                        <input type="hidden" id="redirect_url" value="{{ route('services.index') }}">
                    @endif

                    <div class="create-service-form-box">
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Billed to * </h3>
                                    <select class="form-control" name="assigned_client_id"
                                        onchange="fetchClient(this.value)">
                                        <option value="0">
                                            Select Client
                                        </option>
                                        @foreach ($clients as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($service && $service->assigned_client_id == $item->id) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Business Unit</h3>
                                    <input type="text" class="form-control" name= "" placeholder="Unit1" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Callback</h3>
                                    <input type="text" class="form-control" name="" value=""
                                        id="callback" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Business</h3>
                                    <input type="text" class="form-control" name="" value=""
                                        id="business" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Address</h3>
                                    <input type="text" class="form-control"
                                        value="{{ $service && $service->client ? $service->client->address : '' }}"
                                        name="" value="" id="address" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Name</h3>
                                    <input type="text" class="form-control"
                                        value="{{ $service && $service->client ? $service->client->name : '' }}"
                                        name="" id="name" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Email</h3>
                                    <input type="text" class="form-control" name="" id="email"
                                        value="{{ $service && $service->client ? $service->client->email_address : '' }}" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Home Number *</h3>
                                    <input type="text" class="form-control" id="home_number" name="home_number"
                                        value="{{ $service && $service->client ? $service->client->home_number : '' }}"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Mobile Number *</h3>
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                                        value="{{ $service && $service->client ? $service->client->mobile_number : '' }}"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Work Number *</h3>
                                    <input type="text" class="form-control" name="client_work_number"
                                        id="client_work_number" data-inputmask="'mask': '(999) 999-9999'"
                                        placeholder="(999) 999-9999" value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Lead Source</h3>
                                    <input type="text" class="form-control" id="lead_source" name=""
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <h3>Client Tags</h3>
                                    <input type="text" class="form-control" name="" value="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Discount Amount</h3>
                                    <input type="text" class="form-control" name="discount_amount"
                                        placeholder="0.00" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Due Amount</h3>
                                    <input type="text" class="form-control" name="due_amount" placeholder="0.00" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Gross Profit</h3>
                                    <input type="text" class="form-control" name="gross_profit" placeholder="0.00" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Service</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Frequency *</h3>
                                    <select class="form-control" name="frequency" id="frequency" required>

                                        <option>7 x Weekly</option>
                                        <option>2 x Weekly</option>
                                        <option>Monthly</option>
                                        <option>Quarterly</option>
                                        <option>Annually</option>
                                        <option>
                                            2 x Annually
                                        </option>
                                        <option>One Time</option>
                                    </select>
                                    @if ($service)
                                        <script>
                                            $("#frequency").val("{{ $service->frequency }}")
                                        </script>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Name *</h3>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $service ? $service->name : '' }}" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service scheduled for *</h3>
                                    <input type="text" class="form-control" name="scheduled_for"
                                        value="{{ $service ? $service->scheduled_for : '' }}" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Lead Source *</h3>
                                    <input type="text" class="form-control" name="lead_source"
                                        value="{{ $service ? $service->lead_source : '' }}" required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Source *</h3>
                                    <input type="text" class="form-control"
                                        value="{{ $service ? $service->service_source : '' }}" name="service_source"
                                        required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Revenue *</h3>
                                    <input type="text" class="form-control"
                                        value="{{ $service ? $service->revenue : '' }}" name="revenue"
                                        placeholder="0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Start Date *</h3>
                                    <input type="date" class="form-control" min="<?= date('Y-m-d') ?>"
                                        name="created_date" value="{{ $service ? $service->created_date : '' }}"
                                        required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Service Scheduled End Date *
                                    </h3>
                                    <input type="date" class="form-control" name="scheduled_end_date"
                                        value="{{ $service ? $service->scheduled_end_date : '' }}"
                                        min="<?= date('Y-m-d') ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Service Type *</h3>
                                    <ul class="servicetype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="servicetype" checked value="Commercial"
                                                    required id="commercial" />
                                                <label for="commercial">Commercial</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" value="Residential" name="servicetype" required
                                                    id="residential" />
                                                <label for="residential">Residential</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Shift Start Time *</h3>
                                    <input type="time" class="form-control" id="startTime" name="service_start_time"
                                        value="{{ $service ? $service->service_start_time : '' }}" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Shift End Time *</h3>
                                    <input type="time" class="form-control" id="endTime"
                                        onchange="calculateTimeDifference(this.value)" name="service_end_time"
                                        value="{{ $service ? $service->service_end_time : '' }}" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Duration (In Hours) *</h3>
                                    <input type="text" class="form-control" id="result" name="service_duration"
                                        value="{{ $service ? $service->service_duration : '' }}" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Travel Duration (In Hours) *</h3>
                                    <input type="time" class="form-control" name="travel_duration"
                                        value="{{ $service ? $service->travel_duration : '' }}" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Tags</h3>
                                    <input type="text" class="form-control" name="service_tags"
                                        value="{{ $service ? $service->service_tags : '' }}" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Service Window</h3>
                                    <input type="text" class="form-control" name="service_window"
                                        value="{{ $service ? $service->service_window : '' }}" />
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Items *</h3>
                                    <select class="form-control" onchange="AddServiceItem(this.value)">
                                        <option>
                                            Select &amp; Add
                                        </option>
                                        @foreach ($serviceValues as $item)
                                            <option value="{{ json_encode($item) }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Items value *</h3>
                                    <input type="text" class="form-control" id="itemValue" placeholder="$10" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h3>Service Items Added *</h3>
                                    <ul class="ServiceAdded-list">
                                        <li>
                                            No Items Added
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <h3>Service Description *</h3>
                                    <textarea type="text" required class="form-control" name="description">{{ $service ? $service->description : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Cost</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Labor Cost *</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="labour_cost"
                                            value="{{ $service ? $service->labour_cost : '' }}" placeholder="0.00"
                                            required />
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Labor Cost % Of Revenue</h3>
                                    <div class="per-sign">
                                        <input type="text" class="form-control cost" name="labour_cost_percent"
                                            value="{{ $service ? $service->labour_cost_percent : '' }}"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">

                                    <h3>Material Cost</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="material_cost"
                                            value="{{ $service ? $service->material_cost : '' }}" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Material Cost % Of Revenue</h3>
                                    <div class="per-sign">
                                        <input type="text" class="form-control " name="material_cost_percent"
                                            value="{{ $service ? $service->material_cost_percent : '' }}"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Miscellaneous Cost</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="miscellaneous_cost"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Miscellaneous Cost % Of Revenue
                                    </h3>
                                    <div class="per-sign">
                                        <input type="text" class="form-control" name="" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Paid Amount</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="paid_amount"
                                            value="{{ $service ? $service->paid_amount : '' }}" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Profit Margin</h3>
                                    <div class="per-sign">
                                        <input type="text" class="form-control cost" name="profit_margin"
                                            value="{{ $service ? $service->profit_margin : '' }}" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Cost *</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="service_cost"
                                            value="{{ $service ? $service->service_cost : '' }}"
                                            value="{{ $service ? $service->service_cost : '' }}" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tax Rate</h3>
                                    <div class="per-sign">
                                        <input type="text" class="form-control cost" name="tax_rate"
                                            value="{{ $service ? $service->tax_rate : '' }}" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tax Amount</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="tax_amount"
                                            value="{{ $service ? $service->tax_amount : '' }}" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tip Amount</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="tip_amount"
                                            value="{{ $service ? $service->tip_amount : '' }}" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total Duration (In Hours) </h3>
                                    <input type="text" class="form-control " name="total_duration"
                                        value="{{ $service ? $service->total_duration : '' }}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total Service Cost *</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="total_service_cost"
                                            value="{{ $service ? $service->total_service_cost : '' }}" required
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total Labor Hours</h3>
                                    <input type="text" class="form-control" name="total_labour_hours"
                                        value="{{ $service ? $service->total_labour_hours : '' }}" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Total Time on Job by Team
                                    </h3>
                                    <input type="text" class="form-control" name="total_time"
                                        value="{{ $service ? $service->total_time : '' }}" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Total travel Time By Team
                                    </h3>
                                    <input type="text" class="form-control" name="travel_time_by_team"
                                        value="{{ $service ? $service->travel_time_by_team : '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Scope</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h1>In Scope</h1>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h3>In Scope Items *</h3>
                                                <select class="form-control" onchange="AddInScopeItem(this.value)">
                                                    <option>
                                                        Select &amp; Add
                                                    </option>
                                                    @foreach ($InScope as $item)
                                                        <option value="{{ json_encode($item) }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h3>Service Items Added</h3>
                                                <ul class="InScopeAdded-list">
                                                    @if ($service)
                                                        @if (json_decode($service->service_items))
                                                            @foreach (json_decode($service->service_items) as $item)
                                                                <li>{{ $item->name }}</li>
                                                            @endforeach
                                                        @else
                                                            <li>
                                                                No Items Added
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li>
                                                            No Items Added
                                                        </li>
                                                    @endif


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h1>Out Of Scope</h1>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h3>Out Of Scope Items *</h3>
                                                <select class="form-control" onchange="AddOutScopeItem(this.value)">
                                                    <option>
                                                        Select &amp; Add
                                                    </option>
                                                    @foreach ($OutScope as $item)
                                                        <option value="{{ json_encode($item) }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h3>Out Of Scope Added</h3>
                                                <ul class="OutScopeAdded-list">
                                                    <li>
                                                        No Items Added
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-action">
                        <button class="cancelbtn"
                            onclick="location.replace('{{ route('services.index') }}')">Cancel</button>
                        <button class="Savebtn" type="submit"> {{ $service ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <div class="screen">
        <h2>Loading...</h2>
    </div>
    <script>
        $(":input").inputmask();
        var items = [];
        var ISitems = [];
        var OSitems = [];

        function fetchClient(id) {
            $.get("{{ route('fetchClient') }}" + "?id=" + id, function(data) {

                console.log(data);
                $("#name").val(data.client.name);
                $("#email").val(data.client.email_address);

                $("#mobile_number").val(data.client.mobile_number);
                $("#home_number").val(data.client.home_number);
                $("#client_work_number").val(data.client.client_work_number);
                $("#lead_source").val(data.client.lead_source);
                $("#name").val(data.client.name);

            })
        }

        function AddServiceItem(val) {
            var value = JSON.parse(val);

            var exists = false;
            for (var i = 0; i < items.length; i++) {
                if (items[i].id === value.id) {
                    exists = true;
                    break;
                }
            }
            if (!exists) {
                items.push(value);
                $("#itemValue").val('$' + value.price)
                renderItem('service');
            }

        }

        function AddInScopeItem(val) {
            if (val) {
                var value = JSON.parse(val);

                var exists = false;
                for (var i = 0; i < ISitems.length; i++) {
                    if (ISitems[i].id === value.id) {
                        exists = true;
                        break;
                    }
                }
                if (!exists) {
                    ISitems.push(value);

                    renderItem('inscope');
                }
            }


        }

        function AddOutScopeItem(val) {
            if (val) {
                var value = JSON.parse(val);

                var exists = false;
                for (var i = 0; i < OSitems.length; i++) {
                    if (OSitems[i].id === value.id) {
                        exists = true;
                        break;
                    }
                }
                if (!exists) {
                    OSitems.push(value);

                    renderItem('outscope');
                }

            }

        }

        function renderItem(val) {

            var htm = '';

            var tempItems = items;
            if (val == 'service') {
                tempItems = items;

            } else if (val == 'inscope') {
                tempItems = ISitems;

            } else {
                tempItems = OSitems;

            }
            if (tempItems.length == 0) {
                htm += '<li>No Items Added</li>';
            }

            tempItems.map(item => {
                htm += ` <li><div class="ServiceAddedcheckbox">
                                                <input type="checkbox" id="${item.name}" />
                                                <label for="${item.name}">
                                                    <span class="ServiceAddedcheckbox-circle-mark"></span>
                                                    <span class="ServiceAddedcheckbox-content">
                                                        <span class="ServiceAddedcheckbox-text">${item.name}</span>
                                                        <span class="ServiceAddedcheckbox-action"  style="z-index:12"  onclick="removeItem(${item.id},'${val}')"><a href="#" ><img
                                                                    src="{{ asset('public/assets/admin-images/trash.svg') }}" /></a>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </li>`;
            })
            if (val == 'service') {
                $(".ServiceAdded-list").html(htm);

            } else if (val == 'inscope') {
                $(".InScopeAdded-list").html(htm);

            } else {
                $(".OutScopeAdded-list").html(htm);

            }
        }

        function removeItem(id, val) {
            console.log(id);
            if (val == 'service') {
                items = items.filter(item => item.id != id);
            } else if (val == 'inscope') {
                ISitems = ISitems.filter(item => item.id != id);
            } else {
                OSitems = OSitems.filter(item => item.id != id);
            }

            renderItem(val);

        }
        $(document).ready(function() {
            $.validator.addMethod("phoneValid", function(value) {
                return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(value);
            }, 'Invalid phone Number.');
            $.validator.addMethod("integerValue", function(value) {
                return value != 0;
            }, 'Invalid phone Number.');
            $('#create-service').validate({
                rules: {

                    mobile_number: {
                        required: true,
                        phoneValid: true
                    },
                    client_work_number: {
                        required: true,
                        phoneValid: true
                    },
                    home_number: {
                        required: true,
                        phoneValid: true
                    },
                    assigned_client_id: {
                        required: true,
                        integerValue: true
                    }


                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    element.addClass("invalid-feedback");
                    element.closest(".field").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $('.please-wait').click();
                    $(element).addClass("invalid-feedback");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("invalid-feedback");
                },
                submitHandler: function(form, event) {
                    $(".screen").show()
                    event.preventDefault();
                    let formData = new FormData(form);
                    if (items.length == 0) {

                        Swal.fire("Error", "Please select atleast one service item", 'error');
                        return false;
                    }
                    if (ISitems.length == 0) {

                        Swal.fire("Error", "Please select atleast one inscope item", 'error');

                        return false;
                    }
                    if (OSitems.length == 0) {

                        Swal.fire("Error", "Please select atleast one outscope item", 'error');

                        return false;
                    }
                    formData.append('service_items', JSON.stringify(items));
                    formData.append('inscopes', JSON.stringify(ISitems));
                    formData.append('outscopes', JSON.stringify(OSitems));
                    $.ajax({
                        type: 'post',
                        url: form.action,
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == 200) {

                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                }).then((result) => {

                                    var url = $('#redirect_url').val();
                                    if (url !== undefined || url != null) {
                                        window.location = url;
                                    } else {
                                        location.reload(true);
                                    }
                                })
                                return false;
                            }
                            if (response.status == 201) {
                                Swal.fire(
                                    'Error',
                                    response.message,
                                    'error'
                                );
                                $(".screen").hide()
                                return false;
                            }

                        },
                        error: function(data) {
                            if (data.status == 422) {
                                var form = $("#product_form");
                                let li_htm = '';
                                $.each(data.responseJSON.errors, function(k, v) {
                                    const $input = form.find(
                                        `input[name=${k}],select[name=${k}],textarea[name=${k}]`
                                    );
                                    if ($input.next('small').length) {
                                        $input.next('small').html(v);
                                        if (k == 'services' || k == 'membership') {
                                            $('#myselect').next('small').html(v);
                                        }
                                    } else {
                                        $input.after(
                                            `<small class='text-danger'>${v}</small>`
                                        );
                                        if (k == 'services' || k == 'membership') {
                                            $('#myselect').after(
                                                `<small class='text-danger'>${v[0]}</small>`
                                            );
                                        }
                                    }
                                    li_htm += `<li>${v}</li>`;
                                });
                                $(".screen").hide()
                                return false;
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.statusText,
                                    'error'
                                );
                            }
                            $(".screen").hide()
                            return false;

                        }
                    });
                }
            })
        });

        function calculateTimeDifference() {
            // Get the values of start and end time input fields
            // var startTime = document.getElementById("startTime").value;
            // var endTime = document.getElementById("endTime").value;
            // if (startTime != "" && endTime != "") {
            //     var startDate = new Date("1970-01-01T" + startTime + "Z");
            //     var endDate = new Date("1970-01-01T" + endTime + "Z");

            //     // Calculate the time difference in milliseconds
            //     var timeDifference = endDate - startDate;

            //     // Convert the time difference to hours
            //     var hoursDifference = timeDifference / (1000 * 60 * 60);

            //     // Display the result
            //     document.getElementById("result").value = hoursDifference.toFixed(2);
            // }
            // Convert the time strings to Date objects 
            function split(time) {
                var t = time.split(":");
                return parseInt((t[0] * 60), 10) + parseInt(t[1], 10); //convert to minutes and add minutes

            }

            //value start
            var start = split($("input#startTime").val()); //format HH:MM

            //value end
            var end = split($("input#endTime").val()); //format HH:MM

            totalHours = NaN;
            if (start < end) {
                totalHours = Math.floor((end - start) / 60);
            }

            $("#result").val(totalHours);
        }
    </script>
@endsection
