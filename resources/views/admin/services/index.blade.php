@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/service.css') }}">
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
                                                <h2 style="cursor: pointer"
                                                    onclick="location.replace('{{ route('services.edit', $item->id) }}')">
                                                    Service 1:
                                                    {{ $item->name }}</h2>
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
                                                    src="{{ custom_asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? ($item->client ? $item->client->address : '') : 'N/A' }}
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
                                                    src="{{ custom_asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? ($item->client ? $item->client->address : '') : 'N/A' }}
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
                            <h2>Total Completed Service</h2>
                            <h1>{{ $completed }}</h1>
                            {{-- <p><i class="las la-check-circle"></i> Completed</p> --}}
                        </div>
                        <div class="completedservice-overview-images">
                            <img src="{{ custom_asset('public/assets/admin-images/service-log-icon.svg') }}">
                        </div>
                    </div>

                    <div class="completedservice-overview">
                        <div class="completedservice-overview-content">
                            <h2>Total Earning Amount</h2>
                            <h1>${{ $earning }}</h1>
                            {{-- <p><i class="las la-check-circle"></i> Completed</p> --}}
                        </div>
                        <div class="completedservice-overview-images">
                            <img src="{{ custom_asset('public/assets/admin-images/Earning.svg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
