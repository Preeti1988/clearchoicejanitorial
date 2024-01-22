@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Client')
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/create-service.css') }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
@endpush
@section('content')


    <div class="body-main-content">
        <div class="create-service-section">
            <div class="create-service-heading">
                <h3>Privacy Policy</h3>
            </div>
            <div class="create-service-form">
                <form action="{{ route('privacy.save') }}" method="POST" id="create-service" enctype="multipart/form-data">
                    @csrf




                    <div class="create-service-form-box">
                        <h1>Privacy Policy</h1>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <textarea name="value" id="editor" cols="30" rows="10">{{ $content->value }}</textarea>
                                </div>
                            </div>
                        </div>


                    </div>







                    <div class="create-service-form-action">

                        <button class="Savebtn" type="submit"> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
