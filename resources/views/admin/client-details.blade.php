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

                                <div class="side-profile-media"><img
                                        src="{{ asset('public/assets/admin-images/user-default.png') }}"></div>
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

                                            <p>{{ $data->email_address ?? '' }}</p>


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
                                            <p>{{ $data->mobile_number ?? '' }}</p>

                                            <p>{{ $data->mobile_number ?? '' }}</p>


                                            <p>{{ $data->mobile_number ?? '' }}</p>

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

                                            <p>{{ $data->address ?? '' }}</p>


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
                                    <li><a href="#UnAssignedServices" data-bs-toggle="tab">Completed</a></li>
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
                                <div class="tab-pane active" id="OngoingServices">
                                    <div class="ongoing-services-list">
                                        <div class="ongoing-services-item">
                                            <div class="ongoing-services-item-head">
                                                <div class="ongoing-services-item-title">
                                                    <div class="services-id">#6828823</div>
                                                    <h2>Service 1: Testla Motors HQ</h2>
                                                </div>
                                                <div class="ongoing-services-date">Tuesday, 10 Aug 09:02:17 pm</div>
                                            </div>
                                            <div class="ongoing-services-item-body">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img
                                                            src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">

                                                        <img
                                                            src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">


                                                        <img
                                                            src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">

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
                                                                <img
                                                                    src="{{ asset('public/assets/admin-images/people.svg') }}">

                                                                <img
                                                                    src="{{ asset('public/assets/admin-images/people.svg') }}">


                                                                <img
                                                                    src="{{ asset('public/assets/admin-images/people.svg') }}">

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

                                                                <img
                                                                    src="{{ asset('public/assets/admin-images/ServiceFrequency.svg') }}">


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
                                                                    src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">

                                                                <img
                                                                    src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">


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
                                                        src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331
                                                    Rexford
                                                    Court,

                                                    <div class="loaction-address"><img
                                                            src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331
                                                        Rexford Court,

                                                        Montgomery AL 36116</div>

                                                    <div class="loaction-address"><img
                                                            src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331
                                                        Rexford Court,
                                                        Montgomery AL 36116</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="UnAssignedServices">
                                        <div class="ongoing-services-list">
                                            <div class="ongoing-services-item">
                                                <div class="ongoing-services-item-head">
                                                    <div class="ongoing-services-item-title">
                                                        <div class="services-id">#6828823</div>
                                                        <h2>Service 1: Move In /Move Out Cleaning Services</h2>
                                                    </div>
                                                    <div class="ongoing-services-date">Tuesday, 10 Aug 09:02:17 pm</div>
                                                </div>
                                                <div class="ongoing-services-item-body">
                                                    <div class="service-shift-card">
                                                        <div class="service-shift-card-image">
                                                            <img
                                                                src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">

                                                            <img
                                                                src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">


                                                            <img
                                                                src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">

                                                        </div>
                                                        <div class="service-shift-card-text">
                                                            <h2>Service Shift Timing:</h2>
                                                            <p>11:00AM-02:00PM</p>
                                                        </div>
                                                    </div>

                                                    <div class="instructions-text">
                                                        <h3>Every room kitchen bathroom living room bedroom</h3>
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

                                                                    <img
                                                                        src="{{ asset('public/assets/admin-images/ServiceFrequency.svg') }}">


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
                                                                        src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">

                                                                    <img
                                                                        src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">


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
                                                            src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331
                                                        Rexford
                                                        Court,

                                                        <div class="loaction-address"><img
                                                                src="{{ asset('public/assets/admin-images/map.svg') }}">
                                                            5331
                                                            Rexford Court,

                                                            Montgomery AL 36116</div>
                                                        <div class="ongoing-services-action"><a href="#">Assign Team
                                                                Member</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="service-panel-sidebar">
                                        <h2>Kitty Ongoing, Assigned & Completed Projects logs</h2>
                                        <div class="service-log-media">
                                            <img src="{{ asset('public/assets/admin-images/service-log-icon.svg') }}">
                                        </div>

                                        <div class="service-log-overview">
                                            <h3>Total Projects 12 Projects</h3>

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
