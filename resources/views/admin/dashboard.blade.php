@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Dashboard')
@push('css')
    <style>
        input[type="date"] {
            border: none;
            outline: none;
        }
    </style>
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/service.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="overview-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-card">
                        <div class="overview-card-frant">
                            <div class="overview-card-text">
                                <h3>{{ $services }}</h3>
                                <p>Total Services</p>
                            </div>
                            <div class="overview-card-media">
                                <img src="{{ custom_asset('public/assets/admin-images/service.svg') }}">
                            </div>
                        </div>
                        <div class="overview-card-back">
                            <div class="overview-back-text">
                                <p>Total Ongoing Services: <b>{{ count($ongoing) }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="overview-card">
                        <div class="overview-card-frant">
                            <div class="overview-card-text">
                                <h3>{{ $members }}</h3>
                                <p>Team Members </p>
                            </div>
                            <div class="overview-card-media">
                                <img src="{{ custom_asset('public/assets/admin-images/Team.svg') }}">
                            </div>
                        </div>
                        <div class="overview-card-back">
                            <div class="overview-back-text">
                                <p>New Registrations Requests: <b>{{ $request_members }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ongoing-Services-section">
            <div class="row">
                <div class="col-md-8">
                    <div class="services-tabs">
                        <ul class="nav nav-tabs">
                            <li><a class="active" href="#OngoingServices" data-bs-toggle="tab">Ongoing Services</a></li>
                            <li><a href="#UnAssignedServices" data-bs-toggle="tab"><i class="las la-eye-slash me-2"></i>
                                    Un-Assigned Services</a>
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
                                        </button>
                                        <a href="{{ route('Home') }}" class="m-1 mx-3"><img
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
                                            onchange="location.replace('{{ route('Home') }}'+'?date='+this.value)">
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
                        <div class="tab-pane active" id="OngoingServices">
                            <div class="ongoing-services-list">
                                @forelse ($ongoing as $item)
                                    <div class="ongoing-services-item">
                                        <div class="ongoing-services-item-head">
                                            <div class="ongoing-services-item-title">
                                                <div class="services-id">#{{ $item->id }}</div>
                                                <h2 style="cursor: pointer"
                                                    onclick="location.replace('{{ route('services.edit', $item->id) }}')">
                                                    Service 1: {{ $item->name }}</h2>
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

                                                                @if ($item->members->count() - 1)
                                                                    + <a href="{{ route('services.assign', $item->id) }}">{{ $item->members->count() - 1 }}
                                                                        Employee</a>
                                                                @else
                                                                    <a href="{{ route('services.assign', $item->id) }}">+
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
                                                            <p>
                                                                {{ date('M d,Y', strtotime($item->created_date)) }},
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
                                                            <p>
                                                                {{ date('M d,Y', strtotime($item->scheduled_end_date)) }}
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
                        <div class="tab-pane" id="UnAssignedServices">
                            <div class="ongoing-services-list">
                                @forelse ($unassigned as $item)
                                    <div class="ongoing-services-item">
                                        <div class="ongoing-services-item-head">
                                            <div class="ongoing-services-item-title">
                                                <div class="services-id">#{{ $item->id }}</div>
                                                <h2 style="cursor: pointer"
                                                    onclick="location.replace('{{ route('services.edit', $item->id) }}')">
                                                    Service 1: {{ $item->name }}</h2>
                                            </div>
                                            <div class="ongoing-services-date">
                                                {{ date('l, j M h:i:s A', strtotime($item->created_at)) }}</div>
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
                                                        -{{ date('h:i A', strtotime($item->service_end_time)) }}</p>
                                                </div>
                                            </div>

                                            <div class="instructions-text">
                                                <h3>{{ $item->description }}</h3>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ custom_asset('public/assets/admin-images/Qty.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Qty:</h2>
                                                            <p>1</p>
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
                                                                src="{{ custom_asset('public/assets/admin-images/dollar-circle.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Price</h2>
                                                            <p>${{ $item->total_service_cost }}.00 + Tax Included</p>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="ongoing-services-item-foot">
                                            <div class="loaction-address"><img
                                                    src="{{ custom_asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? $item->client->street : '' }}
                                            </div>
                                            <div class="ongoing-services-action"><a
                                                    href="{{ route('services.assign', $item->id) }}">Assign Team
                                                    Member</a>
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
                    <div class="chat-panel-sidebar">
                        <div class="chat-panel-sidebar-head">
                            <div class="chat-panel-sidebar-heading">
                                <div class="chat-panel-sidebar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M17 9C17 12.87 13.64 16 9.5 16L8.57001 17.12L8.02 17.78C7.55 18.34 6.65 18.22 6.34 17.55L5 14.6C3.18 13.32 2 11.29 2 9C2 5.13 5.36 2 9.5 2C12.52 2 15.13 3.67001 16.3 6.07001C16.75 6.96001 17 7.95 17 9Z"
                                            stroke="#4F5168" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M22 12.86C22 15.15 20.82 17.18 19 18.46L17.66 21.41C17.35 22.08 16.45 22.21 15.98 21.64L14.5 19.86C12.08 19.86 9.92001 18.79 8.57001 17.12L9.5 16C13.64 16 17 12.87 17 9C17 7.95 16.75 6.96001 16.3 6.07001C19.57 6.82001 22 9.57999 22 12.86Z"
                                            stroke="#4F5168" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7 9H12" stroke="#7BC043" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h2>New Messages <span>{{ TotalCountMSG() }} New</span></h2>
                            </div>
                        </div>
                        <div class="chat-panel-sidebar-body">
                            <div class="chat-panel-sidebar-scroll">
                                <div class="chat-panel-sidebar-action">
                                    {{-- <a class="sendbroadcast-btn" href="#">Send Broadcast Message</a> --}}
                                </div>
                                <div class="chat-panel-sidebar-list">

                                    @if (count($msgs) == 0)


                                        <div class="chat-panel-sidebar-item">
                                            No record found
                                        </div>
                                    @elseif(count($msgs) != 0)
                                        @foreach ($msgs as $val)
                                            <div class="chat-panel-sidebar-item"
                                                onclick="location.replace('{{ url('chat/' . encryptDecrypt('encrypt', $val->userid)) }}')">
                                                <div class="chat-panel-sidebar-item-image">
                                                    <img
                                                        src="{{ custom_asset('public/assets/admin-images/user-default.png') }}">
                                                </div>
                                                <div class="chat-panel-sidebar-item-text">
                                                    <h2>{{ $val->fullname }}</h2>
                                                    <div class="msg-text-info">{{ $val->email }}</div>
                                                </div>
                                                @if (CountMSG($val->userid) > 0)
                                                    <div class="unread-message"
                                                        style="background: #7BC043;border-radius:8px">
                                                        <span class="badge">{{ CountMSG($val->userid) }}</span>
                                                    </div>
                                                @endif

                                            </div>
                                        @endforeach
                                    @endif



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
