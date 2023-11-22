@extends('layouts.admin')
@section('title', 'Clear Choice Janitorial - Master')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/assets/admin-css/newteammeber.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Add New Client</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('SaveClient') }}" method="POST">
                    @csrf
                    <div class="create-service-form-box">
                        <h1>Members Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>First Name</h3>
                                    <input type="text" class="form-control" name="" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Last Name</h3>
                                    <input type="text" class="form-control" name="" placeholder="Last Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Display Name</h3>
                                    <input type="text" class="form-control" name="" placeholder="Display Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Email Address</h3>
                                    <input type="text" class="form-control" name="" placeholder="Display Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Company Name</h3>
                                    <input type="text" class="form-control" name="" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Mobile phone</h3>
                                    <input type="text" class="form-control" name="" placeholder="Mobile phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Home phone</h3>
                                    <input type="text" class="form-control" name="" placeholder="Home phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Work phone</h3>
                                    <input type="text" class="form-control" name="" placeholder="Work phone">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Maritial Status</h3>
                                    <select class="form-control">
                                        <option>Male </option>
                                        <option>Female </option>
                                        <option>Others </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Date Of birth</h3>
                                    <input type="date" class="form-control" name="">
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <h3>Owner Type</h3>
                                    <ul class="Ownertype-list">
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="Ownertype" id="Home Owner">
                                                <label for="Home Owner">Home Owner</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ccjradio">
                                                <input type="radio" name="Ownertype" id="Business">
                                                <label for="Business">Business</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Address Info.</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address (additional addresses)</h3>
                                    <textarea type="text" class="form-control" name="" placeholder="Address"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3>Address Notes</h3>
                                    <textarea type="text" class="form-control" name="" placeholder="Address Notes"></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Street</h3>
                                    <input type="text" class="form-control" name="" placeholder="Street">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Unit</h3>
                                    <input type="text" class="form-control" name="" placeholder="Unit">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Country</h3>
                                    <select class="form-control" name="country">
                                        <option>Alabama </option>
                                        <option>Alaska </option>
                                        <option>Arizona </option>
                                        <option>Arkansas </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>State</h3>
                                    <select class="form-control">
                                        <option>Alabama </option>
                                        <option>Alaska </option>
                                        <option>Arizona </option>
                                        <option>Arkansas </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>City</h3>
                                    <select class="form-control">
                                        <option>Montgomery </option>
                                        <option>Juneau</option>
                                        <option>Phoenix</option>
                                        <option>Little Rock</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-group">
                                    <h3>Zip</h3>
                                    <input type="text" class="form-control" name="" placeholder="Zip">
                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="create-service-form-box">
                        <h1>Client Info.</h1>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Notes</h3>
                                    <input type="text" class="form-control" name="" placeholder="Notes">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Client Tags</h3>
                                    <input type="text" class="form-control" name="" placeholder="Tages">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>This Client bill's to</h3>
                                    <input type="text" class="form-control" name="" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h3>Lead Source </h3>
                                    <input type="text" class="form-control" name=""
                                        placeholder="Display Name">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h3>Send Notification</h3>
                                    <div class="ccjcheckbox">
                                        <input type="checkbox" name="" id="Home Owner">
                                        <label for="Home Owner">send notifications to a client</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="create-service-form-action">
                        <button class="cancelbtn">cancel</button>
                        <button class="Savebtn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
