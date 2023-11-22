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
                            <div class="side-profile-media"><img src="{{ asset('public/assets/admin-images/user-default.png') }}"></div>
                            <div class="side-profile-text ms-2">
                                <h2 class="mb-0 pb-0 ">{{ ($data->fullname) ?? ''}}</h2>
                                <p class="mb-0 pb-0 member-id">Member ID <b>{{ ($data->userid) ?? ''}}</b></p>
                                <h6 class="mt-0 pt-0 mb-0 pb-0 join-date">Joined on: {{ date('M d, Y', strtotime($data->created_at)) }}</h6>
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
                                        <p>{{ ($data->email) ?? ''}}</p>
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
                                        <p>+{{ ($data->phonenumber) ?? ''}}</p>
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
                                    <a href="#" class="resume-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor"
                                            class="bi bi-arrow-down-square me-2" viewBox="0 0 16 16">
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
                                <li><a class="active" href="#OngoingServices" data-bs-toggle="tab">Ongoing Services</a></li>
                                <li><a href="#UnAssignedServices" data-bs-toggle="tab"> Completed Services</a></li>
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
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#view-map"><img
                                                                    src="{{ asset('public/assets/admin-images/map-img.svg') }}"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <a href="#" class="check-in-btn">Check in: 11:04 PM</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="service-shift-card">
                                                        <a href="#" class="check-out-btn">Check in: 11:04 PM</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ongoing-services-item-foot">
                                            <div class="loaction-address"><img src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331 Rexford Court,
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
                                            <div class="loaction-address"><img src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331 Rexford Court,
                                                Montgomery AL 36116</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="team-panel-sidebar side-bar-1">
                            <h6 class="mb-0 pb-0">This Week Worked Hours</h6>
                            <p class="hour-info text-center mt-0">1368 Hours</p>
                            <h6 class="mb-0 pb-0 mt-3">Total Assigned Service Worked Hours</h6>
                            <p class="hour-info text-center mt-0">1368 Hours</p>
                            <a href="#" class="view-log-btn mt-3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-eye me-2"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>View Log</a>
                        </div>
                        <a href="#" class="view-roster-btn mt-3"><svg xmlns="http://www.w3.org/2000/svg"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -----------------view map modal------------------ -->
    <div class="modal fade view-map" id="view-map" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <img src="{{ asset('public/assets/admin-images/map-info-image.svg') }}" alt="image" class="img-fluid">
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection
