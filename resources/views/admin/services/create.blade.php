@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/create-service.css') }}">
@endpush
@section('content')


    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Create Service</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf
                    <div class="create-service-form-box">
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Billed to</h3>
                                    <select class="form-control" name="assigned_member_id"
                                        onchange="fetchClient(this.value)">
                                        <option value="0">
                                            Select Client
                                        </option>
                                        @foreach ($clients as $item)
                                            <option value="{{ $item->id }}">
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
                                    <h3>Business unit</h3>
                                    <input type="text" class="form-control" name="" placeholder="Unit1" />
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
                                    <input type="text" class="form-control" name="" value=""
                                        id="address" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client name</h3>
                                    <input type="text" class="form-control" name="" id="name"
                                        value="Esther Howard" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Email</h3>
                                    <input type="text" class="form-control" name="" id="email"
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client Home Number</h3>
                                    <input type="text" class="form-control" id="home_number" name=""
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client mobile number</h3>
                                    <input type="text" class="form-control" name="" id="mobile_number"
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client work number</h3>
                                    <input type="text" class="form-control" name="" id="client_work_number"
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client lead source</h3>
                                    <input type="text" class="form-control" id="lead_source" name=""
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <h3>Client tags</h3>
                                    <input type="text" class="form-control" name="" value="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Discount amount</h3>
                                    <input type="text" class="form-control" name="" placeholder="$0.00" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Due amount</h3>
                                    <input type="text" class="form-control" name="" placeholder="$0.00" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Gross Profit</h3>
                                    <input type="text" class="form-control" name="" placeholder="$0.00" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Service</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Frequency</h3>
                                    <select class="form-control" name="frequency">
                                        <option>Select</option>
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
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service scheduled for</h3>
                                    <input type="text" class="form-control" name="scheduled_for" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service lead source</h3>
                                    <input type="text" class="form-control" name="lead_source" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service source</h3>
                                    <input type="text" class="form-control" name="service_source" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Revenue</h3>
                                    <input type="text" class="form-control" name="revenue" placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service created date</h3>
                                    <input type="date" class="form-control" name="created_date" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Service scheduled end date
                                    </h3>
                                    <input type="date" class="form-control" name="scheduled_end_date" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service duration</h3>
                                    <input type="time" class="form-control" name="service_duration" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Service travel duration</h3>
                                    <input type="time" class="form-control" name="travel_duration" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service tags</h3>
                                    <input type="text" class="form-control" name="service_tags" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service window</h3>
                                    <input type="text" class="form-control" name="service_window" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Service type</h3>
                                    <ul class="servicetype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="servicetype" value="Commercial"
                                                    id="commercial" />
                                                <label for="commercial">Commercial</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" value="Residential" name="servicetype"
                                                    id="residential" />
                                                <label for="residential">Residential</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Items</h3>
                                    <select class="form-control">
                                        <option>
                                            Select &amp; Add
                                        </option>
                                        <option selected="">
                                            Vacuum First
                                        </option>
                                        <option>Dusting</option>
                                        <option>
                                            Floor Cleaning
                                        </option>
                                        <option>
                                            Desk Cleaning
                                        </option>
                                        <option>Break Room</option>
                                        <option>
                                            Hollways Cleaning
                                        </option>
                                        <option>
                                            Escalator Cleaning
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Items value</h3>
                                    <input type="text" class="form-control" name="" value="$10.00" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h3>Service Items Added</h3>
                                    <ul class="ServiceAdded-list">
                                        <li>
                                            <div class="ServiceAddedcheckbox">
                                                <input type="checkbox" id="Vacuum First" />
                                                <label for="Vacuum First">
                                                    <span class="ServiceAddedcheckbox-circle-mark"></span>
                                                    <span class="ServiceAddedcheckbox-content">
                                                        <span class="ServiceAddedcheckbox-text">Vacuum
                                                            First</span>
                                                        <span class="ServiceAddedcheckbox-action"><a href="#"><img
                                                                    src="images/trash.svg" /></a>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ServiceAddedcheckbox">
                                                <input type="checkbox" id="Dusting" />
                                                <label for="Dusting">
                                                    <span class="ServiceAddedcheckbox-circle-mark"></span>
                                                    <span class="ServiceAddedcheckbox-content">
                                                        <span class="ServiceAddedcheckbox-text">Dusting</span>
                                                        <span class="ServiceAddedcheckbox-action"><a href="#"><img
                                                                    src="images/trash.svg" /></a>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <h3>Service description</h3>
                                    <textarea type="text" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Cost</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Labor cost</h3>
                                    <input type="text" class="form-control" name="labour_cost" placeholder="$0.00" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Labor cost % of rev</h3>
                                    <input type="text" class="form-control" name="labour_cost_percent"
                                        placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Material cost</h3>
                                    <input type="text" class="form-control" name="material_cost"
                                        placeholder="$0.00" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Material cost % of rev</h3>
                                    <input type="text" class="form-control" name="material_cost_percent"
                                        placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Miscellaneous cost</h3>
                                    <input type="text" class="form-control" name="miscellaneous_cost"
                                        placeholder="$0.00" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Miscellaneous cost 5 of rev
                                    </h3>
                                    <input type="text" class="form-control" name="" placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Paid Amount</h3>
                                    <input type="text" class="form-control" name="paid_amount" placeholder="$0.00" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Profit margin</h3>
                                    <input type="text" class="form-control" name="profit_margin"
                                        placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service cost</h3>
                                    <input type="text" class="form-control" name="service_cost"
                                        placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tax amount</h3>
                                    <input type="text" class="form-control" name="tax_amount" placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tax rate</h3>
                                    <input type="text" class="form-control" name="tax_rate" placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tip amount</h3>
                                    <input type="text" class="form-control" name="tip_amount" placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total duration</h3>
                                    <input type="text" class="form-control" name="total_duration" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total service cost</h3>
                                    <input type="text" class="form-control" name="total_service_cost"
                                        placeholder="$0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total labor hours</h3>
                                    <input type="text" class="form-control" name="total_labour_hours" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Total time on job by Team
                                    </h3>
                                    <input type="text" class="form-control" name="total_time" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Total travel time by Team
                                    </h3>
                                    <input type="text" class="form-control" name="travel_time_by_team" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Scope</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>In Scope</h3>
                                    <textarea type="text" class="form-control" placeholder="In Scope"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Out Of Scope</h3>
                                    <textarea type="text" class="form-control" placeholder="Out Of Scope"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-action">
                        <button class="cancelbtn">cancel</button>
                        <button class="Savebtn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function fetchClient(id) {
            $.get("{{ route('fetchClient') }}" + "?id=" + id, function(data) {

                console.log(data);
                $("#name").val(data.client.name);
                $("#email").val(data.client.email_address);

                $("#mobile_number").val(data.client.mobile_number);
                $("#home_number").val(data.client.home_number);
                $("#client_work_number").val(data.client.client_work_number);
                $("#name").val(data.client.name);
                $("#name").val(data.client.name);

            })
        }
    </script>
@endsection
