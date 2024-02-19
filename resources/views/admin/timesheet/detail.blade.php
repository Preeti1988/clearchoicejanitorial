@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Member-register-request')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ custom_asset('public/assets/admin-css/member-registration-request-view.css') }}">
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-plugins/fontawesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-plugins/fontawesome/css/font-awesome.min.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="d-flex a mb-3">
            <h6 class="p-0 member-reg-title total-count"><a href="{{ route('timesheet.requests') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left-circle-fill me-1 arrow-btn" viewBox="0 0 16 16">
                        <path
                            d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                </a>Member Timesheet Info </h6>
        </div>
        <div class="team-view-section">
            <div class="info-card">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="info-image">
                                <img src="{{ custom_asset('public/assets/admin-images/user-default.png') }}" alt="image"
                                    class="img-fluid">
                            </div>
                            <div class="name-info ms-3">
                                <p>{{ $request->member->fullname ?? '' }}</p>
                                <h6 class="mt-2">{{ $request->member->email ?? '' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h6>Employee Id</h6>
                        <p class="mt-2">{{ $request->member->userid ?? '' }}</p>
                    </div>
                    <div class="col-md-2">
                        <h6>Employee Type</h6>
                        <p class="mt-2">New Joinee</p>
                    </div>
                    <div class="col-md-2 account-status">
                        <h6>Request Status</h6>
                        <p class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                fill="currentColor" class="bi bi-circle-fill me-2" viewBox="0 0 16 16">
                                <circle cx="6" cy="6" r="6" />
                            </svg>
                            @if ($request->status == 'Approved')
                                Request Approved
                            @elseif ($request->status == 'Rejected')
                                Request Rejected
                            @else
                                Pending For Approval
                            @endif
                        </p>
                    </div>
                    @if ($request->status == 'Pending')
                        <div class="col-md-3">
                            <div class="text-end action-buttons">
                                <div>
                                    <a href="#" class="approve-btn"
                                        onclick="UpdateTimesheet('{{ $request->id }}','Approved')">Approve
                                        Request</a>
                                </div>
                                <div class="mt-2">
                                    <a href="#" class="reject-btn"
                                        onclick="UpdateTimesheet('{{ $request->id }}','Rejected')">Reject
                                        Request</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="info-card member-info">
                    <h6 class="title-head">Timesheet Details</h6>
                    <hr>
                    <div class = "time-card-head d-flex align-items-center">
                        <img src="{{ custom_asset('public/assets/admin-images/calendar-icon-img.png') }}" alt="image"
                            class="img-fluid me-2" style= "width: 25px; height: auto;border-radius: 0!important;">
                        <h4 class="week-number"> {{ $timesheet['start_period'] ?? 0 }} to
                            {{ $timesheet['end_period'] ?? 0 }}</h4>
                    </div>
                    <div class = "time-card-head d-flex align-items-center mt-3">
                        <img src="{{ custom_asset('public/assets/admin-images/working-hour.png') }}" alt="image"
                            class="img-fluid me-2" style= "width: 25px; height: auto;border-radius: 0!important;">
                        <h4 class = "hours-worked">Total Hours worked: {{ $timesheet['total_hours'] ?? 0 }}</h4>
                    </div>

                    @forelse ($timesheet['timesheet'] as $week)
                        <div class="week-details">


                            <div class="row">
                                @foreach ($week['days'] as $day)
                                    <div class="p-4  col-md-4">
                                        <div class="day-details px-4 py-2">
                                            <h5 class = "date-info">Date: <?php echo $day['date']; ?></h5>
                                            <h5 class = "date-info">Service Name: <?php echo $day['service_name']; ?></h5>

                                            <div class="time-details">

                                                <div class = "d-flex align-items-center card-time-detail-info mt-3">
                                                    <img src="{{ custom_asset('public/assets/admin-images/end-time-icon.png') }}"
                                                        alt="image" class="img-fluid me-2"
                                                        style= "width: 22px; height: auto;border-radius: 0!important;">
                                                    <h3 class = "time-sub-head">Start Time: <?php echo $day['start_time']; ?></h3>
                                                </div>
                                                <div class = "d-flex align-items-center card-time-detail-info mt-2">
                                                    <img src="{{ custom_asset('public/assets/admin-images/start-time-icon.png') }}"
                                                        alt="image" class="img-fluid me-2"
                                                        style= "width: 22px; height: auto;border-radius: 0!important;">
                                                    <h3>End Time: <?php echo $day['end_time']; ?></h3>
                                                </div>
                                            </div>
                                            <div class = "d-flex card-time-detail-info mt-2">
                                                <img src="{{ custom_asset('public/assets/admin-images/total-work-hours.png') }}"
                                                    alt="image" class="img-fluid me-2"
                                                    style= "width: 22px; height: auto;border-radius: 0!important;">
                                                <h3>Total Hours Worked on Day: <?php echo $day['total_hours_worked_on_day_format']; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    @empty
                        <h4 class="p-2 text-center">No records exists</h4>
                    @endforelse
                </div>
            </div>
        </div>
        <script>
            function UpdateTimesheet(id, status) {
                var _token = "{{ csrf_token() }}";
                $.post("{{ route('timesheet.update') }}", {
                    id,
                    status,
                    _token
                }, function(data, status) {
                    toastr.success(data.message);
                    setTimeout(() => {
                        location.replace("{{ route('timesheet.requests') }}")
                    }, 2000);
                });
            }
        </script>
    @endsection
