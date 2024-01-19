@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Edit Team Member')
@push('css')
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-css/newteammeber.css') }}">
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
                <h3>Edit Team Members</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('UpdateTeamMember') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userid" value="{{ $data->userid ?? '' }}">
                    <div class="create-service-form-box">
                        <h1>Members Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $arr = [];
                                    $arr = explode(' ', ucwords($data->fullname), 2); ?>
                                    <h3>First Name *</h3>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{ $arr[0] ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Last Name </h3>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{ $arr[1] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Email Address *</h3>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address"
                                        value="{{ $data->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Display Name *</h3>
                                    <input type="text" class="form-control" name="display_name" required
                                        value="{{ $data->display_name ?? '' }}" placeholder="Display Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Company Name</h3>
                                    <input type="text" class="form-control" name="company_name"
                                        value="{{ $data->company_name ?? '' }}" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Mobile phone *</h3>
                                    <input type="text" class="form-control" name="mobile_phone"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->phonenumber ?? '' }}" placeholder="Mobile phone" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Home phone</h3>
                                    <input type="text" class="form-control" name="home_phone"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->home_phone ?? '' }}" placeholder="Home phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Work phone </h3>
                                    <input type="text" class="form-control" name="work_phone"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->work_phone ?? '' }}" placeholder="Work phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Emergency Contact </h3>
                                    <input type="text" class="form-control" name="emergency_phone"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->emergency_phone ? $data->emergency_phone : old('emergency_phone') }}"
                                        placeholder="Emergency Contact">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Role *</h3>
                                    <select class="form-control" name="role" required>
                                        @foreach ($designation as $desi)
                                            <option
                                                value="{{ $desi->id }}"@if ($data->designation_id == $desi->id) selected @endif>
                                                {{ $desi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Maritial Status *</h3>
                                    <select class="form-control" name="marital_status" required>
                                        @foreach ($MaritalStatus as $matstatus)
                                            <option value="{{ $matstatus->id }}"
                                                @if ($data->marital_status == $matstatus->id) selected @endif>
                                                {{ $matstatus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Date Of birth * </h3>
                                    <input type="date" class="form-control" name="dob"
                                        value="{{ $data->DOB ?? '' }}" required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <h3>Owner Type</h3>
                                    <ul class="Ownertype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" checked name="ownertype" id="Employee"
                                                    value="Employee"
                                                    {{ $data->ownertype == 'Employee' ? 'checked' : '' }}>
                                                <label for="Employee">Employee</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="ownertype"
                                                    {{ $data->ownertype == 'SubContractor Employee' ? 'checked' : '' }}
                                                    value="SubContractor Employee" id="SubContractor Employee">
                                                <label for="SubContractor Employee">SubContractor Employee</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Rate of pay duration</h3>
                                    <ul class="Ownertype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" checked name="duration_of_rate" id="Hourly"
                                                    onchange="checkDuration(this)" onchange="" value="Hourly"
                                                    {{ $data->duration_of_rate == 'Hourly' ? 'checked' : '' }}>
                                                <label for="Hourly">Hourly</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="duration_of_rate"
                                                    {{ $data->duration_of_rate == 'Monthly' ? 'checked' : '' }}
                                                    value="Monthly" onchange="checkDuration(this)" id="Monthly">
                                                <label for="Monthly">Monthly</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Rate of pay (per <span id="duration">
                                            {{ $data->duration_of_rate == 'Monthly' ? 'month' : 'hour' }}</span> )</h3>
                                    <div class="dollar-sign">
                                        <input type="text" class="form-control" name="rate_of_pay"
                                            value="{{ $data->rate_of_pay ? $data->rate_of_pay : old('rate_of_pay') }}"
                                            placeholder="Rate of pay">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="create-service-form-box">
                        <h1>Address Info.</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address (additional addresses)</h3>
                                    <textarea type="text" class="form-control" name="address" placeholder="Address">{{ $data->address ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address Notes</h3>
                                    <textarea type="text" class="form-control" name="address_notes" placeholder="Address Notes">{{ $data->address_notes ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Contractor </h3>
                                    <input type="text" class="form-control"
                                        name="contractor"value="{{ $data->contractor ?? '' }}" placeholder="contractor">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Street*</h3>
                                    <input type="text" class="form-control" name="street"
                                        value="{{ $data->street ?? '' }}"placeholder="Street" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Unit *</h3>
                                    <input type="text" class="form-control" name="unit" required
                                        value="{{ $data->unit ?? '' }}" placeholder="Unit">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Country *</h3>
                                    <select class="form-control"name="country_id" required>
                                        @foreach ($country as $ctry)
                                            <option value="{{ $ctry->id }}"
                                                @if ($data->country_id == $ctry->id) selected @endif>
                                                {{ $ctry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>State *</h3>
                                    <select class="form-control"name="state_id">
                                        @foreach ($state as $value)
                                            <option value="{{ $value->id }}"
                                                @if ($data->state_id == $value->id) selected @endif>
                                                {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>City *</h3>
                                    <select class="form-control"name="city" required>
                                        @foreach ($city as $cty)
                                            <option value="{{ $cty->id }}"
                                                @if ($data->city == $cty->id) selected @endif>
                                                {{ $cty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Zipcode *</h3>
                                    <input type="text" class="form-control" name="zipcode"
                                        value="{{ $data->zipcode ?? '' }}" placeholder="Zipcode" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Upload Resume</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="product-images-upload">
                                    <div class="file-form-group">
                                        <input type="file" class="file-form-control" name="resume"
                                            accept=".pdf, .doc, .docx, .pdf">
                                    </div>
                                </div>
                                <div class="product-images-head">
                                    <p>PDF, DOC and DOCX are allowed</p>
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
                                    <input type="password" class="form-control" name="password" placeholder="******">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Confirm Password</h3>
                                    <input type="password" class="form-control" name="c_password" placeholder="******">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-action">
                        <button class="cancelbtn">cancel</button>
                        <button class="Savebtn" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function checkDuration(ele) {

            if (ele.checked) {
                if (ele.value == 'Hourly') {
                    $("#duration").text('hour');
                } else {
                    $("#duration").text('month');
                }

            }
        }
    </script>
@endpush
