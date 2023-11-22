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
                            <img src="{{ asset('public/assets/admin-images/profile-image.jpg') }}" alt="image" class="img-fluid">
                            <div class="name-details ms-3">
                                <p class="info-title">Owner's Name</p>
                                <h4 class="mt-3">John Smith</h4>
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
                                            <img src="{{ asset('public/assets/admin-images/envelope.svg') }}" alt="image" class="img-fluid">
                                        </div>
                                        <div class="detail-info ms-3">
                                            <p class="mb-0 info-title">Email Address</p>
                                            <h5 class="mt-0">johnsmith@gmail.com</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="icon-image">
                                            <img src="{{ asset('public/assets/admin-images/phone-call.svg') }}" alt="image" class="img-fluid">
                                        </div>
                                        <div class="detail-info ms-3">
                                            <p class="mb-0 info-title">Phone Number</p>
                                            <h5 class="mt-0">+91 9568456231</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="d-flex">
                                        <div class="icon-image">
                                            <img src="{{ asset('public/assets/admin-images/address.svg') }}" alt="image" class="img-fluid">
                                        </div>
                                        <div class="detail-info ms-3">
                                            <p class="mb-0 info-title">Address</p>
                                            <h5 class="mt-0">70 Washington Square South, New York, NY 10012,
                                                United States</h5>
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
                    <form>
                        <h5 class="text-center">Edit Profile Details</h5>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="recipient-name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email Id</label>
                            <input type="email" class="form-control" id="email-id" placeholder="Enter your email id">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Phone No.</label>
                            <input type="email" class="form-control" id="phone" placeholder="Enter your phone number">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Upload Logo</label><br>
                            <input type="file" id="real-file" hidden="hidden" />
                            <button type="button" id="custom-button">Upload your logo</button>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Address</label>
                            <textarea class="form-control" id="address-text" rows="3"
                                placeholder="Type your full address"></textarea>
                        </div>
                        <div class="mb-3">
                            <a class="modal-btn" href="#">Save Details</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- edit-details Modal -->
    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <h5 class="text-center">Change Password</h5>
                        <div class="mb-3">
                            <label class="control-label" for="password">Old Password</label><br>
                            <div class="input-texts d-flex align-items-center">
                                <input type="password" placeholder="Enter old password" id="myPass1">
                                <span class="showPass" data-target="myPass1">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true" style="display:none;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="control-label" for="password">Create New Password</label><br>
                            <div class="input-texts d-flex align-items-center">
                                <input type="password" placeholder="Enter new password" id="myPass2">
                                <span class="showPass" data-target="myPass2">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true" style="display:none;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="control-label" for="password">Confirm Password</label><br>
                            <div class="input-texts d-flex align-items-center">
                                <input type="password" placeholder="confirm password" id="myPass3">
                                <span class="showPass" data-target="myPass3">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true" style="display:none;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <a class="modal-btn" href="#">Save Details</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/assets/admin-js/profile.js') }}"></script>
@endsection
