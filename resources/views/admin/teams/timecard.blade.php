@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client-Details')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/team-details.css') }}">
    <style>
        .timesheet {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background-color: #3498db;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            border-bottom: 2px solid #2980b9;
        }

        .week-number {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .week-details {
            padding: 15px;
        }

        .day-details {
            padding: 15px;
            border-bottom: 1px solid #ecf0f1;
            transition: background-color 0.3s ease;
        }

        .day-details:hover {
            background-color: #f2f2f2;
        }

        .day-details:last-child {
            border-bottom: none;
        }

        .day-date {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #3498db;
        }

        .time-details {
            display: flex;
            justify-content: space-between;
        }

        .time-icon {
            font-size: 24px;
            color: #3498db;
            margin-right: 2px;
        }
    </style>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="client-details-section">
            <div class="client-profile-section">
                <div class="row g-1 align-items-center">
                    <div class="col-md-3">
                        <div class="side-profile-item align-items-center">
                            <div class="side-profile-media"><img
                                    src="{{ custom_asset('public/assets/admin-images/user-default.png') }}"></div>
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
                                        <img src="{{ custom_asset('public/assets/admin-images/email-icon.svg') }}">
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
                                        <img src="{{ custom_asset('public/assets/admin-images/phone-icon.svg') }}">
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
                                        <img src="{{ custom_asset('public/assets/admin-images/career.svg') }}">
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
                                    <a href="{{ custom_asset('public/upload/resume/') . '/' . $data->resume }}"
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


            <div class="bg-white p-2 rounded">

                <form action="">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Filter</h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="month" id="" class="form-control rounded">
                                    <option value="0">Select Month</option>
                                    <?php
                                    $months = [
                                        '01' => 'January',
                                        '02' => 'February',
                                        '03' => 'March',
                                        '04' => 'April',
                                        '05' => 'May',
                                        '06' => 'June',
                                        '07' => 'July',
                                        '08' => 'August',
                                        '09' => 'September',
                                        '10' => 'October',
                                        '11' => 'November',
                                        '12' => 'December',
                                    ];
                                    
                                    foreach ($months as $monthNumber => $monthName) {
                                        if ((Request::has('month') && request('month') == $monthNumber) || $monthNumber == date('m')) {
                                            echo "<option value=\"$monthNumber\"  selected>$monthName</option>";
                                        } else {
                                            echo "<option value=\"$monthNumber\"  >$monthName</option>";
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="duration" id="" class="form-control rounded">

                                    <option value="weekly" @if (Request::has('duration') && request('duration') == 'weekly') selected @endif>weekly</option>
                                    <option value="biweekly" @if (Request::has('duration') && request('duration') == 'biweekly') selected @endif>biweekly
                                    </option>
                                    <option value="monthly" @if (Request::has('duration') && request('duration') == 'monthly') selected @endif>monthly
                                    </option>



                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary">
                                Apply
                            </button>
                        </div>
                    </div>
                </form>

                @forelse ($timesheet as $week)
                    <div class="week-details">
                        <div class="week-number">Week Number: <?php echo $week['week_number']; ?></div>
                        <div>Total Hours in Week: <?php echo $week['total_hours_in_week_format']; ?></div>
                        <div>Avg Hours in Week: <?php echo $week['avg_hours_in_week']; ?></div>
                        <div>Total Days Worked: <?php echo $week['total_days_worked']; ?></div>
                        <div class="row">
                            <?php foreach ($week['days'] as $day): ?>
                            <div class="p-2  col-md-4">
                                <div class="day-details px-4 py-2 shadow-sm">
                                    <h5>Date: <?php echo $day['date']; ?></h5>
                                    <div class="time-details">
                                        <div class="time-icon">🕒</div>
                                        <div>Start Time: <?php echo $day['start_time']; ?></div>
                                        &nbsp;
                                        &nbsp;

                                        <div class="time-icon">🕒</div>
                                        <div>End Time: <?php echo $day['end_time']; ?></div>
                                    </div>
                                    <div>Total Hours Worked on Day: <?php echo $day['total_hours_worked_on_day_format']; ?></div>
                                </div>
                            </div>

                            <?php endforeach; ?>
                        </div>


                    </div>
                @empty
                    <h4 class="p-2 text-center">No records exists</h4>
                @endforelse

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
                        <img src="{{ custom_asset('public/assets/admin-images/map-info-image.svg') }}" alt="image"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
