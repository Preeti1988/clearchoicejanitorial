@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Create-schedular')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/create-schedular.css') }}">
@endpush
@section('content')
<div class="body-main-content">
    <div class="client-details-section">
        <div class="d-flex mb-3">
            <a class="schedular-top-btn" href="#" data-popup-target="editDetailsPopup" data-bs-toggle="modal"
                data-bs-target="#editDetails">Create Service</a>
            <a class="schedular-top-btn white-btn bg-white ms-3" href="#" data-popup-target="editDetailsPopup"
                data-bs-toggle="modal" data-bs-target="#editDetails">Un-assigned projects</a>
        </div>
        <div class="client-profile-section">
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Service Name</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Client</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                Default radio
                                </label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2">
                                Default radio
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Project
                                Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="ongoing-Services-section">
            <div class="row">
                <div class="col-md-12">
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
                                                <img src="{{ asset('assets/admin-images/calendar-tick.svg') }}">
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
                                                        <img src="{{ asset('assets/admin-images/people.svg') }}">
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
                                                        <img src="{{ asset('assets/admin-images/Qty.svg') }}">
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
                                                        <img src="{{ asset('assets/admin-images/ServiceFrequency.svg') }}">
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
                                                        <img src="{{ asset('assets/admin-images/dollar-circle.svg') }}">
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
                                        <div class="loaction-address"><img src="{{ asset('assets/admin-images/map.svg') }}"> 5331
                                            Rexford Court, Montgomery AL 36116</div>
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
                                                <img src="{{ asset('assets/admin-images/calendar-tick.svg') }}">
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
                                                        <img src="{{ asset('assets/admin-images/Qty.svg') }}">
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
                                                        <img src="{{ asset('assets/admin-images/ServiceFrequency.svg') }}">
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
                                                        <img src="{{ asset('assets/admin-images/dollar-circle.svg') }}">
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
                                        <div class="loaction-address"><img src="{{ asset('assets/admin-images/map.svg') }}"> 5331
                                            Rexford Court, Montgomery AL 36116</div>
                                        <div class="ongoing-services-action"><a href="#">Assign Team
                                                Member</a></div>
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