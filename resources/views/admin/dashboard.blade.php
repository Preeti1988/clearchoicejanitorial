@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/assets/admin-css/home.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="overview-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-card">
                        <div class="overview-card-frant">
                            <div class="overview-card-text">
                                <h3>543</h3>
                                <p>Total Services</p>
                            </div>
                            <div class="overview-card-media">
                                <img src="{{ asset('public/assets/admin-images/service.svg') }}">
                            </div>
                        </div>
                        <div class="overview-card-back">
                            <div class="overview-back-text">
                                <p>Total Ongoing Services: <b>24</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="overview-card">
                        <div class="overview-card-frant">
                            <div class="overview-card-text">
                                <h3>122</h3>
                                <p>Team Members </p>
                            </div>
                            <div class="overview-card-media">
                                <img src="{{ asset('public/assets/admin-images/Team.svg') }}">
                            </div>
                        </div>
                        <div class="overview-card-back">
                            <div class="overview-back-text">
                                <p>New Registrations Requests: <b>05</b></p>
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
                            <li><a href="#UnAssignedServices" data-bs-toggle="tab"><i class="las la-eye-slash"></i>
                                    Un-Assigned Services</a>
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
                                                        <img src="{{ asset('public/assets/admin-images/Qty.svg') }}">
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
                                                        <img src="{{ asset('public/assets/admin-images/ServiceFrequency.svg') }}">
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
                                                        <img src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
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
                                        <div class="loaction-address"><img src="{{ asset('public/assets/admin-images/map.svg') }}">
                                            5331 Rexford Court, Montgomery AL 36116</div>
                                    </div>
                                </div>

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
                                                        <img src="{{ asset('public/assets/admin-images/Qty.svg') }}">
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
                                                        <p>Monthly</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
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
                                                src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331 Rexford Court,
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
                                                <img src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
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
                                                        <img src="{{ asset('public/assets/admin-images/Qty.svg') }}">
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
                                                        <p>Monthly</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="service-shift-card">
                                                    <div class="service-shift-card-image">
                                                        <img src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
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
                                                src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331 Rexford Court,
                                            Montgomery AL 36116</div>
                                        <div class="ongoing-services-action"><a href="#">Assign Team Member</a>
                                        </div>
                                    </div>
                                </div>
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
                                <h2>New Messages <span>08 New</span></h2>
                            </div>
                        </div>
                        <div class="chat-panel-sidebar-body">
                            <div class="chat-panel-sidebar-scroll">
                                <div class="chat-panel-sidebar-action">
                                    <a class="sendbroadcast-btn" href="#">Send Broadcast Message</a>
                                </div>
                                <div class="chat-panel-sidebar-list">
                                    <div class="chat-panel-sidebar-item">
                                        <div class="chat-panel-sidebar-item-image">
                                            <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                        </div>
                                        <div class="chat-panel-sidebar-item-text">
                                            <h2>John</h2>
                                            <div class="msg-text-info">What’s should I do…?</div>
                                        </div>
                                    </div>

                                    <div class="chat-panel-sidebar-item">
                                        <div class="chat-panel-sidebar-item-image">
                                            <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                        </div>
                                        <div class="chat-panel-sidebar-item-text">
                                            <h2>KETTY P</h2>
                                            <div class="msg-text-info">Hey please reponse sir..</div>
                                        </div>
                                    </div>

                                    <div class="chat-panel-sidebar-item">
                                        <div class="chat-panel-sidebar-item-image">
                                            <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                        </div>
                                        <div class="chat-panel-sidebar-item-text">
                                            <h2>Hoàng Ðắc Cường</h2>
                                            <div class="msg-text-info">I’m waiting for your response</div>
                                        </div>
                                    </div>

                                    <div class="chat-panel-sidebar-item">
                                        <div class="chat-panel-sidebar-item-image">
                                            <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                        </div>
                                        <div class="chat-panel-sidebar-item-text">
                                            <h2>Vũ Hải Bằng</h2>
                                            <div class="msg-text-info">Please review the phot…</div>
                                        </div>
                                    </div>

                                    <div class="chat-panel-sidebar-item">
                                        <div class="chat-panel-sidebar-item-image">
                                            <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                        </div>
                                        <div class="chat-panel-sidebar-item-text">
                                            <h2>Hoàng Ðắc Cường</h2>
                                            <div class="msg-text-info">What will be my shift timing..</div>
                                        </div>
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
