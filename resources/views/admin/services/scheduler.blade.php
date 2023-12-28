@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/home.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ custom_asset('public/assets/admin-plugins/OwlCarousel/assets/owl.carousel.min.css') }}" />
    <script src="{{ custom_asset('public/assets/admin-plugins/OwlCarousel/owl.carousel.js') }}" type="text/javascript">
    </script>
    <style>
        #search-results {
            position: absolute;
            top: calc(100% - 40px);
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none;
        }

        #search-results .result-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }

        #search-results .result-item:hover {
            background-color: #f0f0f0;
        }
    </style>
@endpush
@section('content')
    <div class="body-main-content">
        {{-- <div class="assign-Services-heading">
            <h2>Service Scheduler</h2>
        </div> --}}

        <div class="assign-Services-section">

            <div class="ongoing-Services-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="services-tabs">
                            <ul class="nav nav-tabs">
                                <li><a href="{{ route('services.create') }}">Create Service</a></li>
                                <li><a class="active" href="#UnAssignedServices" data-bs-toggle="tab"><i
                                            class="las la-eye-slash"></i>
                                        Un-Assigned Services</a>
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
                                    <a class="item" href="{{ route('services.scheduler', 'date=' . $item['date']) }}">
                                        <div class="Ongoing-calender-item">
                                            <h3>{{ $item['w'] }}</h3>
                                            <h2>{{ $item['d'] }}</h2>
                                        </div>
                                    </a>
                                @endforeach


                            </div>
                        </div>
                        <div class="tasks-content-info tab-content">
                            <div class="tab-pane " id="OngoingServices">

                            </div>
                            <div class="tab-pane active" id="UnAssignedServices">
                                <div class="ongoing-services-list">
                                    @forelse ($services as $item)
                                        <div class="ongoing-services-item">
                                            <div class="ongoing-services-item-head">
                                                <div class="ongoing-services-item-title">
                                                    <div class="services-id">#{{ $item->id }}</div>
                                                    <h2 style="cursor: pointer"
                                                        onclick="location.replace('{{ route('services.edit', $item->id) }}') ">
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
                                                        src="{{ custom_asset('public/assets/admin-images/map.svg') }}">{{ isset($item->client->address) ? $item->client->address : '' }}
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


                </div>
            </div>
        </div>

    @endsection
