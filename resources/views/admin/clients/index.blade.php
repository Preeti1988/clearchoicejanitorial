@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/client.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="user-table-section">
            <div class="heading-section">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h4 class="heading-title">Client List</h4>
                    </div>
                    <div class="btn-option-info wd50">
                        <div class="search-filter">
                            <div class="row g-2">
                                <div class="col-md-4 pt-2">
                                    <a href="{{ url('addclient') }}" class="add-member-btn me-3">Add Client
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                            <path
                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                            <path
                                                d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-md-8 d-flex">
                                    <a href="{{ route('Clients') }}" class="m-1 mx-3"><img
                                            src="{{ custom_asset('public/assets/admin-images/reset-icon.png') }}"
                                            style="height: 25px" alt=""></a>
                                    <form action="">

                                        <div class="search-input">
                                            <div class="input-group" style="flex-wrap: nowrap">
                                                <input type="text" class="form-control"
                                                    placeholder="Search by Client Name." name="search"
                                                    value="{{ $search ?? '' }}" aria-label="Recipient's username"
                                                    aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" style="background: #7BC043"
                                                    type="submit" id="button-addon2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-content-section">
                <div class="ccj-card">

                    <div class="table-responsive">
                        <table class="table ccj-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Client Notes</th>
                                    <th>Lead Source</th>
                                    <th>Company</th>
                                    <th>Mobile Number</th>
                                    <th>Work Number</th>
                                    <th>Status</th>
                                    <th style="white-space:nowrap;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($datas->isEmpty())
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            No record found
                                        </td>
                                    </tr>
                                @elseif(!$datas->isEmpty())
                                    @foreach ($datas as $val)
                                        <tr>
                                            <td style="white-space: nowrap;">
                                                {{ date('M d, Y', strtotime($val->created_at)) }}
                                            </td>

                                            <td style="white-space: nowrap;">
                                                {{ $val->name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $val->email_address ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $val->client_notes ?? 'N/A' }}
                                            </td>


                                            <td>
                                                {{ $val->lead_source ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $val->company ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $val->mobile_number ?? 'N/A' }}
                                            </td>
                                            <td style="white-space: nowrap;">
                                                {{ $val->client_work_number ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <span class="status-text grstatus">
                                                    @if ($val->status == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </span>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <a class="viewbtn"
                                                    href="{{ url('client-details/' . encryptDecrypt('encrypt', $val->id)) }}">
                                                    <img
                                                        src="{{ custom_asset('public/assets/admin-images/view-icon.svg') }}">
                                                </a>
                                                <a class="viewbtn"
                                                    href="{{ url('edit-client/' . encryptDecrypt('encrypt', $val->id)) }}') }}">
                                                    <img
                                                        src="{{ custom_asset('public/assets/admin-images/edit-icon.svg') }}">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <div class="d-flex justify-content-left">
                                    {{ $datas->links('pagination::bootstrap-4') }}
                                </div>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="ccj-table-pagination">
                        <ul class="ccj-pagination">
                            <li class="disabled" id="example_previous">
                                <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0"
                                    class="page-link">Previous</a>
                            </li>
                            <li class="active">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="">
                                <a href="#" aria-controls="example" data-dt-idx="2" tabindex="0"
                                    class="page-link">2</a>
                            </li>
                            <li class="">
                                <a href="#" aria-controls="example" data-dt-idx="3" tabindex="0"
                                    class="page-link">3</a>
                            </li>
                            <li class="next" id="example_next">
                                <a href="#" aria-controls="example" data-dt-idx="7" tabindex="0"
                                    class="page-link">Next</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- --------------Add team Member modal------------- -->
    <div class="modal fade" id="addTeamMember" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">

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
                            </svg>Add Client </h5>
                        <form action="{{ route('SaveClient') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" name="first_name"
                                            placeholder="First name" value="{{ old('first_name') }}" required>
                                        <label for="floatingInput" class="text-capitalize">First name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" name="last_name"
                                            placeholder="Last name" value="{{ old('last_name') }}" required>
                                        <label for="floatingInput" class="text-capitalize">Last name</label>

                                        <input type="text" class="form-control" id="floatingInput" name="name"
                                            placeholder="Full name" value="{{ old('name') }}" required>
                                        <label for="floatingInput" class="text-capitalize">Full name</label>


                                        <input type="text" class="form-control" id="floatingInput" name="name"
                                            placeholder="Full name" value="{{ old('name') }}" required>
                                        <label for="floatingInput" class="text-capitalize">Full name</label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" name="email"
                                            placeholder="Enter email Id" value="{{ old('email') }}" required>
                                        <label for="floatingInput" class="text-capitalize">Email Id</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control" id="floatingInput"
                                            name="mobile_number" placeholder="Enter phone Number"
                                            value="{{ old('mobile_number') }}" required>
                                        <label for="floatingInput" class="text-capitalize">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="subhead-modal mb-2">Address</h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="address"
                                            rows="4" required></textarea>
                                        <label for="floatingTextarea" class="text-capitalize">Street Address</label>
                                    </div>
                                </div>
                                <div class="fixed-modal-footer modal-footer justify-content-center mt-5 ">
                                    <div class="modal-footer justify-content-center">
                                        <div class="text-center">
                                            <button href="#" class="btn save-account" data-bs-toggle="modal"
                                                data-bs-target="#createTeamMemberAccount" type="submit">Save & Create
                                                Team
                                                Members Account</button>
                                            <p class="mt-2 mb-0 pb-0">Or</p>
                                            <a href="#" class="send-link text-capitalize"
                                                data-bs-target="#sendLinkTo" data-bs-toggle="modal"
                                                data-bs-dismiss="modal">Send <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                                    <path
                                                        d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                                </svg>Link to Download app on team member registered Email id</a>
                                        </div>
                                    </div>
                                </div>

                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="address"
                                    rows="4" required></textarea>
                                <label for="floatingTextarea" class="text-capitalize">Street Address</label>
                            </div>
                    </div>
                    <div class="fixed-modal-footer modal-footer justify-content-center mt-5 ">
                        <div class="modal-footer justify-content-center">
                            <div class="text-center">
                                <button href="#" class="btn save-account" data-bs-toggle="modal"
                                    data-bs-target="#createTeamMemberAccount" type="submit">Save & Create Team Members
                                    Account</button>
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
                    <p class="text-capitalize send-link mt-2 mb-5">With created password on employee registered email
                        id
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
