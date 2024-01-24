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
                                        value="{{ old('mobile_number') }}" placeholder="Mobile phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Home phone *</h3>
                                    <input type="text" class="form-control" name="home_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('home_number') }}" placeholder="Home phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Work phone*</h3>
                                    <input type="text" class="form-control" name="client_work_number"
                                        data-inputmask="'mask': '(999) 999-9999'" placeholder="(999) 999-9999"
                                        value="{{ old('client_work_number') }}" placeholder="Work phone">
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



                            <div class="col-md-12">
                                <div class="form-group">
                                    <h3>Address*</h3>
                                    <input type="text" class="form-control" name="street" required id="pac-input"
                                        value="{{ old('street') }}"placeholder="Address">
                                    <div id="map" style="height: 500px"></div>

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
                                    <h3>Zipcode *</h3>
                                    <input type="text" class="form-control" name="zipcode" id="zipcode"
                                        placeholder="Zipcode" required>
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
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Notes*</h3>
                                    <input type="text" class="form-control" name="client_notes"
                                        value="{{ old('client_notes') }}" placeholder="Notes">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Tags*</h3>
                                    <input type="text" class="form-control" name="client_tags"
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
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initMap() {

            const input = document.getElementById("pac-input");

            const options = {
                fields: ["formatted_address", "geometry", "name"],
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
            const searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            let markers = [];
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var add = document.getElementById("address_notes");
                    add.value = place.geometry.location.lat() + "," + place.geometry
                        .location.lng();
                    if (place.address_components.length && place.address_components[place.address_components
                            .length - 1]) {
                        $("#zipcode").val(place.address_components[place.address_components
                            .length - 1].long_name)

                    }
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
                });
                map.fitBounds(bounds);
            });
            const autocomplete = new google.maps.places.Autocomplete(input, options);

            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);


            // autocomplete.addListener("place_changed", () => {
            //     infowindow.close();


            //     const place = autocomplete.getPlace();

            //     console.log(place);
            //     if (!place.geometry || !place.geometry.location) {
            //         // User entered the name of a Place that was not suggested and
            //         // pressed the Enter key, or the Place Details request failed.
            //         window.alert("No details available for input: '" + place.name + "'");
            //         return;
            //     }
            //     var add = document.getElementById("address_notes");
            //     add.value = place.geometry.location.lat() + "," + place.geometry.location.lng();
            //     console.log(place.geometry.location.lat() + "," + place.geometry.location.lng());
            //     var latLng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng())
            //     var geocoder = (new google.maps.Geocoder());
            //     geocoder.geocode({
            //         latLng: latLng
            //     }, function(results, status) {
            //         if (status = google.maps.GeocoderStatus.OK) {
            //             if (results[0]) {

            //                 console.log(results[0].address_components);
            //                 var pin = results[0].address_components[
            //                     results[0].address_components.length - 1
            //                 ].long_name;

            //                 var country = results[0].address_components.length > 1 ? results[0]
            //                     .address_components[
            //                         results[0].address_components.length - 2
            //                     ].long_name : "";
            //                 var state = results[0].address_components.length > 2 ? results[0]
            //                     .address_components[
            //                         results[0].address_components.length - 3
            //                     ].long_name : "";
            //                 var city = results[0].address_components.length > 4 ? results[0]
            //                     .address_components[
            //                         results[0].address_components.length - 5
            //                     ].long_name : '';

            //                 console.log(country, state, city, pin);
            //                 var _token = "{{ csrf_token() }}";

            //                 $("#zipcode").val(pin);
            //                 // $.post("{{ route('getCountry') }}", {
            //                 //     country,
            //                 //     state,
            //                 //     city,
            //                 //     _token
            //                 // }, function(data) {
            //                 //     $("#state_id").val(data.state_id);
            //                 //     $("#country_id").val(data.country_id);

            //                 //     var htm = "";
            //                 //     htm += `<select class="form-control"  id="city_id" name="city" >`;
            //                 //     if (data.cities.length == 0) {
            //                 //         htm += `<option >No cities found</option>`;
            //                 //     }
            //                 //     data.cities.map(item => {
            //                 //         htm +=
            //                 //             ` <option value="${item.id}">${item.name}</option> `;
            //                 //     })
            //                 //     htm += `</select>`;

            //                 //     $("#city_container").html(htm);
            //                 //     $("#city_id").val(data.city_id);

            //                 // });
            //             }
            //         }


            //     });




            // });

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.var place = autocomplete.getPlace();


            // Get additional details using Places Details API


        }


        window.initMap = initMap;


        function getState(id) {
            $.get("{{ route('getState') }}" + '?id=' + id, function(data) {
                htm = "";
                htm += `<select class="form-control" name="state_id" id="state_id" onchange="getCity(this.value)">`;
                if (data.length == 0) {
                    htm += `<option >No States</option>`;
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
                    htm += `<option >No Cities</option>`;
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

                        phoneValid: true
                    },
                    home_phone: {

                        phoneValid: true
                    },
                    work_phone: {

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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDXuJl8qV7nsf-ynH3slL2iopSJm6y0mA&libraries=places&sensor=false&callback=initMap">
    </script>
@endpush
