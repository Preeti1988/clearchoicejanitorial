@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/assign-service.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/admin-plugins/OwlCarousel/assets/owl.carousel.min.css') }}" />
    <script src="{{ asset('public/assets/admin-plugins/OwlCarousel/owl.carousel.js') }}" type="text/javascript"></script>
    <style>
        #search-results {
            position: absolute;
            top: calc(100% - 40px);
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none;
        }

        #search-results .result-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }

        #search-results .result-item:hover {
            background-color: #f0f0f0;
        }
    </style>
@endpush
@section('content')
    <div class="body-main-content">
        <div class="assign-Services-section">
            <div class="assign-Services-heading">
                <h2>Assign Services to Team Members</h2>
            </div>
            <form action="{{ route('services.assign.post') }}" method="post" id="assign-form">
                @csrf
                <input type="hidden" id="service_id" name="service_id" value="{{ $service->id }}">
                <input type="hidden" id="redirect_url" name="redirect_url" value="{{ route('services.index') }}">

                <div class="assign-Services-content-body">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="assign-Services-item">
                                <div class="assign-Services-item-head">
                                    <div class="assign-Services-item-title">
                                        <h2>Service 1: {{ $service->name }}</h2>
                                    </div>
                                </div>
                                <div class="assign-Services-item-body">
                                    <div class="assign-service-shift-card">
                                        <div class="assign-service-shift-card-image">
                                            <img src="{{ asset('public/assets/admin-images/id-card.svg') }}">
                                        </div>
                                        <div class="assign-service-shift-card-text">
                                            <h2>Service ID:</h2>
                                            <p>#{{ $service->id }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="assign-Services-item-foot">
                                    <div class="assign-Services-item-date">
                                        {{ date('l, j M h:i:s A', strtotime($service->created_at)) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="assign-service-image">
                        <img src="{{ asset('public/assets/admin-images/cleaning service-rafiki.svg') }}">
                    </div>



                    <div class="assign-service-Search">
                        <div class="assign-service-Search-input">
                            <input type="text" name="" class="form-control" onkeyup="searhcUser(this.value)"
                                placeholder="Search By Employees Name or ID">
                            <span class="search-icon"><img
                                    src="{{ asset('public/assets/admin-images/search-icon.svg') }}"></span>
                        </div>
                        <div class="assign-service-Search-action">
                            <button class="Searchbtn">Search</button>
                        </div>
                    </div>
                    <div class="assign-service-Search" style="box-shadow: none">
                        <div id="search-results">
                            <div class="result-item" onclick="assignMember()" data-name="john doe" data-empid="121"
                                data-projects="02 pojects">Result 1</div>
                            <div class="result-item">Result 2</div>
                            <div class="result-item">Result 3</div>
                        </div>
                    </div>

                    <div class="assign-service-emplyee-list">
                        <div class="assign-service-emplyee-heading">
                            <h3><span id="total_member">0</span> Team Members Added</h3>
                        </div>
                        <div id="EmployeesAdded" class="owl-carousel owl-theme">
                            <div class="item" style="display: flex;justify-content:center;align-items:middle">
                                No Members Added
                            </div>


                        </div>
                    </div>

                    <div class="assign-service-emplyee-time" id="service_time" style="display: none">
                        <div class="assign-service-emplyee-time-heading">
                            <h3><span id="emp_name"></span> Shift Time</h3>
                        </div>
                        <div class="assign-service-emplyee-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="assign-service-emplyee-time-card">
                                        <div class="assign-service-emplyee-time-group">
                                            <h2>Shift Start Time</h2>
                                            <div class="">
                                                <input type="time" name="shift_start_time" class="form-control"
                                                    onchange="setTime(this.value,'start')">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="assign-service-emplyee-time-card">
                                        <div class="assign-service-emplyee-time-group">
                                            <h2>Shift End Time</h2>
                                            <div class="">
                                                <input type="time" name="shift_end_time" class="form-control"
                                                    onchange="setTime(this.value,'end')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="assign-service-emplyee-action">
                        <button class="cancelbtn" type="button">cancel</button>
                        <button class="Savebtn">Confirm & Assign Employees</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        var assigned = [];
        var removedMember = [];
        var currentMember = {};
        $(function() {
            $("#EmployeesAdded").owlCarousel({
                loop: false,
                margin: 10,
                nav: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 4,
                    },
                    1000: {
                        items: 6,
                    },
                },
            });
        });

        var members = @json($service->members);
        members.forEach(element => {
            assigned.push({
                id: element.member_id.toString(),
                name: element.fullname,
                projects: element.projects,
                shift_start_time: element.shift_start_time,
                shift_end_time: element.shift_end_time,

            });
        });
        renderMembers();
        $("#total_member").text(assigned.length)

        function assignMember(ele) {
            var value = {
                id: ele.getAttribute("data-empid"),
                name: ele.getAttribute("data-name"),
                projects: ele.getAttribute("data-projects"),
                shift_start_time: null,
                shift_end_time: null,
            };

            var exists = false;
            for (var i = 0; i < assigned.length; i++) {
                if (assigned[i].id === value.id) {
                    exists = true;
                    break;
                }
            }
            if (!exists) {
                assigned.push(value);
                $("#total_member").text(assigned.length)
                renderMembers();
            }
        }

        function renderMembers() {
            console.log(assigned);
            var htm = "";
            if (assigned.length == 0) {
                htm += `   <div class="result-item" onclick="assignMember(ele)" data-name="john doe" data-empid="121"
                            data-projects="02 pojects">No Results</div>`;
            }
            assigned.map(item => {
                htm += `<div class="item" style="padding:10px" >
                            <div class="assign-service-member-item" data-id="${item.id}" onclick="setShift(this)" >
                                <div class="assign-service-member-item-media">
                                    <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                </div>
                                <div class="assign-service-member-item-text">
                                    <h2>${item.name}</h2>
                                    <p>Emp ID:${item.id}</p>
                                    <div class="assign-service-AssignedProjects-text">Assigned ${item.projects}</div>
                                </div>

                                <div class="assign-service-close-card-action" style="z-index:1000;position:absolute" onclick="removeUser(${item.id})">
                                    <img  src="{{ asset('public/assets/admin-images/close-circle.svg') }}">
                                </div>
                            </div>
                        </div>`;
            })
            $("#EmployeesAdded").html(htm);

            var $owl = $('#EmployeesAdded');
            $owl.trigger('destroy.owl.carousel');
            // After destory, the markup is still not the same with the initial.
            // The differences are:
            //   1. The initial content was wrapped by a 'div.owl-stage-outer';
            //   2. The '.owl-carousel' itself has an '.owl-loaded' class attached;
            //   We have to remove that before the new initialization.
            $owl.html($owl.find('.owl-stage-outer').html()).removeClass('owl-loaded');
            $owl.owlCarousel({
                // your initial option here, again.
            });
        }

        function searhcUser(val) {

            if (val != "") {
                $.get("{{ route('searhcUser') }}" + "?search=" + val, function(data) {
                    console.log(data);
                    var htm = '';
                    if (data.length == 0) {
                        htm += `   <div class="result-item" onclick="assignMember()" data-name="john doe" data-empid="121"
                            data-projects="02 pojects">No Results</div>`;
                    }
                    data.map(item => {
                        htm += `<div class="result-item" onclick="assignMember(this)" data-name="${item.fullname}" data-empid="${item.userid}"
                            data-projects="${item.projects_count}">${item.fullname}</div>`;
                    })
                    $("#search-results").html(htm);
                    $("#search-results").show();

                });
            } else {
                $("#search-results").html("");
                $("#search-results").hide();
            }

        }

        function removeUser(id) {

            for (var i = 0; i < assigned.length; i++) {
                if (assigned[i].id === id.toString()) {
                    assigned.splice(i, 1);
                    break;
                }
            }

            renderMembers();
        }

        function setShift(ele) {
            var containingClass = "assign-service-member-item";
            var classToRemove = "activeassign";

            var elements = document.querySelectorAll('.' + containingClass);

            elements.forEach(function(element) {
                if (element.classList.contains(classToRemove)) {
                    element.classList.remove(classToRemove);
                }
            });

            ele.classList.add("activeassign");
            for (var i = 0; i < assigned.length; i++) {
                if (assigned[i].id === ele.getAttribute('data-id')) {
                    currentMember = i;
                    $("#service_time").show();
                    $("#emp_name").text(assigned[i].name)
                    break;
                }
            }
        }

        function setTime(val, position) {
            if (position == 'start') {
                assigned[currentMember].shift_start_time = val;
            } else {
                assigned[currentMember].shift_end_time = val;

            }

        }
        $(document).ready(function() {
            $('#assign-form').validate({
                rules: {


                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass("text-danger");
                    element.closest(".field").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $('.please-wait').click();
                    $(element).addClass("text-danger");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("text-danger");
                },
                submitHandler: function(form, event) {

                    event.preventDefault();
                    let formData = new FormData(form);
                    var working = false;
                    // assigned.forEach(element => {
                    //     if (element.shift_end_time == null) {
                    //         Swal.fire("Error", 'Please select shift start  time for ' + element
                    //             .name, 'error');
                    //         working = true;

                    //     }
                    //     if (element.shift_end_time == null) {
                    //         Swal.fire("Error", 'Please select shift end  time for ' + element
                    //             .name, 'error');
                    //         working = true;
                    //     }
                    // });
                    if (working) {
                        return false;

                    }
                    formData.append('assigned', JSON.stringify(assigned));

                    $.ajax({
                        type: 'post',
                        url: form.action,
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,

                        success: function(response) {
                            if (response.status == 200) {

                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',

                                }).then((result) => {

                                    var url = $('#redirect_url').val();
                                    if (url !== undefined || url != null) {
                                        window.location = url;
                                    } else {
                                        location.reload(true);
                                    }
                                })

                                return false;
                            }

                            if (response.status == 201) {
                                Swal.fire(
                                    'Error',
                                    response.message,
                                    'error'
                                );

                                return false;
                            }
                        },
                        error: function(data) {
                            if (data.status == 422) {
                                var form = $("#product_form");
                                let li_htm = '';
                                $.each(data.responseJSON.errors, function(k, v) {
                                    const $input = form.find(
                                        `input[name=${k}],select[name=${k}],textarea[name=${k}]`
                                    );
                                    if ($input.next('small').length) {
                                        $input.next('small').html(v);
                                        if (k == 'services' || k == 'membership') {
                                            $('#myselect').next('small').html(v);
                                        }
                                    } else {
                                        $input.after(
                                            `<small class='text-danger'>${v}</small>`
                                        );
                                        if (k == 'services' || k == 'membership') {
                                            $('#myselect').after(
                                                `<small class='text-danger'>${v[0]}</small>`
                                            );
                                        }
                                    }
                                    li_htm += `<li>${v}</li>`;
                                });

                                return false;
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.statusText,
                                    'error'
                                );
                            }
                            return false;

                        }
                    });
                }
            })
        });
    </script>
@endsection
