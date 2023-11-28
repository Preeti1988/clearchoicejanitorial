@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client-Details')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/client.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="client-details-section">
            <div class="client-profile-section">
                <div class="row g-1 align-items-center">
                    <div class="col-md-3">
                        <div class="side-profile-item">
                            <div class="side-profile-media"><img
                                    src="{{ asset('public/assets/admin-images/user-default.png') }}">
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
                                        <img src="{{ asset('public/assets/admin-images/email-icon.svg') }}">
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
                                        <img src="{{ asset('public/assets/admin-images/phone-icon.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Phone Number</h2>
                                        <p>+{{ $data->mobile_number ?? '' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="client-contact-info">
                                    <div class="client-contact-info-icon">
                                        <img src="{{ asset('public/assets/admin-images/map.svg') }}">
                                    </div>
                                    <div class="client-contact-info-content">
                                        <h2>Client Default Address</h2>
                                        <p>{{ $data->address ?? '' }}</p>
                                    </div>
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
                                <li><a class="active" href="#OngoingServices" data-bs-toggle="tab">Ongoing</a></li>
                                <li><a href="#UnAssignedServices" data-bs-toggle="tab"> New Request</a></li>
                                <li><a href="#CompletedServices" data-bs-toggle="tab">Completed</a></li>
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
                                        href="{{ route('ClientDetails', $data->id) . '?date=' . $item['date'] }}">
                                        <div class="Ongoing-calender-item">
                                            <h3>{{ $item['w'] }}</h3>
                                            <h2>{{ $item['d'] }}</h2>
                                        </div>
                                    </a>
                                @endforeach
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
                                                                <h2>Job Assigned</h2>
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
                                                                    src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
                                                            </div>
                                                            <div class="service-shift-card-text">
                                                                <h2>Price</h2>
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
                                                            src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/Qty.svg') }}">
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
                                                                    src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
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
                                                        src="{{ asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? $item->client->address : '' }}
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
                                                                <h2>Job Assigned</h2>
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
                                                                    src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
                                                            </div>
                                                            <div class="service-shift-card-text">
                                                                <h2>Price</h2>
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

                    <div class="col-md-4">
                        <div class="service-panel-sidebar">
                            <h2>{{ $data->name ?? '' }} Ongoing, Assigned & Completed Projects logs</h2>
                            <div class="service-log-media">
                                <img src="{{ asset('public/assets/admin-images/service-log-icon.svg') }}">
                            </div>

                            <div class="service-log-overview">
                                <h3>Total Projects {{ count($ongoing) }} Projects</h3>

                                <div class="service-log-item">
                                    <h2>01</h2>
                                    <p>ONTIME</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
