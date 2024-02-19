@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/service.css') }}">
    <style>
        input[type="date"] {
            border: none;
            outline: none;
        }
    </style>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="ongoing-Services-section">
            <div class="row">
                <div class="col-md-8">
                    <div class="services-tabs">
                        <ul class="nav nav-tabs">
                            <li><a class="active" href="#Ongoing" data-bs-toggle="tab">Ongoing</a></li>
                            <li><a href="#Completed" data-bs-toggle="tab">Completed</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-md-7">
                            {{-- @if ($type == 1)
                                <form action="{{ route('search.team-member-active') }}" method="POST">
                                @else
                                    <form action="{{ route('search.team-member-inactive') }}"
                                        method="POST">
                                        @csrf
                            @endif --}}
                            <form action="">

                                <div class="search-input">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search by Service Name."
                                            name="search" value="{{ $search ?? '' }}" aria-label="Recipient's username"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit" style="background: #7BC043"
                                            id="button-addon2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button><a href="{{ route('services.index') }}" class="m-1 mx-3"><img
                                                src="{{ custom_asset('public/assets/admin-images/reset-icon.png') }}"
                                                style="height: 25px" alt=""></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <div class="">
                                <a class="item" style="width:40%">
                                    <div class="Ongoing-calender-item" style="padding: 3px">

                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ request()->has('date') ? request('date') : '' }}"
                                            onchange="location.replace('{{ route('services.index') }}'+'?date='+this.value)">
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                    {{-- <div class="Ongoing-calender-list">
                        <div id="Ongoingcalender" class="owl-carousel owl-theme">
                            @php
                                $arr = [];
                                // Get the current month and year
                                $currentMonth = now()->format('F');
                                $currentYear = now()->year;

                                // Get the number of days in the current month
                                $daysInMonth = date('j');
                                // Get the current month and year
                                $currentMonth = date('n'); // n represents the month without leading zeros
                                $currentYear = date('Y');

                                // Get the number of days in the current month
                                $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

                                // Loop through each day in the month
                                for ($day = 1; $day <= $numDaysInMonth; $day++) {
                                    $date = now()->setDay($day);
                                    $dayOfWeek = $date->format('D');
                                    $formattedDate = $date->format('d');
                                    $arr[] = ['w' => $dayOfWeek, 'd' => $formattedDate, 'date' => date('Y-m-d', strtotime($date))];
                                }
                            @endphp
                            @foreach ($arr as $item)
                                <a class="item" href="{{ route('services.index', 'date=' . $item['date']) }}">
                                    <div class="Ongoing-calender-item">
                                        <h3>{{ $item['w'] }}</h3>
                                        <h2>{{ $item['d'] }}</h2>
                                    </div>
                                </a>
                            @endforeach


                        </div>
                    </div> --}}
                    <div class="tasks-content-info tab-content">
                        <div class="tab-pane active" id="Ongoing">
                            <div class="ongoing-services-list">
                                @forelse ($services as $item)
                                    <div class="ongoing-services-item">
                                        <div class="ongoing-services-item-head">
                                            <div class="ongoing-services-item-title">
                                                <div class="services-id">#{{ $item->id }}</div>
                                                <h2 style="cursor: pointer"
                                                    onclick="location.replace('{{ route('services.edit', $item->id) }}')">
                                                    Service 1:
                                                    {{ $item->name }}</h2>
                                            </div>
                                            <div class="client-info">
                                                <div class="client-info-icon">
                                                    {{ $item->client ? substr($item->client->name, 0, 1) : 'N/A' }} </div>

                                                @if ($item->client)
                                                    <div class="client-info-text">
                                                        {{ $item->client ? $item->client->name : 'N/A' }}
                                                        &nbsp;
                                                        &nbsp;

                                                        <b style="cursor: pointer;color:#7BC043" onclick="showInfo(this)"
                                                            data-name="{{ $item->client->name }}"
                                                            data-email_address="{{ $item->client->email_address }}"
                                                            data-company="{{ $item->client->company }}"
                                                            data-mobile_number="{{ $item->client->mobile_number }}"
                                                            data-street="{{ $item->client->street }}"
                                                            data-ownertype="{{ $item->client->ownertype }}"
                                                            data-client_notes="{{ $item->client->client_notes }}"
                                                            data-role="{{ $item->client->role }}"
                                                            data-edit_client_url="{{ url('edit-client/' . encryptDecrypt('encrypt', $item->client->id)) }}"
                                                            data-client_tags="{{ $item->client->client_tags }}">info</b>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="ongoing-services-item-body">
                                            <div class="service-shift-card">
                                                <div class="service-shift-card-image">
                                                    <img
                                                        src="{{ custom_asset('public/assets/admin-images/calendar-tick.svg') }}">
                                                </div>
                                                <div class="service-shift-card-text">
                                                    <h2>Service Shift Timing:</h2>
                                                    <p>{{ date('h:i A', strtotime($item->service_start_time)) }}
                                                        - {{ date('h:i A', strtotime($item->service_end_time)) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="instructions-text">
                                                <h3>Primary Instructions: {{ $item->description }}</h3>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/people.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Job Assigned:</h2>
                                                            <p>{{ $item->members->first() ? ($item->members->first()->member ? $item->members->first()->member->fullname : '') : '' }}

                                                                @if ($item->members->count() - 1 > 0)
                                                                    <a href="{{ route('services.assign', $item->id) }}">
                                                                        + {{ $item->members->count() - 1 }}
                                                                        Employee</a>
                                                                @else
                                                                    <a href="{{ route('services.assign', $item->id) }}"> +

                                                                        Employee</a>
                                                                @endif

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/ServiceFrequency.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Frequency:</h2>
                                                            <p>{{ $item->frequency }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/buildings.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Type:</h2>
                                                            <p>{{ $item->service_type }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/clock.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Start Time:</h2>
                                                            <p>{{ date('M d,Y', strtotime($item->created_date)) }},
                                                                {{ date('h:i A', strtotime($item->service_start_time)) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/clock.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service End Time:</h2>
                                                            <p>{{ date('M d,Y', strtotime($item->scheduled_end_date)) }}
                                                                {{ date('h:i A', strtotime($item->service_end_time)) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/dollar-circle.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Price:</h2>
                                                            <p>${{ $item->total_service_cost }} + Tax Included</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ongoing-services-item-foot">
                                            <div class="loaction-address"><img
                                                    src="{{ custom_asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? ($item->client ? $item->client->street : '') : 'N/A' }}
                                            </div>
                                            <div class="ongoing-services-date">
                                                {{ date('M d,Y  h:i A', strtotime($item->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="ongoing-services-item">
                                        <div class="ongoing-services-item-head">
                                            <div class="ongoing-services-item-title">

                                                <h2>No Services</h2>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse



                            </div>
                        </div>

                        <div class="tab-pane" id="Completed">
                            <div class="ongoing-services-list">
                                @forelse ($completed_services as $item)
                                    <div class="ongoing-services-item">
                                        <div class="ongoing-services-item-head">
                                            <div class="ongoing-services-item-title">
                                                <div class="services-id">#{{ $item->id }}</div>
                                                <h2>
                                                    Service 1: {{ $item->name }}</h2>
                                            </div>
                                            <div class="client-info">
                                                <div class="client-info-icon">
                                                    {{ $item->client ? substr($item->client->name, 0, 1) : 'N/A' }} </div>
                                                <div class="client-info-text">
                                                    {{ $item->client ? $item->client->name : 'N/A' }}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="ongoing-services-item-body">
                                            <div class="service-shift-card">
                                                <div class="service-shift-card-image">
                                                    <img
                                                        src="{{ custom_asset('public/assets/admin-images/calendar-tick.svg') }}">
                                                </div>
                                                <div class="service-shift-card-text">
                                                    <h2>Service Shift Timing:</h2>
                                                    <p>{{ date('h:i A', strtotime($item->service_start_time)) }}
                                                        -{{ date('h:i A', strtotime($item->service_end_time)) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="instructions-text">
                                                <h3>Primary Instructions: {{ $item->description }}</h3>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/people.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Job Assigned:</h2>
                                                            <p>{{ $item->members->first() ? ($item->members->first()->member ? $item->members->first()->member->fullname : '') : '' }}

                                                                @if ($item->members->count() - 1 > 0)
                                                                    + <a href="#">{{ $item->members->count() - 1 }}
                                                                        Employee</a>
                                                                @else
                                                                @endif

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/ServiceFrequency.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Frequency:</h2>
                                                            <p>{{ $item->frequency }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/buildings.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Type:</h2>
                                                            <p>{{ $item->service_type }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/clock.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Start Time:</h2>
                                                            <p>{{ date('M d,Y', strtotime($item->created_date)) }},
                                                                {{ date('h:i A', strtotime($item->service_start_time)) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/clock.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service End Time:</h2>
                                                            <p>{{ date('M d,Y', strtotime($item->scheduled_end_date)) }}
                                                                {{ date('h:i A', strtotime($item->service_end_time)) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/dollar-circle.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Price:</h2>
                                                            <p>${{ $item->total_service_cost }} + Tax Included</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ongoing-services-item-foot">
                                            <div class="loaction-address"><img
                                                    src="{{ custom_asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? ($item->client ? $item->client->street : '') : 'N/A' }}
                                            </div>
                                            <div class="ongoing-services-date">
                                                {{ date('M d,Y  h:i A', strtotime($item->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="ongoing-services-item">
                                        <div class="ongoing-services-item-head">
                                            <div class="ongoing-services-item-title">

                                                <h2>No Services</h2>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="completedservice-overview">
                        <div class="completedservice-overview-content">
                            <h2>Total Completed Services</h2>
                            <h1>{{ $completed }}</h1>
                            {{-- <p><i class="las la-check-circle"></i> Completed</p> --}}
                        </div>
                        <div class="completedservice-overview-images">
                            <img src="{{ custom_asset('public/assets/admin-images/service-log-icon.svg') }}">
                        </div>
                    </div>

                    <div class="completedservice-overview">
                        <div class="completedservice-overview-content">
                            <h2>Total Ongoing Services</h2>
                            <h1>{{ $earning }}</h1>
                            {{-- <p><i class="las la-check-circle"></i> Completed</p> --}}
                        </div>
                        <div class="completedservice-overview-images">
                            <img src="{{ custom_asset('public/assets/admin-images/Earning.svg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Marital Status Modal -->
    <div class="modal fade" id="addMarital" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center d-flex  justify-content-between"> <span><span id="marital_text">Client</span>
                            Details </span> <span>
                            <a href="" id="client_edit_url" class="btn "
                                style="background: #7BC043;color:white">edit</a>
                        </span> </h5>
                    <table class="table">
                        <tr>
                            <td align="right">Name:</td>
                            <td align="left"> <b id="name"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Email:</td>
                            <td align="left"> <b id="email_address"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Mobile Number:</td>
                            <td align="left"> <b id="mobile_number"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Address:</td>
                            <td align="left"> <b id="street"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Company:</td>
                            <td align="left"> <b id="company"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Role:</td>
                            <td align="left"> <b id="role"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Owner Type:</td>
                            <td align="left"> <b id="ownertype"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Client Notes:</td>
                            <td align="left"> <b id="client_notes"></b> </td>
                        </tr>
                        <tr>
                            <td align="right">Client Tags:</td>
                            <td align="left"> <b id="client_tags"></b> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showInfo(ele) {
            $("#addMarital").modal("show");
            $("#name").text(ele.getAttribute("data-name"));
            $("#email_address").text(ele.getAttribute("data-email_address"));
            $("#mobile_number").text(ele.getAttribute("data-mobile_number"));
            $("#street").text(ele.getAttribute("data-street"));
            $("#company").text(ele.getAttribute("data-company"));
            $("#role").text(ele.getAttribute("data-role"));
            $("#ownertype").text(ele.getAttribute("data-ownertype"));
            $("#client_notes").text(ele.getAttribute("data-client_notes"));
            $("#client_tags").text(ele.getAttribute("data-client_tags"));
            $("#client_edit_url").attr("href", ele.getAttribute("data-edit_client_url"));



        }
    </script>
@endsection
