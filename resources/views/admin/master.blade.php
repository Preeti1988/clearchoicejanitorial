@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Master')
@push('css')
    <link rel="stylesheet" href="{{ custom_asset('public/assets/admin-css/master.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="master-card-contents">
            <div class="master-item-head">
                <div class="master-item-title d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="master-card-image">
                            <img src="{{ custom_asset('public/assets/admin-images/master-service.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">Services</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal"
                        data-bs-target="#addNewValueServices">Add Services</a>
                </div>
            </div>
            <div class="master-item-body">
                <div class="row">
                    @if ($ServicesValue->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center">
                                No record found
                            </td>
                        </tr>
                    @elseif(!$ServicesValue->isEmpty())
                        @foreach ($ServicesValue as $val)
                            <div class="col-md-2 mb-2">
                                <div class="master-list-bg d-flex justify-content-between align-items-center">
                                    <p class="mb-0">{{ $val->name ?? '' }}</p>
                                    <div class="cancel-bg">
                                        <a data-url="{{ url('delete-master-item/3/' . encryptDecrypt('encrypt', $val->id)) }}"
                                            onclick="askConfirm(this)"><img
                                                src="{{ custom_asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>
                                    </div>
                                    <div class="cancel-bg">
                                        <a href="#" data-url="{{ route('UpdateMaster') }}"
                                            data-id="{{ $val->id }}" data-module="service"
                                            data-price="{{ $val->price }}" data-name="{{ $val->name }}"
                                            data-modal="addNewValueServices" onclick="openEdit(this)"><img
                                                src="{{ custom_asset('public/assets/admin-images/edit-icon.png') }}"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="master-card-contents">
            <div class="master-item-head">
                <div class="master-item-title d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="master-card-image">
                            <img src="{{ custom_asset('public/assets/admin-images/master-service.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">In Scope</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addInScope"
                        onclick='Get_Tag_Name("Add In Scope","1")'>Add In Scope</a>
                </div>
            </div>
            <div class="master-item-body">
                <div class="row">
                    @if ($InScope->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center">
                                No record found
                            </td>
                        </tr>
                    @elseif(!$InScope->isEmpty())
                        @foreach ($InScope as $val)
                            <div class="col-md-2 mb-2">
                                <div class="master-list-bg d-flex justify-content-between align-items-center">
                                    <p class="mb-0">{{ $val->name ?? '' }}</p>
                                    <div class="cancel-bg">
                                        <a href="{{ url('delete-master-item/1/' . encryptDecrypt('encrypt', $val->id)) }}"><img
                                                src="{{ custom_asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>

                                    </div>
                                    <div class="cancel-bg"> <a href="#" data-url="{{ route('UpdateMaster') }}"
                                            data-id="{{ $val->id }}" data-module="inscope"
                                            data-name="{{ $val->name }}" data-modal="addInScope"
                                            onclick="openEdit(this)"><img
                                                src="{{ custom_asset('public/assets/admin-images/edit-icon.png') }}"
                                                alt=""></a></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="master-card-contents">
            <div class="master-item-head">
                <div class="master-item-title d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="master-card-image">
                            <img src="{{ custom_asset('public/assets/admin-images/master-service.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">Out of Scope</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addOutScope"
                        onclick='Get_Tag_Name("Add Out of Scope","2")'>Add Out of Scope</a>
                </div>
            </div>
            <div class="master-item-body">
                <div class="row">
                    @if ($OutScope->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center">
                                No record found
                            </td>
                        </tr>
                    @elseif(!$OutScope->isEmpty())
                        @foreach ($OutScope as $val)
                            <div class="col-md-2 mb-2">
                                <div class="master-list-bg d-flex justify-content-between align-items-center">
                                    <p class="mb-0">{{ $val->name ?? '' }}</p>
                                    <div class="cancel-bg">
                                        <a href="{{ url('delete-master-item/2/' . encryptDecrypt('encrypt', $val->id)) }}">
                                            <img src="{{ custom_asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>

                                    </div>
                                    <div class="cancel-bg">
                                        <a href="#" data-url="{{ route('UpdateMaster') }}"
                                            data-id="{{ $val->id }}" data-module="outscope"
                                            data-name="{{ $val->name }}" data-modal="addOutScope"
                                            onclick="openEdit(this)"><img
                                                src="{{ custom_asset('public/assets/admin-images/edit-icon.png') }}"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="master-card-contents">
            <div class="master-item-head">
                <div class="master-item-title d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="master-card-image">
                            <img src="{{ custom_asset('public/assets/admin-images/master-designation.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">Designation</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal"
                        data-bs-target="#addDesignation" onclick='Get_Tag_Name("Add Designation","4")'>Add Designation</a>



                </div>
            </div>
            <div class="master-item-body">
                <div class="row">
                    @if ($Designation->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center">
                                No record found
                            </td>
                        </tr>
                    @elseif(!$Designation->isEmpty())
                        @foreach ($Designation as $val)
                            <div class="col-md-2 mb-2">
                                <div class="master-list-bg d-flex justify-content-between align-items-center">
                                    <p class="mb-0">{{ $val->name ?? '' }}</p>
                                    <div class="cancel-bg">
                                        <a
                                            href="{{ url('delete-master-item/4/' . encryptDecrypt('encrypt', $val->id)) }}">
                                            <img src="{{ custom_asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>



                                    </div>
                                    <div class="cancel-bg">
                                        <a href="#" data-url="{{ route('UpdateMaster') }}"
                                            data-id="{{ $val->id }}" data-module="Designation"
                                            data-name="{{ $val->name }}" data-modal="addDesignation"
                                            onclick="openEdit(this)"><img
                                                src="{{ custom_asset('public/assets/admin-images/edit-icon.png') }}"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="master-card-contents">
            <div class="master-item-head">
                <div class="master-item-title d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="master-card-image">
                            <img src="{{ custom_asset('public/assets/admin-images/master-marital-status.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">Marital Status</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addMarital"
                        onclick='Get_Tag_Name("Add Marital Status","5")'>Add Marital
                        Status</a>



                </div>
            </div>
            <div class="master-item-body">
                <div class="row">
                    @if ($MaritalStatus->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center">
                                No record found
                            </td>
                        </tr>
                    @elseif(!$MaritalStatus->isEmpty())
                        @foreach ($MaritalStatus as $val)
                            <div class="col-md-2 mb-2">
                                <div class="master-list-bg d-flex justify-content-between align-items-center">
                                    <p class="mb-0">{{ $val->name ?? '' }}</p>
                                    <div class="cancel-bg">
                                        <a
                                            href="{{ url('delete-master-item/5/' . encryptDecrypt('encrypt', $val->id)) }}">
                                            <img src="{{ custom_asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>



                                    </div>
                                    <div class="cancel-bg">
                                        <a href="#" data-url="{{ route('UpdateMaster') }}"
                                            data-id="{{ $val->id }}" data-module="marital"
                                            data-name="{{ $val->name }}" data-modal="addMarital"
                                            onclick="openEdit(this)"><img
                                                src="{{ custom_asset('public/assets/admin-images/edit-icon.png') }}"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- In Scope Modal -->
    <div class="modal fade" id="addInScope" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="$('#inscope_text').text('Add');$('#inscope_form')[0].reset();$('#inscope_btn').text('add')"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center" id="tag_name"> <span id="inscope_text">Add</span> In Scope</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST" id="inscope_form">
                        @csrf
                        <input type="hidden" id="tag_id" name="tag_id" value="1">
                        <input type="hidden" id="inscope_id" name="id" value="0">

                        <input type="text" class="form-control mt-4" name="name" id="value"
                            placeholder="Type here" required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit" id="inscope_btn">Add</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Out Scope Modal -->
    <div class="modal fade" id="addOutScope" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="$('#outscope_text').text('Add');$('#outscope_form')[0].reset();$('#outscope_btn').text('add')"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center" id="tag_name"><span id="outscope_text">Add</span> Out Scope</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST" id="outscope_form">
                        @csrf
                        <input type="hidden" id="tag_id" name="tag_id" value="2">
                        <input type="hidden" id="outscope_id" name="id" value="0">

                        <input type="text" class="form-control mt-4" name="name" id="value"
                            placeholder="Type here" required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit" id="outscope_btn">Add</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Items Modal -->
    <div class="modal fade" id="addNewValueServices" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="$('#service_text').text('Add');$('#service_form')[0].reset();$('#service_btn').text('add')"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center"><span id="service_text">Add</span> Services</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST" id="service_form">
                        @csrf
                        <input type="hidden" id="tag_id_ser" name="tag_id" value="3">
                        <input type="hidden" id="service_id" name="id" value="0">

                        <input type="text" class="form-control mt-4" name="name" placeholder="Type name here"
                            required>
                        <input type="number" class="form-control mt-4" name="price" placeholder="Type price here"
                            required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit" id="service_btn">Add</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Designation Modal -->
    <div class="modal fade" id="addDesignation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                        onclick="$('#Designation_text').text('Add');$('#Designation_form')[0].reset();$('#Designation_btn').text('add')"
                        type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center"><span id="Designation_text">Add</span> Designation</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST" id="Designation_form">
                        @csrf
                        <input type="hidden" id="tag_id_ser" name="tag_id" value="4">
                        <input type="hidden" id="Designation_id" name="id" value="0">

                        <input type="text" class="form-control mt-4" name="name" placeholder="Type name here"
                            required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit"> <span id="Designation_btn">Add</span>
                            </button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Marital Status Modal -->
    <div class="modal fade" id="addMarital" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                        onclick="$('#marital_text').text('Add');$('#marital_form')[0].reset();$('#marital_btn').text('add')"
                        class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center"><span id="marital_text">Add</span> Marital Status</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST" id="marital_form">
                        @csrf
                        <input type="hidden" id="marital_id" name="id" value="0">

                        <input type="hidden" id="tag_id_ser" name="tag_id" value="5">
                        <input type="text" class="form-control mt-4" name="name" placeholder="Type name here"
                            required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" id="marital_btn" type="submit">Add</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------------- Approval-Product-Jquery -------------------->
    <script>
        function Get_Tag_Name(Tag_name, Tag_id) {
            document.getElementById("tag_name").innerText = Tag_name;
            document.getElementById("tag_id").value = Tag_id;
        }

        function Get_Tag_Name(Tag_name, Tag_id) {
            document.getElementById("tag_name").innerText = Tag_name;
            document.getElementById("tag_id").value = Tag_id;
        }

        function openEdit(ele) {
            $(`#${ele.getAttribute("data-modal")}`).modal("show");
            $(`#${ele.getAttribute("data-module")}_text`).text("Edit")
            $(`#${ele.getAttribute("data-module")}_btn`).text("Update")

            var form = document.getElementById(`${ele.getAttribute("data-module")}_form`);
            form.name.value = ele.getAttribute("data-name");
            form.price.value = ele.getAttribute("data-price");
            form.id.value = ele.getAttribute("data-id");
            form.setAttribute("action", ele.getAttribute("data-url"));

        }

        function askConfirm(ele) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7BC043',
                cancelButtonColor: '#7BC043',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.value) {
                    location.replace(ele.getAttribute("data-url"));
                }
            })
        }
    </script>

@endsection
