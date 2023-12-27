@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client-Details')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/team-details.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="client-details-section">
            <div class="client-profile-section">
                <div class="row g-1 align-items-center">
                    <div class="col-md-3">
                        <div class="side-profile-item align-items-center">
                            <div class="side-profile-media"><img
                                    src="{{ asset('public/assets/admin-images/user-default.png') }}"></div>
                            <div class="side-profile-text ms-2">
                                <h2 class="mb-0 pb-0 ">{{ $data->fullname ?? '' }}</h2>
                                <p class="mb-0 pb-0 member-id">Member ID: <b>{{ $data->userid ?? '' }}</b></p>
                                <h6 class="mt-0 pt-0 mb-0 pb-0 join-date">Joined on:
                                    {{ date('M d, Y', strtotime($data->created_at)) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4 d-flex">
                                <div class="client-contact-info align-items-center">
                                    <div class="client-contact-info-icon">
                                        <img src="{{ asset('public/assets/admin-images/email-icon.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Email Address</h2>
                                        <p>{{ $data->email ?? '' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 d-flex">
                                <div class="client-contact-info align-items-center">
                                    <div class="client-contact-info-icon">
                                        <img src="{{ asset('public/assets/admin-images/phone-icon.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Phone Number</h2>
                                        <p>+{{ $data->country ? $data->country->phonecode : '1' }}
                                            {{ $data->phonenumber ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 d-flex">
                                <div class="client-contact-info align-items-center">
                                    <div class="client-contact-info-icon">
                                        <img src="{{ asset('public/assets/admin-images/career.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Designation: Floor Technician</h2>
                                        <p>Working with 1+ years</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="client-contact-info-content align-items-center">
                                    <h2 class="text-center">Mark as Inactive</h2>
                                    <div class="toggle-btn justify-content-center d-flex">
                                        <input class='input-switch justify-content-center' type="checkbox" id="demo" />
                                        <label class="label-switch" for="demo"></label>
                                        <span class="info-text"></span><br>
                                    </div>
                                    <a href="{{ asset('public/upload/resume/') . '/' . $data->resume }}"
                                        download="{{ $data->resume }}" class="resume-btn"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-down-square me-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                                        </svg>Resume</a>
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
                                <li><a class="active" href="#Ongoing" data-bs-toggle="tab">Ongoing</a></li>
                                <li><a href="#Completed" data-bs-toggle="tab">Completed</a>
                                </li>
                            </ul>
                        </div>
                        <div class="Ongoing-calender-list">
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
                        </div>

                        <div class="tasks-content-info tab-content">
                            <div class="tab-pane active" id="Ongoing">
                                <div class="ongoing-services-list">
                                    @forelse ($services as $item)
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
                                                            src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/people.svg') }}">
                                                            </div>
                                                            <div class="service-shift-card-text">
                                                                <h2>Job Assigned:</h2>
                                                                <p>{{ $item->members->first() ? ($item->members->first()->member ? $item->members->first()->member->fullname : '') : '' }}

                                                                    @if ($item->members->count() - 1 > 0)
                                                                        <a
                                                                            href="{{ route('services.assign', $item->id) }}">
                                                                            + {{ $item->members->count() - 1 }}
                                                                            Employee</a>
                                                                    @else
                                                                        <a
                                                                            href="{{ route('services.assign', $item->id) }}">
                                                                            +

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
                                                                    src="{{ asset('public/assets/admin-images/ServiceFrequency.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/buildings.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/clock.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/clock.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
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
                                                        src="{{ asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? ($item->client ? $item->client->address : '') : 'N/A' }}
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
                                                            src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/people.svg') }}">
                                                            </div>
                                                            <div class="service-shift-card-text">
                                                                <h2>Job Assigned:</h2>
                                                                <p>{{ $item->members->first() ? ($item->members->first()->member ? $item->members->first()->member->fullname : '') : '' }}

                                                                    @if ($item->members->count() - 1)
                                                                        + <a
                                                                            href="{{ route('services.assign', $item->id) }}">{{ $item->members->count() - 1 }}
                                                                            Employee</a>
                                                                    @else
                                                                        <a
                                                                            href="{{ route('services.assign', $item->id) }}">+
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
                                                                    src="{{ asset('public/assets/admin-images/ServiceFrequency.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/buildings.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/clock.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/clock.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
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
                                                        src="{{ asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? ($item->client ? $item->client->address : '') : 'N/A' }}
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
                        <div class="team-panel-sidebar side-bar-1">
                            <h6 class="mb-0 pb-0">This Week Worked </h6>
                            <p class="hour-info text-center mt-0">{{ $this_week }} </p>
                            <h6 class="mb-0 pb-0 mt-3">Total Assigned Service Worked </h6>
                            <p class="hour-info text-center mt-0">{{ $total_hours }}</p>

                        </div>
                        {{-- <a href="#" class="view-roster-btn mt-3"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-eye me-2"
                                viewBox="0 0 16 16">
                                <path
                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                <path
                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>View Roster</a>
                        <div class="team-panel-sidebar mt-3 side-bar-2">
                            <h6 class="mb-0 pb-0">Average Check in time</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="count-no">
                                    <h6 class="mb-0 pb-0">10</h6>
                                    <p class="text-center">Ontime</p>
                                </div>
                                <div class="count-no">
                                    <h6 class="mb-0 pb-0">10</h6>
                                    <p class="text-center">Late</p>
                                </div>
                            </div>
                        </div>
                        <div class="team-panel-sidebar mt-3 side-bar-3">
                            <h6 class="mb-0 pb-0">Average Check out time</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="count-no">
                                    <h6 class="mb-0 pb-0">10</h6>
                                    <p class="text-center">Ontime</p>
                                </div>
                                <div class="count-no">
                                    <h6 class="mb-0 pb-0">10</h6>
                                    <p class="text-center">Late</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -----------------view map modal------------------ -->
    <div class="modal fade view-map" id="view-map" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="name-info">
                            <h5 class="mb-0 pb-0">Jane Doe</h5>
                            <p class="mb-0 pb-0 mt-0 pt-0">Location log</p>
                        </div>
                        <div class="d-flex">
                            <a href="#" class="check-in-btn">Check in: 11:04 PM</a>
                            <a href="#" class="check-out-btn ms-3">Check out: 11:04 PM</a>
                        </div>
                    </div>
                    <div class="map-detail mt-3">
                        <img src="{{ asset('public/assets/admin-images/map-info-image.svg') }}" alt="image"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
