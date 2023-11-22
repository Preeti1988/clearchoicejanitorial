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
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addNewValueServices">Add Services</a>
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
                                    <p class="mb-0">{{ ($val->name) ?? ''}}</p>
                                    <div class="cancel-bg">
                                        <a href="#"><img src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}" alt=""></a>
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
                            <img src="{{ asset('public/assets/admin-images/master-designation.svg') }}">
                        </div>
                        <div class="master-card-head">
                            <h2 class="ms-2 mb-0">Designation</h2>
                        </div>
                    </div>
                </div>
                <div class="add-new-master">
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal" data-bs-target="#addNewValue" onclick='Get_Tag_Name("Add Designation","4")'>Add Designation</a>
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
                                    <p class="mb-0">{{ ($val->name) ?? ''}}</p>
                                    <div class="cancel-bg">
                                        <a href="#"><img src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}" alt=""></a>
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
                    <a class="add-new-service-btn" href="#" data-bs-toggle="modal"
                        data-bs-target="#addNewValue" onclick='Get_Tag_Name("Add Marital Status","5")'>Add Marital Status</a>
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
                                    <p class="mb-0">{{ ($val->name) ?? ''}}</p>
                                    <div class="cancel-bg">
                                        <a href="#"><img src="{{ asset('public/assets/admin-images/cancel-icon.svg') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNewValue" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center" id="tag_name"></h5>
                    <form action="{{ route('SaveMaster') }}" method="POST">
                        @csrf
                        <input type="hidden" id="tag_id" name="tag_id" value="" >
                        <input type="text" class="form-control mt-4" name="name" id="value" placeholder="Type here">
                        <div class="text-center">
                            <button class="add-new-value-btn mt-3" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                        <input type="hidden" id="tag_id_ser" name="tag_id" value="3" >
                        <input type="text" class="form-control mt-4" name="name" placeholder="Type name here">
                        <input type="number" class="form-control mt-4" name="price" placeholder="Type price here">
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
        function Get_Tag_Name(Tag_name,Tag_id) {
            document.getElementById("tag_name").innerText = Tag_name;
            document.getElementById("tag_id").value = Tag_id;
        }
        
    </script>

@endsection
