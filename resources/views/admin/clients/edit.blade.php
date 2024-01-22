@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Edit Client')
@push('css')
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-css/newteammeber.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Edit Client</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('UpdateClient') }}" id="newteammember" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                    <div class="create-service-form-box">
                        <h1>Members Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $arr = [];
                                    $arr = explode(' ', ucwords($data->name), 2); ?>
                                    <h3>First Name *</h3>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{ $arr[0] ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Last Name *</h3>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{ $arr[1] ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Email Address *</h3>
                                    <input type="text" class="form-control" name="email_address"
                                        placeholder="Email Address" value="{{ $data->email_address ?? '' }}" required>
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
                                    <h3>Company Name </h3>
                                    <input type="text" class="form-control" name="company"
                                        value="{{ $data->company ?? '' }}" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Mobile phone*</h3>
                                    <input type="text" class="form-control" name="mobile_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ $data->mobile_number ?? '' }}" placeholder="Mobile phone">
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
                                    <h3>Role *</h3>

                                    <input type="text" class="form-control" name="role" required
                                        value="{{ $data->role ?? '' }}" placeholder="Role">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Owner Type</h3>
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



                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address*</h3>
                                    <input type="text" class="form-control" name="street" required id="pac-input"
                                        value="{{ $data->street ?? '' }}"placeholder="Address">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Unit</h3>
                                    <input type="text" class="form-control" name="unit"
                                        value="{{ $data->unit ?? '' }}" placeholder="Unit">
                                </div>
                            </div>




                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Zipcode*</h3>
                                    <input type="text" class="form-control" name="zipcode" required
                                        value="{{ $data->zipcode ?? '' }}" placeholder="Zipcode">
                                </div>
                            </div> <input type="hidden" name="address_notes" id="address_notes">
                            {{-- <div class="col-md-6">
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
                            </div> --}}
                        </div>
                    </div>
                    <div class="create-service-form-box">
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Notes*</h3>
                                    <input type="text" class="form-control" name="client_notes"
                                        value="{{ $data->client_notes ?? '' }}" placeholder="Notes">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Tags*</h3>
                                    <input type="text" class="form-control" name="client_tags"
                                        value="{{ $data->client_tags ?? '' }}" placeholder="tags">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>This Client bill's to *</h3>
                                    <input type="text" class="form-control" name="client_bills_to"
                                        value="{{ $data->client_bills_to ?? '' }}" placeholder="This Client bill's to"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Lead Source *</h3>
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
                        <button class="cancelbtn">Cancel</button>
                        <button class="Savebtn" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        function initMap() {

            const input = document.getElementById("pac-input");

            const options = {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
            };



            const autocomplete = new google.maps.places.Autocomplete(input, options);

            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);


            autocomplete.addListener("place_changed", () => {
                infowindow.close();


                const place = autocomplete.getPlace();


                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
                var add = document.getElementById("address_notes");
                add.value = place.geometry.location.lat() + "," + place.geometry.location.lng()
            });

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.




        }

        window.initMap = initMap;

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
        $(document).ready(function() {
            $.validator.addMethod("phoneValid", function(value) {
                return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(value);
            }, 'Invalid phone number.');
            $.validator.addMethod("zeroValue", function(value) {
                return value != 0;
            }, 'Please select .');
            $('#newteammember').validate({
                rules: {
                    mobile_number: {
                        phoneValid: true
                    },
                    home_phone: {
                        phoneValid: true
                    },
                    work_phone: {
                        phoneValid: true
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


    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDXuJl8qV7nsf-ynH3slL2iopSJm6y0mA&libraries=places&sensor=false&callback=initMap">
    </script>
@endpush
