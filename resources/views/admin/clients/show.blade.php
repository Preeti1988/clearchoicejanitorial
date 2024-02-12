@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client-Details')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/client.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/teams.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="client-details-section">
            <div class="client-profile-section">
                <div class="row g-1 align-items-center">
                    <div class="col-md-3">
                        <div class="side-profile-item">
                            <div class="side-profile-media"><img
                                    src="{{ custom_asset('public/assets/admin-images/user-default.png') }}">
                            </div>
                            <div class="side-profile-text">
                                <h2>{{ $data->name ?? '' }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="client-contact-info">
                                    <div class="client-contact-info-icon">
                                        <img src="{{ custom_asset('public/assets/admin-images/email-icon.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Email Address</h2>
                                        <p>{{ $data->email_address ?? '' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="client-contact-info">
                                    <div class="client-contact-info-icon">
                                        <img src="{{ custom_asset('public/assets/admin-images/phone-icon.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Phone Number</h2>
                                        <p>+{{ $data->country ? $data->country->phonecode : '1' }}
                                            {{ $data->mobile_number ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="client-contact-info">
                                    <div class="client-contact-info-icon">
                                        <img src="{{ custom_asset('public/assets/admin-images/map.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Client Default Address</h2>
                                        <p>{{ $data->street ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="ongoing-Services-section">
                <div class="row">
                    <div class="col-md-9">
                        <div class="services-tabs">
                            <ul class="nav nav-tabs">
                                <li><a class="active" href="#OngoingServices" data-bs-toggle="tab">Ongoing</a></li>
                                <li><a href="#UnAssignedServices" data-bs-toggle="tab"> Unassigned</a></li>
                                <li><a href="#CompletedServices" data-bs-toggle="tab">Completed</a></li>
                            </ul>
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

                                    // Loop through each day in the month
                                    for ($day = 1; $day <= $daysInMonth; $day++) {
                                        $date = now()->setDay($day);
                                        $dayOfWeek = $date->format('D');
                                        $formattedDate = $date->format('d');
                                        $arr[] = ['w' => $dayOfWeek, 'd' => $formattedDate, 'date' => date('Y-m-d', strtotime($date))];
                                    }
                                @endphp
                                @foreach ($arr as $item)
                                    <a class="item"
                                        href="{{ url('client-details/' . encryptDecrypt('encrypt', $data->id) . '?date=' . $item['date']) }}">
                                        <div class="Ongoing-calender-item">
                                            <h3>{{ $item['w'] }}</h3>
                                            <h2>{{ $item['d'] }}</h2>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div> --}}
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
                                                name="search" value="{{ $search ?? '' }}"
                                                aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="submit"
                                                style="background: #7BC043" id="button-addon2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                </svg>
                                            </button><a
                                                href="{{ url('client-details/' . encryptDecrypt('encrypt', $data->id)) }}"
                                                class="m-1 mx-3"><img
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

                                            <input type="date" name="date" id="date" class="form-control" style= "border: 0"
                                                value="{{ request()->has('date') ? request('date') : '' }}"
                                                onchange="location.replace('{{ url('client-details/' . encryptDecrypt('encrypt', $data->id)) }}'+'?date='+this.value)">
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="tasks-content-info tab-content">
                            <div class="tab-pane active" id="OngoingServices">
                                <div class="ongoing-services-list">
                                    @forelse ($ongoing as $item)
                                        <div class="ongoing-services-item">
                                            <div class="ongoing-services-item-head">
                                                <div class="ongoing-services-item-title">
                                                    <div class="services-id">#{{ $item->id }}</div>
                                                    <h2>Service 1: {{ $item->name }}</h2>
                                                </div>
                                                <div class="client-info">
                                                    <div class="client-info-icon">
                                                        {{ $item->client ? substr($item->client->name, 0, 1) : 'N/A' }}
                                                    </div>
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
                                                                <p>John Doe + <a
                                                                        href="{{ route('services.assign', $item->id) }}">12
                                                                        Employee</a></p>
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
                                                                <p>{{ date('M d,Y', strtotime($item->scheduled_end_date)) }},
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
                                                    {{ date('l, j M h:i:s A', strtotime($item->created_at)) }}
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
                                                    <h2>Service 1: {{ $item->name }}</h2>
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
                            <div class="tab-pane" id="CompletedServices">
                                <div class="ongoing-services-list">
                                    @forelse ($completed as $item)
                                        <div class="ongoing-services-item">
                                            <div class="ongoing-services-item-head">
                                                <div class="ongoing-services-item-title">
                                                    <div class="services-id">#{{ $item->id }}</div>
                                                    <h2>Service 1: {{ $item->name }}</h2>
                                                </div>
                                                <div class="client-info">
                                                    <div class="client-info-icon">
                                                        {{ $item->client ? substr($item->client->name, 0, 1) : 'N/A' }}
                                                    </div>
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
                                                                <p>John Doe + <a
                                                                        href="{{ route('services.assign', $item->id) }}">12
                                                                        Employee</a></p>
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
                                                                <p>{{ date('M d,Y', strtotime($item->scheduled_end_date)) }},
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
                                                    {{ date('l, j M h:i:s A', strtotime($item->created_at)) }}
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

                    <div class="col-md-3">
                        <div class="service-panel-sidebar">
                            <h2>{{ $data->name ?? '' }} Ongoing, Assigned & Completed Projects logs</h2>
                            <div class="service-log-media">
                                <img src="{{ custom_asset('public/assets/admin-images/service-log-icon.svg') }}">
                            </div>

                            {{-- <div class="service-log-overview">
                                <h3>Total Projects {{ count($ongoing) }} Projects</h3>

                                <div class="service-log-item">
                                    <h2>01</h2>
                                    <p>ONTIME</p>
                                </div>
                            </div> --}}

                        </div>
                        <div class="team-panel-sidebar">

                            <div class="count-bg-1 mt-2">
                                <p class="p-0 m-0 text-center">
                                    {{ count($ongoing) + count($unassigned) + count($completed) }} Total Projects
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-small-1 detail-box mt-3">
                                        <h5 class="text-center m-0 p-0">{{ count($ongoing) }}</h5>
                                        <p class="text-center mt-2 mb-0 p-0">Ongoing</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-small-1 detail-box mt-3">
                                        <h5 class="text-center m-0 p-0">{{ count($unassigned) }}</h5>
                                        <p class="text-center mt-2 mb-0 p-0">Un-assigned</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="detail-small-1 detail-box mt-3">
                                        <h5 class="text-center m-0 p-0">{{ count($completed) }}</h5>
                                        <p class="text-center mt-2 mb-0 p-0">Completed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
