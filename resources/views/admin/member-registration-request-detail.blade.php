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
                </a>Employee Pending Requests <b>({{ $count }})</b></h6>
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
                                <p>{{ $data->fullname ?? '' }}</p>
                                <h6 class="mt-2">{{ $data->email ?? '' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h6>Employee Id</h6>
                        <p class="mt-2">{{ $data->userid ?? '' }}</p>
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
                                <a href="{{ url('approve-member/' . encryptDecrypt('encrypt', $data->userid)) }}"
                                    class="approve-btn">Approve Request</a>
                            </div>
                            <div class="mt-2">
                                <a href="{{ url('reject-member/' . encryptDecrypt('encrypt', $data->userid)) }}"
                                    class="reject-btn">Reject Request</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-card member-info">
                <h6 class="title-head">Profile Details</h6>
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h6>Birth Date</h6>
                        <p class="mt-2">{{ date('M d,Y', strtotime($data->DOB)) }}
                            ({{ TotalYear(date('Y-m-d', strtotime($data->DOB))) }} Years)
                        </p>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h6>Job Applying For</h6>
                        <p class="mt-2">{{ Designation($data->designation_id) ?? '' }}</p>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h6>Number of Dependents</h6>
                        <p class="mt-2">{{ $data->dependents ?? '' }} Members</p>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h6>Address</h6>
                        <p class="mt-2">{{ $data->address ?? '' }}</p>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h6>Marital Status</h6>
                        <p class="mt-2">{{ ucfirst($data->marital_status) ?? '' }}</p>
                    </div>
                    @if (isset($data->resume_file_name))
                        <div class="col-md-12">
                            <div class="download-box">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex  align-items-center">
                                        <div>
                                            <img src="{{ custom_asset('public/assets/admin-images/pdf-file.svg') }}"
                                                alt="image" class="img-fluid">
                                        </div>
                                        <div class="sizes ms-3">
                                            <p>{{ ucfirst($data->resume_file_name) ?? '' }}</p>
                                            {{-- <p class="mb-size">{{ ucfirst($data->resume_file_size) ?? '' }} MB</p> --}}
                                        </div>
                                    </div>
                                    <a href="{{ env('APP_URL') . 'public/upload/resume/' . $data->resume_file_name }}"
                                        class="download-btn ms-5" target="_blank_">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path
                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
