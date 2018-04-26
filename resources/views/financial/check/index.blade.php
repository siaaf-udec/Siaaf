@extends('material.layouts.dashboard')

@push('styles')
    <!-- Bootstrap Modal Extended Style -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 Style -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.check.title'))

@section('page-title', trans('financial.check.index.title'))

@section('page-description', trans('financial.check.index.description'))

@section('content')
    <div class="col-md-12" id="app">
        <check></check>
    </div>
@endsection

@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <!-- Bootstrap Modal Extended Scripts  -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
    <!-- Maxlength Scripts -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <!-- Validation Scripts -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_'.config('app.locale').'.js') }}" type="text/javascript"></script>
    <!-- Select2 Scripts -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/i18n/'.config('app.locale').'.js') }}"></script>
@endpush


@push('functions')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endpush