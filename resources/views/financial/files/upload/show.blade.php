@extends('material.layouts.dashboard')

@push('styles')
    <!-- Loading Styles -->
    <link href="{{ mix('assets/pages/scripts/financial/loading.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.files.upload.title'))

@section('page-title', trans('financial.files.upload.index.title'))

@section('page-description', trans('financial.files.upload.index.description'))

@section('content')
    <div class="col-md-12" id="app" ref="showFile" data-id="{{ isset( $id ) ? $id : null }}">
        <file-upload-show></file-upload-show>
    </div>
@endsection

@push('plugins')
    <!-- Maxlength Scripts -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <!-- PDF Scripts -->
    <script src="{{ asset('assets/pages/scripts/financial/pdfobject.min.js') }}" type="text/javascript"></script>
    <!-- Loading Scripts -->
    <script src="{{ mix('assets/pages/scripts/financial/loading.min.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endpush