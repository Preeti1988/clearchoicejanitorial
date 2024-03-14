@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Member-register-request')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ custom_asset('public/assets/admin-css/member-registration-request.css') }}">
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-plugins/fontawesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-plugins/fontawesome/css/font-awesome.min.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="d-flex mb-2">
            <h6 class="p-0 total-count"><a href="{{ route('TeamActive') }}"><i class="fa fa-arrow-left" aria-hidden="true"
                        style="color: #7BC043"></i> </a> Members Pending Timesheets
                <b>({{ $count }})</b>
            </h6>
        </div>
        <div class="row align-items-center mb-3 my-2">
            <div class="col-md-5">
                <br>
                {{-- @if ($type == 1)
                                <form action="{{ route('search.team-member-active') }}" method="POST">
                                @else
                                    <form action="{{ route('search.team-member-inactive') }}"
                                        method="POST">
                                        @csrf
                            @endif --}}
                <form action="">

                    <div class="search-input">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Employee Name " name="search"
                                value="{{ request('search') ?? '' }}" aria-label="Recipient's username"
                                aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" style="background: #7BC043"
                                id="button-addon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button><a href="{{ route('timesheet.requests') }}" class="m-1 mx-3"><img
                                    src="{{ custom_asset('public/assets/admin-images/reset-icon.png') }}"
                                    style="height: 25px" alt=""></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="d-flex">
                    <a class="item" style="width:40%">
                        <div class="Ongoing-calender-item" style="padding: 3px">
                            <label for="">Start Date</label>
                            <input type="date" name="date" id="start_date" class="form-control"
                                value="{{ request()->has('start_date') ? request('start_date') : '' }}">
                        </div>
                    </a>
                    <a class="item" style="width:40%">
                        <div class="Ongoing-calender-item" style="padding: 3px">
                            <label for="">End Date</label>
                            <input type="date" name="date" id="end_date" class="form-control"
                                value="{{ request()->has('end_date') ? request('end_date') : '' }}">
                        </div>
                    </a>

                </div>
            </div>
            <div class="col-md-2 d-flex">

                <a href="{{ route('timesheet.requests') . '?filter=Pending' }}" class="view-btn">Pending Requests</a>
            </div>
        </div>
        <div class="team-view-section">
            @if ($requests->isEmpty())
                <tr>
                    <td colspan="11" class="text-center">
                        No record found
                    </td>
                </tr>
            @elseif(!$requests->isEmpty())
                @foreach ($requests as $val)
                    @if ($val->member)
                        <div class="info-card">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="info-image">
                                            <img src="{{ custom_asset('public/assets/admin-images/user-default.png') }}"
                                                alt="image" class="img-fluid">
                                        </div>
                                        <div class="name-info ms-3">
                                            <p>{{ $val->member->fullname ?? '' }}</p>
                                            <h6 class="mt-2">{{ $val->email ?? '' }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <h6>Employee Id</h6>
                                    <p class="mt-2">{{ $val->member->userid ?? '' }}</p>
                                </div>
                                <div class="col-md-2">
                                    <h6>Duration</h6>
                                    <p class="mt-2">{{ us_date($val->start_date) }} TO {{ us_date($val->end_date) }}
                                    </p>
                                </div>
                                <div class="col-md-2 account-status">
                                    <h6>Request Status</h6>
                                    <p class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-circle-fill me-2" viewBox="0 0 16 16">
                                            <circle cx="6" cy="6" r="6" />
                                        </svg>{{ $val->status }}</p>


                                </div>
                                <div class="col-md-2 account-status">
                                    <h6>Submission Date</h6>
                                    <p class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-circle-fill me-2" viewBox="0 0 16 16">
                                            <circle cx="6" cy="6" r="6" />
                                        </svg>{{ us_date($val->created_at) }}</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-end">
                                        <a href="{{ route('timesheet.detail', $val->id) }}" class="view-btn"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye me-2" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            <div class="d-flex justify-content-left">
                {{ $requests->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <script>
        // Function to validate dates and redirect
        function validateAndRedirect() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            // Check if both start and end dates are selected
            if (startDate && endDate) {
                // Convert dates to Date objects
                var startDateObj = new Date(startDate);
                var endDateObj = new Date(endDate);

                // Check if start date is less than end date
                if (startDateObj < endDateObj) {
                    // Redirect with parameters
                    var redirectUrl = window.location.origin + window.location.pathname + '?start_date=' + startDate +
                        '&end_date=' + endDate;
                    window.location.href = redirectUrl;
                } else {
                    toastr.error('End date must be after start date.');
                }
            }
        }

        // Event listener for end date change
        document.getElementById('end_date').addEventListener('change', validateAndRedirect);
    </script>

@endsection
