@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Master')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/assets/admin-css/master.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="master-card-contents">
            <div class="master-item-head">
                <div class="master-item-title d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="master-card-image">
                            <img src="{{ asset('public/assets/admin-images/master-service.svg') }}">
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
                                        <a href="{{ url('delete-master-item/3/' . encryptDecrypt('encrypt', $val->id)) }}"><img
                                                src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
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
                            <img src="{{ asset('public/assets/admin-images/master-service.svg') }}">
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
                                                src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
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
                            <img src="{{ asset('public/assets/admin-images/master-service.svg') }}">
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
                                        <a href="{{ url('delete-master-item/2/' . encryptDecrypt('encrypt', $val->id)) }}"><img
                                                src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>


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
                            <img src="{{ asset('public/assets/admin-images/master-designation.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">Designation</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addNewValue"
                        onclick='Get_Tag_Name("Add Designation","4")'>Add Designation</a>

                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addNewValue"
                        onclick='Get_Tag_Name("Add Designation","4")'>Add Designation</a>

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
                                            <img src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>

                                        <a href="#"><img
                                                src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>


                                        <p class="mb-0">{{ $val->name ?? '' }}</p>
                                        <div class="cancel-bg">
                                            <a href="#"><img
                                                    src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
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
                            <img src="{{ asset('public/assets/admin-images/master-marital-status.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">Marital Status</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addNewValue"
                        onclick='Get_Tag_Name("Add Marital Status","5")'>Add Marital
                        Status</a>

                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addNewValue"
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
                                            <img src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>

                                        <a href="#"><img
                                                src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
                                                alt=""></a>


                                        <p class="mb-0">{{ $val->name ?? '' }}</p>
                                        <div class="cancel-bg">
                                            <a href="#"><img
                                                    src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}"
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center" id="tag_name">Add In Scope</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST">
                        @csrf
                        <input type="hidden" id="tag_id" name="tag_id" value="1">
                        <input type="text" class="form-control mt-4" name="name" id="value"
                            placeholder="Type here" required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit">Add</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center" id="tag_name">Add Out Scope</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST">
                        @csrf
                        <input type="hidden" id="tag_id" name="tag_id" value="2">
                        <input type="text" class="form-control mt-4" name="name" id="value"
                            placeholder="Type here" required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit">Add</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Add Services</h5>
                    <form action="{{ route('SaveMaster') }}" method="POST">
                        @csrf
                        <input type="hidden" id="tag_id_ser" name="tag_id" value="3">
                        <input type="text" class="form-control mt-4" name="name" placeholder="Type name here"
                            required>
                        <input type="number" class="form-control mt-4" name="price" placeholder="Type price here"
                            required>


                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit">Add</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-------------------- Approval-Product-Jquery -------------------->
    <script>
        << << << < HEAD

        function Get_Tag_Name(Tag_name, Tag_id) {
            document.getElementById("tag_name").innerText = Tag_name;
            document.getElementById("tag_id").value = Tag_id;
        } ===
        ===
        =
        function Get_Tag_Name(Tag_name, Tag_id) {
            document.getElementById("tag_name").innerText = Tag_name;
            document.getElementById("tag_id").value = Tag_id;
        }

        >>>
        >>>
        >
        6 a525aa1cd40943f9fda182bf0d1eb4be2f77158
    </script>

@endsection
