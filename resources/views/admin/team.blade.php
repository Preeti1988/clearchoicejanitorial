@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client-Details')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/teams.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/admin-plugins/fontawesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/admin-plugins/fontawesome/css/font-awesome.min.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="p-0 total-count">Total Onboard Team Members <b>({{ count($datas) }})</b></h6>
            <div class="d-flex mb-2">
                <a href="{{ url('addmember') }}" class="add-member-btn me-3">Add Team Member
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-add" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                        <path
                            d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                    </svg>
                </a>
                <a href="{{ url('/member-requests') }}" class="reg-btn">Member Registration Request
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="team-details-section">
            <div class="team-section">
                <div class="row">
                    <div class="col-md-9">
                        <div class="tasks-content-info tab-content">
                            <div class="" id="OngoingServices">
                                <div class="ongoing-services-item">
                                    <div class="ongoing-services-item-head">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
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
                                                            <input type="text" class="form-control"
                                                                placeholder="Search by Employee Name, Employee Id, Email or Phone No."
                                                                name="search" value="{{ $search ?? '' }}"
                                                                aria-label="Recipient's username"
                                                                aria-describedby="button-addon2">
                                                            <button class="btn btn-outline-secondary" type="submit"
                                                                id="button-addon2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="white" class="bi bi-search"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-4 active-btns justify-content-end">
                                                <div class="act-inact-info">
                                                    <div class="d-flex align-items-center action-btn-bg">
                                                        <div class="active-option">
                                                            <a href="{{ url('/teams-active') }}">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault"
                                                                        @if ($type == 1) checked @endif
                                                                        id="flexRadioDefault1">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Active
                                                                    </label>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="inactive-option">
                                                            <a href="{{ url('/teams-inactive') }}">
                                                                <div class="form-check ms-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault" id="flexRadioDefault2"
                                                                        @if ($type == 2) checked @endif>
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                        Inactive
                                                                    </label>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="team-item-body" id="active">
                                        @if ($datas->isEmpty())
                                            <tr>
                                                <td colspan="11" class="text-center">
                                                    No record found
                                                </td>
                                            </tr>
                                        @elseif(!$datas->isEmpty())
                                            @foreach ($datas as $val)
                                                <div class="team-info-box mb-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-1">
                                                            <p class="mb-0">Emp ID</p>
                                                            <h6 class="mt-1">{{ $val->userid }}</h6>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="profile-img">
                                                                    <img src="{{ asset('public/assets/admin-images/user-default.png') }}"
                                                                        alt="image" class="img-fluid">
                                                                </div>
                                                                <h6 class="ms-2 mt-0 mb-0">
                                                                    {{ $val->fullname ?? '' }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="mb-0">Email Id</p>
                                                            <h6 class="mt-1">{{ $val->email ?? '' }}
                                                            </h6>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="mb-0">Phone no.</p>
                                                            <h6 class="mt-1">+{{ CountryCode($val->country_id) }}
                                                                {{ $val->phonenumber ?? '' }}
                                                            </h6>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <p class="mb-0">Status</p>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckChecked"
                                                                    @if ($val->status == 1) checked @endif>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-2">
                                                            <p class="mb-0">Mark as Inactive</p> <input
                                                                class='input-switch justify-content-end' type="checkbox"
                                                                id="demo" />
                                                            <label class="label-switch" for="demo"></label>
                                                            <span class="info-text"></span>
                                                        </div> --}}
                                                        <div class="col-md-1 d-none">
                                                            <div class="view-btn">
                                                                <a
                                                                    href="{{ url('team-detail/' . encryptDecrypt('encrypt', $val->userid)) }}">
                                                                    <h6><i class="fa fa-eye me-1"></i>View</h6>
                                                                </a>
                                                                <a
                                                                    href="{{ url('edit-teammember/' . encryptDecrypt('encrypt', $val->userid)) }}">
                                                                    <h6><i class="fa fa-pencil me-1"></i>edit</h6>
                                                                </a>

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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="team-panel-sidebar">
                            <h2>Good Projects Check-in & Check-out</h2>
                            <div class="service-log-media">
                                <img src="{{ asset('public/assets/admin-images/checkout.svg') }}">
                            </div>
                        </div>
                        <div class="team-panel-sidebar">
                            <h6 class="p-0 mb-0 text-center ">Average Check-In Time</h6>
                            <div class="count-bg-1 mt-2">
                                <p class="p-0 m-0 text-center">122 Total Employees</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-small-1 detail-box mt-3">
                                        <h5 class="text-center m-0 p-0">100</h5>
                                        <p class="text-center mt-2 mb-0 p-0">Ontime</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-small-1 detail-box mt-3">
                                        <h5 class="text-center m-0 p-0">22</h5>
                                        <p class="text-center mt-2 mb-0 p-0">Late</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="team-panel-sidebar">
                            <h6 class="p-0 mb-0 text-center ">Average Check-Out Time</h6>
                            <div class="count-bg-2 mt-2">
                                <p class="p-0 m-0 text-center">122 Total Employees</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-small-2 detail-box mt-3">
                                        <h5 class="text-center m-0 p-0">101</h5>
                                        <p class="text-center mt-2 mb-0 p-0">Ontime</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-small-2 detail-box mt-3">
                                        <h5 class="text-center m-0 p-0">21</h5>
                                        <p class="text-center mt-2 mb-0 p-0">Late</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- --------------Add team Member modal------------- -->
    <div class="modal fade" id="addTeamMember" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-xl  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                            fill="currentColor" class="bi bi-plus-circle-fill me-2" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>Add New Team Member </h5>
                    <form action="{{ route('search.team-member') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="Emter employee full name">
                                    <label for="floatingInput" class="text-capitalize">Employee full
                                        name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="Enter email Id">
                                    <label for="floatingInput" class="text-capitalize">Email Id</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="floatingInput"
                                        placeholder="Enter phone Number">
                                    <label for="floatingInput" class="text-capitalize">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="floatingInput"
                                        placeholder="Enter additional phone Number">
                                    <label for="floatingInput" class="text-capitalize">Additional phone
                                        Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="Enter subject">
                                    <label for="floatingInput" class="text-capitalize">Subject</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="Enter job">
                                    <label for="floatingInput" class="text-capitalize">For which job employee
                                        will work
                                        for</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="Enter previous company">
                                    <label for="floatingInput" class="text-capitalize">Previous
                                        company</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input placeholder="Type Date" type="text" onfocus="(this.type = 'date')"
                                        id="date" class="time-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Marital Status</option>
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Divorced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput"
                                        placeholder="Enter previous company">
                                    <label for="floatingInput" class="text-capitalize">No.of
                                        Dependents</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="subhead-modal mb-2">Address</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" rows="4"></textarea>
                                    <label for="floatingTextarea" class="text-capitalize">Street
                                        Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="Enter previous company">
                                    <label for="floatingInput" class="text-capitalize">City</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select State</option>
                                        <option value="1">option 1</option>
                                        <option value="2">option 2</option>
                                        <option value="3">option 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="Enter previous company">
                                    <label for="floatingInput" class="text-capitalize">Zip Code</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select State</option>
                                            <option value="1">option 1</option>
                                            <option value="2">option 2</option>
                                            <option value="3">option 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="subhead-modal mb-2">Upload Your Resume</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="file" class="form-control" id="customFile" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 130px!important" rows="4"></textarea>
                                    <label for="floatingTextarea2">Accompanying Letter</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="subhead-modal mb-2">Account Password</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput"
                                        placeholder="Enter previous company">
                                    <label for="floatingInput" class="text-capitalize">Create New
                                        Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput"
                                        placeholder="Enter previous company">
                                    <label for="floatingInput" class="text-capitalize">Confirm New
                                        Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="fixed-modal-footer modal-footer justify-content-center mt-5 ">
                            <div class="modal-footer justify-content-center">
                                <div class="text-center">
                                    <a href="#" class="btn save-account" data-bs-toggle="modal"
                                        data-bs-target="#createTeamMemberAccount">Save & Create Team Members
                                        Account</a>
                                    <p class="mt-2 mb-0 pb-0">Or</p>
                                    <a href="#" class="send-link text-capitalize" data-bs-target="#sendLinkTo"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Send <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path
                                                d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                            <path
                                                d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                        </svg>Link to Download app on team member registered Email id</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!------- Save & Create Team Members account modal --------->
    <div class="modal fade" id="createTeamMemberAccount" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">New Team Member <br>Added Successful</h5>
                    <img src="images/employees.svg" alt="image" class="img-fluid modal-img">
                </div>
                <div class="text-center">
                    <a href="#" class="btn save-account">Send <svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-link-45deg"
                            viewBox="0 0 16 16">
                            <path
                                d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                            <path
                                d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                        </svg>Link to Download App</a>
                    <p class="text-capitalize send-link mt-2 mb-5">With created password on employee registered
                        email id
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!------- Send Link modal --------->
    <div class="modal fade" id="sendLinkTo" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3"
        tabindex="-1">
        <div class="modal-dialog modal-xl  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Send Link to Download App</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="modal-card">
                                <img src="images/sign-up-form.svg" alt="image" class="img-fluid">
                                <p class="text-center mb-2">Employee will get the link to Download App</p>
                                <h6 class="text-center mt-0 pt-0 mb-0 pb-0">Fill the Sign Up Info</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-card">
                                <img src="images/approve-reject.svg" alt="image" class="img-fluid">
                                <p class="text-center mb-2">Admin Received Registration Request</p>
                                <h6 class="text-center mt-0 pt-0 mb-0 pb-0">Approve or Reject by Admin</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-card">
                                <img src="images/new-team-member.svg" alt="image" class="img-fluid">
                                <p class="text-center mb-2">Once Approved by Admin</p>
                                <h6 class="text-center mt-0 pt-0 mb-0 pb-0">New Team member will be Onboarded
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <h4 class="subhead-modal mb-2">Email ID</h4>
                        </div>
                        <div class="col-md-12">
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Employee Registered Email Id">
                        </div>
                    </div>
                    <div class="text-center mt-3 mb-3">
                        <a href="#" class="btn save-account">Send <svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-link-45deg"
                                viewBox="0 0 16 16">
                                <path
                                    d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                <path
                                    d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                            </svg>Link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a> --}}
@endsection
