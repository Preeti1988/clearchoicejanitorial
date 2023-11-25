@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Profile')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/assets/admin-css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/admin-plugins/fontawesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/admin-plugins/fontawesome/css/font-awesome.min.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="profile-card-contents">
            <div class="profile-item-head">
                <div class="profile-item-title d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="profile-card-image">
                            <img src="{{ asset('public/assets/admin-images/admin-profile.svg') }}">
                        </div>
                        <div class="profile-card-head">
                            <h2 class="ms-2 mb-0">Profile Overview</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="owner-details  mt-4 d-flex align-items-center">
                            <img src="{{ asset('public/assets/admin-images/user-default.png') }}" alt="image"
                                class="img-fluid">
                            <div class="name-details ms-3">
                                <p class="info-title">Owner's Name</p>
                                <h4 class="mt-3">{{ Auth::user()->fullname ?? '' }}</h4>
                            </div>
                        </div>
                        <div class="d-flex action-btns mt-5 mb-5">
                            <div class="">
                                <div class="add-new-master">
                                    <a class="add-new-service-btn" href="#" data-popup-target="editDetailsPopup"
                                        data-bs-toggle="modal" data-bs-target="#editDetails">Edit Details</a>
                                    <div class="popup" id="editDetailsPopup">
                                        Last updated on 26 Aug 06:02:17pm
                                    </div>
                                </div>
                            </div>
                            <div class="ms-3 change-password">
                                <div class="add-new-master">
                                    <a class="add-new-service-btn bg-white" href="#"
                                        data-popup-target="changePasswordPopup" data-bs-toggle="modal"
                                        data-bs-target="#changePassword">Change Password</a>
                                    <div class="popup" id="changePasswordPopup">
                                        Last updated on 26 Aug 06:02:17pm
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="details-card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="icon-image">
                                            <img src="{{ asset('public/assets/admin-images/envelope.svg') }}" alt="image"
                                                class="img-fluid">
                                        </div>
                                        <div class="detail-info ms-3">
                                            <p class="mb-0 info-title">Email Address</p>
                                            <h5 class="mt-0">{{ Auth::user()->email ?? '' }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="icon-image">
                                            <img src="{{ asset('public/assets/admin-images/phone-call.svg') }}"
                                                alt="image" class="img-fluid">
                                        </div>
                                        <div class="detail-info ms-3">
                                            <p class="mb-0 info-title">Phone Number</p>
                                            <h5 class="mt-0">{{ Auth::user()->phonenumber ?? '' }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="d-flex">
                                        <div class="icon-image">
                                            <img src="{{ asset('public/assets/admin-images/address.svg') }}" alt="image"
                                                class="img-fluid">
                                        </div>
                                        <div class="detail-info ms-3">
                                            <p class="mb-0 info-title">Address</p>
                                            <h5 class="mt-0">{{ Auth::user()->address ?? '' }}</h5>
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

    <!-- edit-details Modal -->
    <div class="modal fade" id="editDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('UpdateUser') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userid" value="{{ Auth::user()->userid }}">
                        <h5 class="text-center">Edit Profile Details</h5>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="recipient-name" name="fullname"
                                placeholder="Enter your name" value="{{ Auth::user()->fullname }}"required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email Id</label>
                            <input type="email" class="form-control" id="email-id"
                                name="email"value="{{ Auth::user()->email }}" placeholder="Enter your email id"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Phone No.</label>
                            <input type="text" class="form-control"name="phonenumber"
                                value="{{ Auth::user()->phonenumber }}"
                                id="phone"placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Upload Logo</label><br>
                            <input type="file" id="real-file" hidden="hidden" name="profile_image"
                                accept=".png, .jpg, .jpeg" />
                            <button type="button" id="custom-button">Upload your logo</button>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Address</label>
                            <textarea class="form-control" id="address-text" rows="3" name="address"
                                placeholder="Type your full address">{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="modal-btn" href="#"type="submit">Save Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change-password Modal -->
    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('changeSetting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userid" value="{{ Auth::user()->userid }}">
                        <h5 class="text-center">Change Password</h5>
                        <div class="mb-3">
                            <label class="control-label" for="password">Old Password</label><br>
                            <div class="input-texts d-flex align-items-center">
                                <input type="password" placeholder="Enter old password" name="old_password"
                                    id="myPass1"required>
                                <span class="showPass" data-target="myPass1">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true" style="display:none;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="control-label" for="password">Create New Password</label><br>
                            <div class="input-texts d-flex align-items-center">
                                <input type="password" placeholder="Enter new password" id="myPass2"name="new_password"
                                    required>
                                <span class="showPass" data-target="myPass2">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true" style="display:none;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="control-label" for="password">Confirm Password</label><br>
                            <div class="input-texts d-flex align-items-center">
                                <input type="password" placeholder="confirm password" name="c_password"
                                    id="myPass3"required>
                                <span class="showPass" data-target="myPass3">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true" style="display:none;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="modal-btn"type="submit">Save Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/assets/admin-js/profile.js') }}"></script>
@endsection
