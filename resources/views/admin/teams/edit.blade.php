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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Edit Team Members</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('UpdateTeamMember') }}" method="POST" enctype="multipart/form-data" id="team_edit">
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

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Contractor</h3>
                                    <input type="text" class="form-control" name="contractor"
                                        value="{{ old('contractor') }}" placeholder="Contractor">
                                </div>
                            </div> --}}



                            <div class="col-md-12">
                                <div class="form-group">
                                    <h3>Address*</h3>
                                    <input type="text" class="form-control" name="street" required id="pac-input"
                                        value="{{ $data->street ?? '' }}"
                                        value="{{ old('street') }}"placeholder="Address">
                                    <div id="map" style="height: 500px"></div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Unit</h3>
                                    <input type="text" class="form-control" name="unit"
                                        value="{{ $data->unit ?? '' }}"placeholder="Unit">
                                </div>
                            </div>









                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Zipcode *</h3>
                                    <input type="text" class="form-control" name="zipcode" id="zipcode"
                                        value="{{ $data->zipcode ?? '' }}" placeholder="Zipcode" required>
                                </div>
                            </div>

                            <input type="hidden" name="address_notes" id="address_notes">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address Notes</h3>
                                    <textarea type="text" class="form-control"  name="address_notes" placeholder="Address Notes"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address (additional addresses)</h3>
                                    <textarea type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Address"></textarea>
                                </div>
                            </div> --}}


                        </div>

                    </div>
                    <div class="create-service-form-box">
                        <h1>Banking Info.</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Bank Name</h3>
                                    <input type="text" name="bank" class="form-control"
                                        value="{{ $data->bank }}" placeholder="Bank Name">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Account Number</h3>
                                    <input type="text" name="account" class="form-control"
                                        value="{{ $data->account }}" placeholder="Account Number">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>SSN</h3>
                                    <input type="text" name="ssn" class="form-control"
                                        value="{{ $data->ssn }}" placeholder="SSN">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Routing Number</h3>
                                    <input type="text" name="routing_number" class="form-control"
                                        value="{{ $data->routing_number }}" placeholder="Routing Number">

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
        function initMap() {

            const input = document.getElementById("pac-input");

            const options = {
                fields: ["formatted_address", "geometry", "name", "photos"],
                strictBounds: false,
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -33.8688,
                    lng: 151.2195
                },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            let markers = [];

            // const searchBox = new google.maps.places.SearchBox(input, options);
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // // Bias the SearchBox results towards current map's viewport.
            // map.addListener("bounds_changed", () => {
            //     searchBox.setBounds(map.getBounds());
            // });
            // searchBox.addListener("places_changed", () => {
            //     const places = searchBox.getPlaces();

            //     if (places.length == 0) {
            //         return;
            //     }

            //     // Clear out the old markers.
            //     markers.forEach((marker) => {
            //         marker.setMap(null);
            //     });
            //     markers = [];

            //     // For each place, get the icon, name and location.
            //     const bounds = new google.maps.LatLngBounds();

            //     places.forEach((place) => {

            //         console.log(place);
            //         if (!place.geometry || !place.geometry.location) {
            //             console.log("Returned place contains no geometry");
            //             return;
            //         }
            //         var add = document.getElementById("service_latlng");
            //         add.value = place.geometry.location.lat() + "," + place.geometry
            //             .location.lng();

            //         // Create a marker for each place.
            //         markers.push(
            //             new google.maps.Marker({
            //                 map,

            //                 title: place.name,
            //                 position: place.geometry.location,
            //             }),
            //         );
            //         if (place.geometry.viewport) {
            //             // Only geocodes have viewport.
            //             bounds.union(place.geometry.viewport);
            //         } else {
            //             bounds.extend(place.geometry.location);
            //         }
            //     });
            //     map.fitBounds(bounds);
            // });


            @if ($data && $data->address_notes)
                var latitude = {{ explode(',', $data->address_notes)[0] }};
                var longitude = {{ explode(',', $data->address_notes)[1] }};
                var geocoder = new google.maps.Geocoder();

                // Create a LatLng object using the provided coordinates
                var latlng = new google.maps.LatLng(latitude, longitude);

                // Make a reverse geocoding request
                geocoder.geocode({
                    'latLng': latlng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            // Extract the place ID from the first result
                            var placeId = results[0].place_id;
                            const bounds = new google.maps.LatLngBounds();
                            // Make a request to the Places API to get place details
                            var placesService = new google.maps.places.PlacesService(document.createElement('div'));
                            placesService.getDetails({
                                placeId: placeId
                            }, function(place, status) {
                                if (status == google.maps.places.PlacesServiceStatus.OK) {
                                    // Display the result on the webpage
                                    // document.getElementById('result').innerHTML = 'Place Name: ' + place.name;
                                    console.log(
                                        "place first"
                                    ); // Log the entire place object for additional details
                                    if (!place.geometry || !place.geometry.location) {
                                        console.log("Returned place contains no geometry");
                                        return;
                                    }

                                    const icon = {
                                        url: place.icon,
                                        size: new google.maps.Size(71, 71),
                                        origin: new google.maps.Point(0, 0),
                                        anchor: new google.maps.Point(17, 34),
                                        scaledSize: new google.maps.Size(25, 25),
                                    };

                                    // Create a marker for each place.

                                    if (place.geometry.viewport) {
                                        // Only geocodes have viewport.
                                        bounds.union(place.geometry.viewport);
                                    } else {
                                        bounds.extend(place.geometry.location);
                                    }
                                    map.fitBounds(bounds);
                                } else {
                                    console.log('Places API request failed with status: ' + status);
                                }
                            });
                        } else {
                            console.log('No results found');
                        }
                    } else {
                        console.log('Geocoder failed due to: ' + status);
                    }
                });
                var marker = new google.maps.Marker({
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                    map: map,
                    title: 'Marker Title' // Optional, add a title to the marker
                });
                markers.push(
                    marker
                );
            @endif

            const autocomplete = new google.maps.places.Autocomplete(input, options);
            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);
            autocomplete.addListener("place_changed", () => {
                infowindow.close();

                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];


                const bounds = new google.maps.LatLngBounds();
                const place = autocomplete.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                // saving lat long
                var add = document.getElementById("address_notes");
                add.value = place.geometry.location.lat() + "," + place.geometry
                    .location.lng();

                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                        map,

                        title: place.name,
                        position: place.geometry.location,
                    }),
                );
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                map.fitBounds(bounds);

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
                var add = document.getElementById("address_notes");
                add.value = place.geometry.location.lat() + "," + place.geometry.location.lng();
                console.log(place.geometry.location.lat() + "," + place.geometry.location.lng());
                var latLng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng())
                var geocoder = (new google.maps.Geocoder());
                geocoder.geocode({
                    latLng: latLng
                }, function(results, status) {
                    if (status = google.maps.GeocoderStatus.OK) {
                        if (results[0]) {

                            var pin = results[0].address_components[
                                results[0].address_components.length - 1
                            ].long_name;
                            $("#zipcode").val(pin);


                            // var country = results[0].address_components.length > 1 ? results[0]
                            //     .address_components[
                            //         results[0].address_components.length - 2
                            //     ].long_name : "";
                            // var state = results[0].address_components.length > 2 ? results[0]
                            //     .address_components[
                            //         results[0].address_components.length - 3
                            //     ].long_name : "";
                            // var city = results[0].address_components.length > 4 ? results[0]
                            //     .address_components[
                            //         results[0].address_components.length - 5
                            //     ].long_name : '';

                            // console.log(country, state, city, pin);
                            // var _token = "{{ csrf_token() }}";
                            // $.post("{{ route('getCountry') }}", {
                            //     country,
                            //     state,
                            //     city,
                            //     _token
                            // }, function(data) {
                            //     $("#state_id").val(data.state_id);
                            //     $("#country_id").val(data.country_id);

                            //     var htm = "";
                            //     htm += `<select class="form-control"  id="city_id" name="city" >`;
                            //     if (data.cities.length == 0) {
                            //         htm += `<option >No cities found</option>`;
                            //     }
                            //     data.cities.map(item => {
                            //         htm +=
                            //             ` <option value="${item.id}">${item.name}</option> `;
                            //     })
                            //     htm += `</select>`;

                            //     $("#city_container").html(htm);
                            //     $("#city_id").val(data.city_id);

                            // });
                        }
                    }
                });
            });
        }
        window.initMap = initMap;


        function getState(id) {
            $.get("{{ route('getState') }}" + '?id=' + id, function(data) {
                htm = "";
                htm += `<select class="form-control" name="state_id" id="state_id" onchange="getCity(this.value)">`;
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
                htm += `<select class="form-control"  id="city_id name="city" >`;
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
            $("#team_edit").validate({
                rules: {
                    bank: {
                        required: true,
                    },
                    account: {
                        required: true,
                        digits: true, // Allow only digits
                    },
                    ssn: {
                        required: true,
                        digits: true, // Allow only digits
                        minlength: 9,
                        maxlength: 9,
                    },
                    routing_number: {
                        required: true,
                        digits: true, // Allow only digits
                    },
                },
                messages: {
                    bankName: {
                        required: "Please enter the bank name.",
                    },
                    accountNumber: {
                        required: "Please enter the account number.",
                        digits: "Please enter only digits for the account number.",
                    },
                    ssn: {
                        required: "Please enter the SSN.",
                        digits: "Please enter only digits for the SSN.",
                        minlength: "SSN must be 9 digits.",
                        maxlength: "SSN must be 9 digits.",
                    },
                    routingNumber: {
                        required: "Please enter the routing number.",
                        digits: "Please enter only digits for the routing number.",
                    },
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    element.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $('.please-wait').click();
                    $(element).addClass("invalid-feedback");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("invalid-feedback");
                },

            });
        });

        function checkDuration(ele) {

            if (ele.checked) {
                if (ele.value == 'Hourly') {
                    $("#duration").text('hour');
                } else {
                    $("#duration").text('month');
                }

            }
        } // jQuery Validation
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDXuJl8qV7nsf-ynH3slL2iopSJm6y0mA&libraries=places&sensor=false&callback=initMap">
    </script>
@endpush
