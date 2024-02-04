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
        <div class="d-flex mb-2">
            <h6 class="p-0 total-count"><a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left-circle-fill me-2 arrow-btn" viewBox="0 0 16 16">
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
                        <h6>Account Status</h6>
                        <p class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                fill="currentColor" class="bi bi-circle-fill me-2" viewBox="0 0 16 16">
                                <circle cx="6" cy="6" r="6" />
                            </svg>Pending For Approval</p>
                    </div>
                    <div class="col-md-3">
                        <div class="text-end action-buttons">
                            <div>
                                <a href="#" class="approve-btn">Approve Request</a>
                            </div>
                            <div class="mt-2">
                                <a href="#" class="reject-btn">Reject Request</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-card member-info">
                <h6 class="title-head">Timesheet Details</h6>
                <hr>

            </div>
        </div>
    </div>
@endsection
