@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/service-details.css') }}">
    <style>
        input[type="date"] {
            border: none;
            outline: none;
        }
    </style>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="top-head">
            <div class="serviceid service-border">
                <p><i class="fa fa-th-list me-2"></i>Service ID <b class="id-bg">6828823</b></p>
            </div>
            <div class="serviceid service-border">
                <p>Janitorial & Projects</p>
            </div>
            <div class="serviceid">
                <p>Janitorial & Projects</p>
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
                            <div class="service-shift-card content-between">
                                <div style="display: flex;">
                                    <div class="service-shift-card-image">
                                        <img src="{{ asset('public/assets/admin-images/calendar-tick.svg') }}">
                                    </div>
                                    <div class="service-shift-card-text">
                                        <h2>Service Shift Timing:</h2>
                                        <p>11:00AM-02:00PM</p>
                                    </div>
                                </div>
                                <a class="send-message-btn" href="#">Send Broadcast Message</a>
                            </div>

                            <div class="instructions-text">
                                <h3>Primary Instructions: Clean the CEO’S Cabin at lunch</h3>
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
                                            <img src="{{ asset('public/assets/admin-images/dollar-circle.svg') }}">
                                        </div>
                                        <div class="service-shift-card-text">
                                            <h2>Price</h2>
                                            <p>$299.00 + Tax Included</p>
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
                            </div>
                        </div>
                        <div class="ongoing-services-item-foot">
                            <div class="loaction-address"><img src="{{ asset('public/assets/admin-images/map.svg') }}"> 5331
                                Rexford Court, Montgomery AL 36116
                            </div>
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
                                    <p>11:00AM-02:00PM hhhh</p>
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
                                5331 Rexford Court, Montgomery AL 36116
                            </div>
                            <div class="ongoing-services-action"><a href="#">Assign Team Member</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="client-details-section">
            <div class="row">
                <div class="col-md-7">
                    <div class="service-section">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-img-bg">
                                    <img src="{{ asset('public/assets/admin-images/calendar-img.svg') }}" alt="image">
                                </div>
                                <h5>Scheduled</h5>
                                <p class="sub-text">Tuesday, 10 Aug 09:10 am - 10:10 am </p>
                                <p class="sub-text">Arrive by 7:30 pm</p>
                            </div>
                            <div class="col-md-4">
                                <div class="card-img-bg">
                                    <img src="{{ asset('public/assets/admin-images/team-member.svg') }}" alt="image">
                                </div>
                                <h5>Team Member <br> Assigned</h5>
                            </div>
                            <div class="col-md-4">
                                <div class="card-img-bg">
                                    <img src="{{ asset('public/assets/admin-images/job-image.svg') }}" alt="image">
                                </div>
                                <h5>Finish Job</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="service-section note-section">
                        <div class="note-head">
                            <div class="note-bg">
                                <img src="{{ asset('public/assets/admin-images/notes.svg') }}" alt="image">
                            </div>
                            <h5>Notes</h5>
                        </div>
                        <p>Restoration - Periodic Restoration Restroom and Office Cabin (2 Commercial Bathrooms)</p>
                        <div class="info">
                            <p><i class="fa fa-info-circle"></i>Infornation 1: <b>N/A</b></p>
                        </div>
                        <div class="info">
                            <p><i class="fa fa-info-circle"></i>Infornation 2: <b>Restroom and Office Cabin</b></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ongoing-Services-section service-section">
                <div class="home-demo">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="calendar-card">
                                <div class="calendar-card-img">
                                    <img src="{{ asset('public/assets/admin-images/pay-period.svg') }}" alt="image">
                                </div>
                                <h6>Service Pay Period</h6>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Select</option>
                                    <option value="1">7 x week</option>
                                    <option value="2">2 x month</option>
                                    <option value="3">Monthly</option>
                                    <option value="2">Quaterly</option>
                                    <option value="3">Annualy</option>
                                    <option value="2">2 x annualy</option>
                                    <option value="3">One Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="item">
                            <div class="calendar-card">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="date-detail-1">
                                            <div class="calendar-card-img">
                                                <img src="{{ asset('public/assets/admin-images/start-date.svg') }}"
                                                    alt="image">
                                            </div>
                                            <h6>Service Start Time</h6>
                                            <input type="date" id="date-info" name="date-info">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-detail-2">
                                            <div class="calendar-card-img">
                                                <img src="{{ asset('public/assets/admin-images/end-date.svg') }}"
                                                    alt="image">
                                            </div>
                                            <h6>Service End Time</h6>
                                            <input type="date" id="date-info" name="date-info">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="calendar-card">
                                <div class="calendar-card-img">
                                    <img src="{{ asset('public/assets/admin-images/work-hours.svg') }}" alt="image">
                                </div>
                                <h6>Total Worked Hours Till Now</h6>
                                <h5>N/A</h5>
                            </div>
                        </div>
                        <div class="item">
                            <div class="calendar-card">
                                <div class="calendar-card-img">
                                    <img src="{{ asset('public/assets/admin-images/week-hours.svg') }}" alt="image">
                                </div>
                                <h6>This Week Worked Hours</h6>
                                <h5>N/A</h5>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-btns">
                        <a class="cancel-message-btn" href="#">Cancel</a>
                        <a class="save-changes" href="#">Save Changes</a>
                    </div>
                </div>

                <script>
                    $(function() {
                        var owl = $(".owl-carousel");
                        owl.owlCarousel({
                            items: 3,
                            margin: 10,
                            loop: true,
                            nav: true
                        });
                    });
                </script>
            </div>
            <div class="to-do-assign">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ongoing-services-item">
                            <div class="ongoing-services-item-head">
                                <div class="todo-title ongoing-services-item-title">
                                    <div class="to-do-img">
                                        <img src="{{ asset('public/assets/admin-images/to-do-img.svg') }}"
                                            alt="">
                                    </div>
                                    <h2>To-do List</h2>
                                </div>
                            </div>
                            <div class="ongoing-services-item-body">
                                <div class="instructions-text">
                                    <h3><b>0</b>/4 Completed</h3>
                                    <p>4 Pending Services</p>
                                </div>

                                <div class="todo-items">
                                    <ul>
                                        <li><i class="fa fa-check-circle"></i>Vacuum first</li>
                                        <li><i class="fa fa-check-circle"></i>Dusting</li>
                                        <li><i class="fa fa-check-circle"></i>Floor Cleaing</li>
                                        <li><i class="fa fa-check-circle"></i>Desk Cleaning</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ongoing-services-item">
                            <div class="ongoing-services-item-head">
                                <div class="todo-title ongoing-services-item-title">
                                    <div class="to-do-img">
                                        <img src="{{ asset('public/assets/admin-images/field-tech.svg') }}"
                                            alt="">
                                    </div>
                                    <h2>Field Tech Status</h2>
                                </div>
                            </div>
                            <div class="ongoing-services-item-body">
                                <div class="row assign-row">
                                    <div class="col-md-5">
                                        <img src="{{ asset('public/assets/admin-images/assign-employee.svg') }}"
                                            alt="image" class="assign-img">
                                    </div>
                                    <div class="col-md-7">
                                        <h4 class="assign-title">No Employee Assigned For This Project</h4>
                                        <a class="assign-btn" href="#" data-bs-toggle="modal"
                                            data-bs-target="#assign-employee-modal">Assign Employee</a>
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
