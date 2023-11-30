@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Edit Client')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/assets/admin-css/newteammeber.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Edit Client</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('UpdateClient') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                    <div class="create-service-form-box">
                        <h1>Members Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $arr = [];
                                    $arr = explode(' ', ucwords($data->name), 2); ?>
                                    <h3>First Name</h3>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{ $arr[0] ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Last Name</h3>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{ $arr[1] ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Email Address</h3>
                                    <input type="text" class="form-control" name="email_address"
                                        placeholder="Email Address" value="{{ $data->email_address ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Display Name</h3>
                                    <input type="text" class="form-control" name="display_name"
                                        value="{{ $data->display_name ?? '' }}" placeholder="Display Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Company Name</h3>
                                    <input type="text" class="form-control" name="company"
                                        value="{{ $data->company ?? '' }}" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Mobile phone</h3>
                                    <input type="text" class="form-control" name="mobile_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->mobile_number ?? '' }}" placeholder="Mobile phone" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Home phone</h3>
                                    <input type="text" class="form-control" name="client_work_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->client_work_number ?? '' }}" placeholder="Home phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Work phone</h3>
                                    <input type="text" class="form-control" name="client_work_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->client_work_number ?? '' }}" placeholder="Work phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Role</h3>
                                    <select class="form-control" name="role">
                                        @foreach ($designation as $desi)
                                            <option
                                                value="{{ $desi->id }}"@if ($data->designation_id == $desi->id) selected @endif>
                                                {{ $desi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <h3>Owner Type</h3>
                                    <ul class="Ownertype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="ownertype" id="ownertype"
                                                    value="{{ $data->ownertype ?? '' }}">
                                                <label for="Home Owner">Home Owner</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="ownertype" id="ownertype">
                                                <label for="Business">Business</label>
                                            </div>
                                        </li>
                                    </ul>
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
                                    <h3>Contractor</h3>
                                    <input type="text" class="form-control"
                                        name="contractor"value="{{ $data->contractor ?? '' }}" placeholder="contractor">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Street</h3>
                                    <input type="text" class="form-control" name="street"
                                        value="{{ $data->street ?? '' }}"placeholder="Street">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Unit</h3>
                                    <input type="text" class="form-control" name="unit"
                                        value="{{ $data->unit ?? '' }}" placeholder="Unit">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Country</h3>
                                    <select class="form-control"name="country_id" onchange="getState(this.value)">
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
                                    <h3>State</h3>
                                    <div id="state_container">
                                        <select class="form-control"name="state_id" onchange="getCity(this.value)">

                                            <option value="0">--Select--</option>
                                            @foreach ($state as $value)
                                                <option value="{{ $value->id }}"
                                                    @if ($data->state_id == $value->id) selected @endif>
                                                    {{ $value->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>City</h3>
                                    <div id="city_container">
                                        <select class="form-control"name="city">

                                            <option value="0">--Select--</option>
                                            @foreach ($city as $cty)
                                                <option value="{{ $cty->id }}"
                                                    @if ($data->city == $cty->id) selected @endif>
                                                    {{ $cty->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Zipcode</h3>
                                    <input type="text" class="form-control" name="zipcode"
                                        value="{{ $data->zipcode ?? '' }}" placeholder="Zipcode">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="create-service-form-box">
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Notes</h3>
                                    <input type="text" class="form-control" name="client_notes"
                                        value="{{ $data->client_notes ?? '' }}" placeholder="Notes"required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Tags</h3>
                                    <input type="text" class="form-control" name="client_tags"
                                        value="{{ $data->client_tags ?? '' }}" placeholder="Tages"required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>This Client bill's to</h3>
                                    <input type="text" class="form-control" name="client_bills_to"
                                        value="{{ $data->client_bills_to ?? '' }}" placeholder="This Client bill's to"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Lead Source </h3>
                                    <input type="text" class="form-control" name="lead_source"
                                        value="{{ $data->lead_source ?? '' }}" placeholder="Display Name" required>
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
                console.log(htm);
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
    </script>
@endpush
