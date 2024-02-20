@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/client.css') }}">
    <style>
        #day {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="user-table-section">
            <div class="heading-section">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h4 class="heading-title">Timecard List</h4>
                    </div>
                    <div class="btn-option-info wd80">
                        <div class="search-filter">
                            <div class="row g-2">
                                <div class="col-md-9 d-flex">

                                    <form action="">

                                        <div class="search-input">
                                            <div class="input-group" style="flex-wrap: nowrap">
                                                <input type="text" class="form-control"
                                                    placeholder="Search by Member Name." name="search"
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
                                    </form> <a href="{{ route('timesheet.list') }}" class="m-1 mx-3"><img
                                            src="{{ custom_asset('public/assets/admin-images/reset-icon.png') }}"
                                            style="height: 25px" alt=""></a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <form action="" method="get" class="my-3">
                    <div class="row ">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="year" id="year" class="form-control rounded">

                                    <?php
                                    $years = array_reverse(range(2010, date('Y')));
                                    
                                    foreach ($years as $year) {
                                        if (Request::has('year') && request('year') == $year) {
                                            echo "<option value=\"$year\"  selected>$year</option>";
                                        } else {
                                            echo "<option value=\"$year\"  >$year</option>";
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="month" id="month" class="form-control rounded">


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
                                    foreach ($months as $key => $month) {
                                        if (Request::has('month') && request('month') == $key) {
                                            echo "<option value='$key' selected>$month</option>";
                                        } else {
                                            if (date('m') == $key) {
                                                echo "<option value='$key' selected>$month</option>";
                                            } else {
                                                echo "<option value='$key'>$month</option>";
                                            }
                                        }
                                    }
                                    ?>


                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select id="day" class="form-control" name="day"></select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex">
                            <button class="btn btn-outline-secondary" style="background: #7BC043;border:none;color:white">
                                Apply
                            </button>
                            <a href="{{ route('timesheet.list') }}" class="m-1 mx-3"><img
                                    src="{{ custom_asset('public/assets/admin-images/reset-icon.png') }}"
                                    style="height: 25px" alt=""></a>
                        </div>
                        <div class="col-md-2">
                            <button id="downloadBtn" type="button" class="btn btn-outline-secondary"
                                style="background: #7BC043;border:none;color:white">Download </button>
                        </div>

                    </div>
                </form>
            </div>

            <div class="user-content-section">
                <div class="ccj-card">

                    <div class="table-responsive">

                        <table class="table ccj-table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Member Name</th>
                                    @php
                                        $currentDate = strtotime($start_date);
                                        while ($currentDate <= strtotime($end_date)) {
                                            echo '<th>' . date('Y-m-d', $currentDate) . '</th>';
                                            $currentDate = strtotime('+1 day', $currentDate);
                                        }
                                    @endphp
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $memberName => $dates)
                                    <tr>
                                        <td>{{ $memberName }}</td>
                                        @php
                                            $currentDate = strtotime($start_date);
                                            while ($currentDate <= strtotime($end_date)) {
                                                $date = date('Y-m-d', $currentDate);
                                                $totalHours = isset($dates[$date]) ? $dates[$date] : 0;
                                                $formatted = formatTime($totalHours);
                                                echo "<td>  $formatted</td>";
                                                $currentDate = strtotime('+1 day', $currentDate);
                                            }
                                        @endphp
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="16" align="center">No results found</td>
                                    </tr>
                                @endforelse
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to populate days based on selected year and month
            function populateDays(year, month) {
                // Get the last day of the selected month
                var lastDay = new Date(year, month, 0).getDate();
                // Clear existing options
                $('#day').show();
                $('#day').empty();
                // Populate days
                $('#day').append('<option value="01-15">from 01 ' + $('#month option:selected').text() + ' to 15 ' +
                    $('#month option:selected').text() + '</option>');
                $('#day').append('<option value="16-' + lastDay + '">from 16 ' + $('#month option:selected')
                    .text() + ' to ' + lastDay + ' ' + $('#month option:selected').text() + '</option>');
            }

            // Event listener for change in year or month dropdowns
            $('#year, #month').change(function() {
                var year = $('#year').val();
                var month = $('#month').val();
                populateDays(year, month);
            });

            // Initially populate days based on current year and month
            var currentYear = new Date().getFullYear();
            var currentMonth = new Date().getMonth() + 1;
            populateDays(currentYear, currentMonth);
        });


        document.getElementById("downloadBtn").addEventListener("click", function() {
            // Get table element
            var table = document.getElementById("myTable");
            var rows = table.querySelectorAll("tr");

            // Create CSV content
            var csvContent = "";

            // Iterate over rows
            rows.forEach(function(row) {
                var cells = row.querySelectorAll("td, th");
                var rowData = [];
                // Iterate over cells
                cells.forEach(function(cell) {
                    rowData.push('"' + cell.innerText.replace(/"/g, '""') +
                        '"'); // Double quotes and escape double quotes inside
                });
                csvContent += rowData.join(",") + "\n"; // Join cells with comma and add newline
            });

            // Create blob
            var blob = new Blob([csvContent], {
                type: "text/csv;charset=utf-8"
            });

            // Save blob as file using FileSaver.js
            saveAs(blob, "table.csv");
        });
    </script>

@endsection
