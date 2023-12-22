@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Master')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/assets/admin-css/newteammeber.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Add New Team Members</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('SaveTeamMember') }}" method="POST" enctype="multipart/form-data" id="newteammember">
                    @csrf

                    <div class="create-service-form-box">
                        <h1>Members Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>First Name*</h3>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{ old('first_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Last Name</h3>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Email Address *</h3>
                                    <input type="text" class="form-control" name="email" placeholder="Email Address"
                                        value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Display Name *</h3>
                                    <input type="text" class="form-control" name="display_name" required
                                        value="{{ old('display_name') }}" placeholder="Display Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Company Name</h3>
                                    <input type="text" class="form-control" name="company_name"
                                        value="{{ old('company_name') }}" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Mobile phone*</h3>
                                    <input type="text" class="form-control" name="phonenumber"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('mobile_phone') }}" placeholder="Mobile phone" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Home phone</h3>
                                    <input type="text" class="form-control" name="home_phone"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('home_phone') }}" placeholder="Home phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Work phone</h3>
                                    <input type="text" class="form-control" name="work_phone"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('work_phone') }}" placeholder="Work phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Role *</h3>
                                    <select class="form-control" name="role" required>
                                        @foreach ($designation as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Maritial Status *</h3>
                                    <select class="form-control" name="marital_status">
                                        @foreach ($MaritalStatus as $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Date Of birth *</h3>
                                    <input type="date" class="form-control" name="dob" max="<?= date('Y-m-d') ?>"
                                        value="{{ old('dob') }}"required>
                                </div>
                            </div>

                            {{-- <div class="col-md-9">
                                <div class="form-group">
                                    <h3>Owner Type</h3>
                                    <ul class="Ownertype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" id="home_owner" value="home owner" name="ownertype">
                                                <label for="Home Owner" for="home_owner">Home Owner</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="ownertype" value="business" id="business">
                                                <label for="Business" for="business">Business</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>


                    <div class="create-service-form-box">
                        <h1>Address Info.</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address (additional addresses)</h3>
                                    <textarea type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Address"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address Notes</h3>
                                    <textarea type="text" class="form-control" name="address_notes" placeholder="Address Notes"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Contractor</h3>
                                    <input type="text" class="form-control" name="contractor"
                                        value="{{ old('contractor') }}" placeholder="contractor">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Street*</h3>
                                    <input type="text" class="form-control" name="street" required
                                        value="{{ old('street') }}"placeholder="Street">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Unit *</h3>
                                    <input type="text" class="form-control" name="unit" required
                                        value="{{ old('unit') }}"placeholder="Unit">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Country *</h3>
                                    <select class="form-control"name="country_id" onchange="getState(this.value)">
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
                                        <select class="form-control" name="state_id" onchange="getCity(this.value)">
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
                                    <h3>Zipcode *</h3>
                                    <input type="text" class="form-control" name="zipcode" placeholder="Zipcode">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Upload Resume**</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="product-images-upload">
                                    <div class="file-form-group">
                                        <input type="file" class="file-form-control" name="resume" required
                                            accept=".png, .jpeg, .pdf">
                                    </div>
                                </div>
                                <div class="product-images-head">
                                    <p>PNG, JPG and GIF are allowed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Account Password</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Create New Password</h3>
                                    <input type="password" class="form-control" name="password" placeholder="******"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Confirm Password</h3>
                                    <input type="password" class="form-control" name="c_password" placeholder="******"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-action">
                        <button class="cancelbtn">Cancel</button>
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
                }
            })
        });
    </script>
@endpush
