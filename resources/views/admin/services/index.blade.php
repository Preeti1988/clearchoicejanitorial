@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/service.css') }}">
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
                            <div class="item">
                                <div class="Ongoing-calender-item">
                                    <h3>Sun</h3>
                                    <h2>01</h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="Ongoing-calender-item">
                                    <h3>Mon</h3>
                                    <h2>02</h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="Ongoing-calender-item">
                                    <h3>Tue</h3>
                                    <h2>03</h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="Ongoing-calender-item">
                                    <h3>Wed</h3>
                                    <h2>04</h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="Ongoing-calender-item">
                                    <h3>Thu</h3>
                                    <h2>05</h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="Ongoing-calender-item">
                                    <h3>Fri</h3>
                                    <h2>06</h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="Ongoing-calender-item">
                                    <h3>Sat</h3>
                                    <h2>07</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tasks-content-info tab-content">
                        <div class="tab-pane active" id="Ongoing">
                            <div class="ongoing-services-list">
                                @foreach ($services as $item)
                                    <div class="ongoing-services-item">
                                        <div class="ongoing-services-item-head">
                                            <div class="ongoing-services-item-title">
                                                <div class="services-id">#{{ $item->id }}</div>
                                                <h2>Service 1: {{ $item->scheduled_for }}</h2>
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
                                                    <img src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
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
                                                            <img src="{{ asset('public/assets/admin-images/people.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Job Assigned</h2>
                                                            <p>John Doe + <a href="#">12 Employee</a></p>
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
                                                            <img src="{{ asset('public/assets/admin-images/clock.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Start Time:</h2>
                                                            <p>{{ date('d-m-y', strtotime($item->created_date)) }},
                                                                10:30</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img src="{{ asset('public/assets/admin-images/clock.svg') }}">
                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service End Time:</h2>
                                                            <p>{{ date('d-m-y', strtotime($item->scheduled_end_date)) }},
                                                                10:30</p>
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
                                                    src="{{ asset('public/assets/admin-images/map.svg') }}">{{ $item->client ? $item->client->address : 'N/A' }}
                                            </div>
                                            <div class="ongoing-services-date">
                                                {{ date('l, j M h:i:s A', strtotime($item->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach



                            </div>
                        </div>

                        <div class="tab-pane" id="Completed">
                            <div class="ongoing-services-list">
                                <div class="ongoing-services-item">
                                    <div class="ongoing-services-item-head">
                                        <div class="ongoing-services-item-title">
                                            <div class="services-id">#6828823</div>
                                            <h2>Service 1: Testla Motors HQ</h2>
                                        </div>
                                        <div class="client-info">
                                            <div class="client-info-icon">NA</div>
                                            <div class="client-info-text"> Neeti Alex</div>
                                        </div>

                                    </div>
                                    <div class="ongoing-services-item-body">
                                        <div class="service-shift-card">
                                            <div class="service-shift-card-image">
                                                <img src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
                                            </div>
                                            <div class="service-shift-card-text">
                                                <h2>Service Shift Timing:</h2>
                                                <p>11:00AM-02:00PM</p>
                                            </div>
                                        </div>

                                        <div class="instructions-text">
                                            <h3>Primary Instructions: Clean the CEO’S Cabin at lunch</h3>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/people.svg') }}">
                                                    </div>
                                                    <div class="service-shift-card-text">
                                                        <h2>Job Assigned</h2>
                                                        <p>John Doe + <a href="#">12 Employee</a></p>
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
                                                        <p>Monthly</p>
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
                                                        <p>commercial</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/clock.svg') }}">
                                                    </div>
                                                    <div class="service-shift-card-text">
                                                        <h2>Service Start Time:</h2>
                                                        <p>2023-11-13, 10:30</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/clock.svg') }}">
                                                    </div>
                                                    <div class="service-shift-card-text">
                                                        <h2>Service End Time:</h2>
                                                        <p>2023-11-13, 10:30</p>
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
                                                        <p>$299.00 + Tax Included</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ongoing-services-item-foot">
                                        <div class="loaction-address"><img
                                                src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331 Rexford
                                            Court,
                                            Montgomery AL 36116</div>
                                        <div class="ongoing-services-date">Tuesday, 10 Aug 09:02:17 pm</div>
                                    </div>
                                </div>

                                <div class="ongoing-services-item">
                                    <div class="ongoing-services-item-head">
                                        <div class="ongoing-services-item-title">
                                            <div class="services-id">#6828823</div>
                                            <h2>Service 1: Testla Motors HQ</h2>
                                        </div>
                                        <div class="client-info">
                                            <div class="client-info-icon">NA</div>
                                            <div class="client-info-text"> Neeti Alex</div>
                                        </div>

                                    </div>
                                    <div class="ongoing-services-item-body">
                                        <div class="service-shift-card">
                                            <div class="service-shift-card-image">
                                                <img src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
                                            </div>
                                            <div class="service-shift-card-text">
                                                <h2>Service Shift Timing:</h2>
                                                <p>11:00AM-02:00PM</p>
                                            </div>
                                        </div>

                                        <div class="instructions-text">
                                            <h3>Primary Instructions: Clean the CEO’S Cabin at lunch</h3>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/people.svg') }}">
                                                    </div>
                                                    <div class="service-shift-card-text">
                                                        <h2>Job Assigned</h2>
                                                        <p>John Doe + <a href="#">12 Employee</a></p>
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
                                                        <p>Monthly</p>
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
                                                        <p>commercial</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/clock.svg') }}">
                                                    </div>
                                                    <div class="service-shift-card-text">
                                                        <h2>Service Start Time:</h2>
                                                        <p>2023-11-13, 10:30</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/clock.svg') }}">
                                                    </div>
                                                    <div class="service-shift-card-text">
                                                        <h2>Service End Time:</h2>
                                                        <p>2023-11-13, 10:30</p>
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
                                                        <p>$299.00 + Tax Included</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ongoing-services-item-foot">
                                        <div class="loaction-address"><img
                                                src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331 Rexford
                                            Court,
                                            Montgomery AL 36116</div>
                                        <div class="ongoing-services-date">Tuesday, 10 Aug 09:02:17 pm</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="completedservice-overview">
                        <div class="completedservice-overview-content">
                            <h2>Total completed service</h2>
                            <h1>56</h1>
                            <p><i class="las la-check-circle"></i> Completed</p>
                        </div>
                        <div class="completedservice-overview-images">
                            <img src="{{ asset('public/assets/admin-images/service-log-icon.svg') }}">
                        </div>
                    </div>

                    <div class="completedservice-overview">
                        <div class="completedservice-overview-content">
                            <h2>Total Ammout Earning</h2>
                            <h1>$4562.50</h1>
                            <p><i class="las la-check-circle"></i> Completed</p>
                        </div>
                        <div class="completedservice-overview-images">
                            <img src="{{ asset('public/assets/admin-images/Earning.svg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
