@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Master')
@push('css')
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-css/newteammeber.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>{{ $data ? 'Edit' : 'Add' }} Client</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ $data ? route('UpdateClient') : route('SaveClient') }}" method="POST"
                    enctype="multipart/form-data" id="newteammember">
                    @csrf
                    <div class="create-service-form-box">
                        <h1>Members Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>First Name *</h3>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{ $data ? $data->name : old('first_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Last Name*</h3>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{ old('last_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Email Address*</h3>
                                    <input type="email" class="form-control" name="email_address"
                                        placeholder="Email Address" value="{{ old('email_address') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Display Name*</h3>
                                    <input type="text" class="form-control" name="display_name"
                                        value="{{ old('display_name') }}" placeholder="Display Name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Company Name</h3>
                                    <input type="text" class="form-control" name="company" value="{{ old('company') }}"
                                        placeholder="Company Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Mobile phone*</h3>
                                    <input type="text" class="form-control" name="mobile_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('mobile_number') }}" placeholder="Mobile phone" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Home phone *</h3>
                                    <input type="text" class="form-control" name="home_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('home_number') }}" placeholder="Home phone" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Work phone*</h3>
                                    <input type="text" class="form-control" name="client_work_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('client_work_number') }}" placeholder="Work phone" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Role*</h3>
                                    <input type="text" class="form-control" name="role" placeholder="Role" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Owner Type *</h3>
                                    <ul class="Ownertype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="ownertype" checked value="home owner"
                                                    onchange="$('#business_checkbox').toggleClass('d-none')" id="homeowner">
                                                <label for="homeowner">Home Owner</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="ownertype"
                                                    onchange="$('#business_checkbox').toggleClass('d-none')"
                                                    value="Business" id="Business">
                                                <label for="Business">Business</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 d-none" id="business_checkbox">
                                <div class="form-group">
                                    <h3 style="opacity: 0">Owner Type</h3>
                                    <div class="ccjcheckbox">
                                        <input type="checkbox" name="" readonly checked>
                                        <label>We subcontract for this general contractor</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="create-service-form-box">
                        <h1>Address Info.</h1>
                        <div class="row">

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Contractor</h3>
                                    <input type="text" class="form-control" name="contractor"
                                        value="{{ old('contractor') }}" placeholder="Contractor">
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Street*</h3>
                                    <input type="text" class="form-control" name="street" required
                                        value="{{ old('street') }}"placeholder="Street">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Unit</h3>
                                    <input type="text" class="form-control" name="unit"
                                        value="{{ old('unit') }}"placeholder="Unit">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Country*</h3>
                                    <select class="form-control"name="country_id" onchange="getState(this.value)"
                                        required>
                                        <option value="0">--Select--</option>
                                        @foreach ($country as $crty)
                                            <option value="{{ $crty->id }}">{{ $crty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>State*</h3>
                                    <div id="state_container">
                                        <select class="form-control" name="state_id" onchange="getCity(this.value)"
                                            required>
                                            <option value="0">--Select--</option>
                                            @foreach ($state as $stat)
                                                <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>City*</h3>
                                    <div id="city_container">
                                        <select class="form-control" name="city">
                                            <option value="0">--Select--</option>
                                            @foreach ($city as $cty)
                                                <option value="{{ $cty->id }}">{{ $cty->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Zipcode*</h3>
                                    <input type="text" class="form-control" name="zipcode" placeholder="Zipcode"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address Notes</h3>
                                    <textarea type="text" class="form-control" name="address_notes" placeholder="Address Notes"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address (additional addresses)</h3>
                                    <textarea type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Address"></textarea>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="create-service-form-box">
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Notes*</h3>
                                    <input type="text" class="form-control" name="client_notes" required
                                        value="{{ old('client_notes') }}" placeholder="Notes">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Tags*</h3>
                                    <input type="text" class="form-control" name="client_tags" required
                                        value="{{ old('client_tags') }}" placeholder="Tags">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>This Client bill's to*</h3>
                                    <input type="text" class="form-control" name="client_bills_to"
                                        value="{{ old('client_bills_to') }}" placeholder="This Client bill's to"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Lead Source* </h3>
                                    <input type="text" class="form-control" name="lead_source"
                                        value="{{ old('lead_source') }}" placeholder="Lead Resource" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Send Notification</h3>
                                    <div class="ccjcheckbox">
                                        <input type="checkbox" name="" id="Home Owner">
                                        <label for="Home Owner">send notifications to a client</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-action">
                        <button class="cancelbtn" type="button"
                            onclick="location.replace('route('Clients')')">Cancel</button>
                        <button class="Savebtn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function getState(id) {
            $.get("{{ route('getState') }}" + '?id=' + id, function(data) {
                htm = "";
                htm += `<select class="form-control" name="state_id" onchange="getCity(this.value)">`;
                if (data.length == 0) {
                    htm += `<option >No records</option>`;
                }
                data.map(item => {
                    htm += ` <option value="${item.id}">${item.name}</option> `;
                })
                htm += `</select>`;
                $("#state_container").html(htm);
            })
        }

        function getCity(id) {
            $.get("{{ route('getCity') }}" + '?id=' + id, function(data) {
                htm = "";
                htm += `<select class="form-control" name="city" >`;
                if (data.length == 0) {
                    htm += `<option >No records</option>`;
                }
                data.map(item => {
                    htm += ` <option value="${item.id}">${item.name}</option> `;
                })
                htm += `</select>`;
                $("#city_container").html(htm);
            })
        }
        $(document).ready(function() {
            $.validator.addMethod("phoneValid", function(value) {
                return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(value);
            }, 'Invalid phone number.');
            $.validator.addMethod("zeroValue", function(value) {
                return value != 0;
            }, 'Please select .');
            $('#newteammember').validate({
                rules: {
                    phonenumber: {
                        required: true,
                        phoneValid: true
                    },
                    home_phone: {
                        required: true,
                        phoneValid: true
                    },
                    work_phone: {
                        required: true,
                        phoneValid: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    c_password: {
                        required: true,
                        minlength: 8
                    },
                    country_id: {
                        required: true,
                        zeroValue: true
                    },
                    state_id: {
                        required: true,
                        zeroValue: true
                    },

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
                }
            })
        });
    </script>
@endpush
