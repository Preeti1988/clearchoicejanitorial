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
    </style>
@endpush
@section('content')


    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Create Service</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('services.store') }}" method="POST" id="create-service">
                    @csrf
                    <input type="hidden" id="redirect_url" value="{{ route('services.index') }}">
                    <div class="create-service-form-box">
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Billed to</h3>
                                    <select class="form-control" name="assigned_member_id"
                                        onchange="fetchClient(this.value)" required>

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
                                    <input type="text" class="form-control" name="" id="name" />
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
                                    <input type="text" class="form-control" id="home_number" name="home_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client mobile number</h3>
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Client work number</h3>
                                    <input type="text" class="form-control" name="client_work_number"
                                        id="client_work_number" data-inputmask="'mask': '(999) 999-9999'"
                                        placeholder="(999) 999-9999" value="" />
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
                                    <input type="text" class="form-control" name="discount_amount"
                                        placeholder="0.00" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Due amount</h3>
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
                                    <h3>Service Frequency</h3>
                                    <select class="form-control" name="frequency" required>

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
                                    <h3>Service Name</h3>
                                    <input type="text" class="form-control" name="name" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service scheduled for</h3>
                                    <input type="text" class="form-control" name="scheduled_for" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service lead source</h3>
                                    <input type="text" class="form-control" name="lead_source" required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service source</h3>
                                    <input type="text" class="form-control" name="service_source" required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Revenue</h3>
                                    <input type="text" class="form-control" name="revenue" placeholder="0.00" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service created date</h3>
                                    <input type="date" class="form-control" name="created_date" required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Service scheduled end date
                                    </h3>
                                    <input type="date" class="form-control" name="scheduled_end_date" required />
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
                                    <h3>Service Shift Start Time</h3>
                                    <input type="time" class="form-control" name="service_start_time" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Shift End Time</h3>
                                    <input type="time" class="form-control" name="service_end_time" required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service Items</h3>
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
                                    <h3>Service Items value</h3>
                                    <input type="text" class="form-control" id="itemValue" placeholder="$10" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h3>Service Items Added</h3>
                                    <ul class="ServiceAdded-list">
                                        <li>
                                            No Items Added
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <h3>Service description</h3>
                                    <textarea type="text" class="form-control" name="description"></textarea>
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
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="labour_cost"
                                            placeholder="0.00" required />
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Labor cost % of rev</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="labour_cost_percent"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">

                                    <h3>Material cost</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="material_cost"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Material cost % of rev</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control " name="material_cost_percent"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Miscellaneous cost</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="miscellaneous_cost"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>
                                        Miscellaneous cost 5 of rev
                                    </h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control" name="" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Paid Amount</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="paid_amount"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Profit margin</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="profit_margin"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Service cost</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="service_cost"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="tax_amount"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tax rate</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="tax_rate"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Tip amount</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="tip_amount"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total duration</h3>
                                    <input type="text" class="form-control " name="total_duration" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Total service cost</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control cost" name="total_service_cost"
                                            required placeholder="0.00" />
                                    </div>
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
                                    <h1>In Scope</h1>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h3>In Scope Items</h3>
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
                                                    <li>
                                                        No Items Added
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h1>Out Of Scope</h1>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h3>Out Of Scope Items</h3>
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
                        <button class="Savebtn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

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
                $("#name").val(data.client.name);
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
            }, 'Invalid phone number.');
            $('#create-service').validate({
                rules: {
                    client_work_number: {
                        required: true,
                        phoneValid: true
                    },
                    mobile_number: {
                        required: true,
                        phoneValid: true
                    },
                    home_number: {
                        required: true,
                        phoneValid: true
                    },

                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass("text-danger");
                    element.closest(".field").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $('.please-wait').click();
                    $(element).addClass("text-danger");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("text-danger");
                },
                submitHandler: function(form, event) {

                    event.preventDefault();
                    let formData = new FormData(form);

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

                                return false;
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.statusText,
                                    'error'
                                );
                            }
                            return false;

                        }
                    });
                }
            })
        });
    </script>
@endsection
