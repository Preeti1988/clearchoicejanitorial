@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Member-register-request')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/member-registration-request.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/admin-plugins/fontawesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/admin-plugins/fontawesome/css/font-awesome.min.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="d-flex mb-2">
            <h6 class="p-0 total-count">Employee Pending Requests <b>({{$count}})</b></h6>
        </div>
        <div class="team-view-section">
            @if ($datas->isEmpty())
                <tr>
                    <td colspan="11" class="text-center">
                        No record found
                    </td>
                </tr>
            @elseif(!$datas->isEmpty())
                @foreach ($datas as $val)
                    <div class="info-card">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="info-image">
                                        <img src="{{ asset('public/assets/admin-images/profile-img.jpg') }}" alt="image"
                                            class="img-fluid">
                                    </div>
                                    <div class="name-info ms-3">
                                        <p>{{ ($val->fullname) ?? ''}}</p>
                                        <h6 class="mt-2">{{ ($val->email) ?? '' }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <h6>Employee Id</h6>
                                <p class="mt-2">{{ ($val->userid) ?? '' }}</p>
                            </div>
                            <div class="col-md-2">
                                <h6>Employee Type</h6>
                                <p class="mt-2">New Joinee</p>
                            </div>
                            <div class="col-md-3 account-status">
                                <h6>Account Status</h6>
                                <p class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="bi bi-circle-fill me-2" viewBox="0 0 16 16">
                                        <circle cx="6" cy="6" r="6" />
                                    </svg>Pending For Approval</p>
                            </div>
                            <div class="col-md-2">
                                <div class="text-end">
                                    <a href="{{ url('member-request-detail/' . encryptDecrypt('encrypt', $val->userid)) }}" class="view-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-eye me-2" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="d-flex justify-content-left">
                {{ $datas->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
