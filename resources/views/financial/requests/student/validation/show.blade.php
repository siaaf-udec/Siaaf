@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Blog Styles -->
    <link href="{{ asset('assets/pages/css/blog.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Date Picker Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ladda Styles -->
    <link href="{{ asset('assets/global/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert Styles -->
    <link href="{{ mix('assets/pages/scripts/financial/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Loading Styles -->
    <link href="{{ mix('assets/pages/scripts/financial/loading.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.validation.title'))

@section('page-title', trans('financial.validation.show.title'))

@section('page-description', trans('financial.validation.show.description'))

@section('content')
    <div class="col-md-12" id="app" data-source="{{ $id }}">
        <student-validation-request-show></student-validation-request-show>
    </div>
@endsection



@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <!-- Validation Scripts -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_'.config('app.locale').'.js') }}" type="text/javascript"></script>
    <!-- Date Picker Scripts -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.config('app.locale').'.min.js') }}" type="text/javascript"></script>
    <!-- Ladda Scripts -->
    <script src="{{ asset('assets/global/plugins/ladda/spin.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/ladda/ladda.min.js') }}" type="text/javascript"></script>
    <!-- Maxlength Scripts -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <!-- Loading Scripts -->
    <script src="{{ mix('assets/pages/scripts/financial/loading.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@endpush