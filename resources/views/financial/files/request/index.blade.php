@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{ asset('assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 Style -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
    <!-- Loading Styles -->
    <link href="{{ mix('assets/pages/scripts/financial/loading.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.files.management.title'))

@section('page-title', trans('financial.files.management.index.title'))

@section('page-description', trans('financial.files.management.index.description'))

@section('content')
    <div class="col-md-12" id="app">
        <file-management></file-management>
    </div>
@endsection



@push('plugins')
    <script src="{{ asset('assets/global/plugins/highcharts/js/highcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/highcharts/js/highcharts-3d.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/highcharts/js/highcharts-more.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/highcharts/js/modules/exporting.js') }}" type="text/javascript"></script>

    <!-- Waypoints Scripts -->
    <script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <!-- Counter Up Scripts -->
    <script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <!-- Maxlength Scripts -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <!-- Validation Scripts -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_'.config('app.locale').'.js') }}" type="text/javascript"></script>
    <!-- PDF Scripts -->
    <script src="{{ asset('assets/pages/scripts/financial/pdfobject.min.js') }}" type="text/javascript"></script>
    <!-- Select2 Scripts -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/i18n/'.config('app.locale').'.js') }}"></script>
    <!-- Loading Scripts -->
    <script src="{{ mix('assets/pages/scripts/financial/loading.min.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endpush