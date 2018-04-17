@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.management.programs.title'))

@section('page-title', trans('financial.management.programs.index.title'))

@section('page-description', trans('financial.management.programs.index.description'))

@section('content')
    <div class="col-md-12" id="app">
        <portlet icon="fa fa-university" title="{{ trans('financial.management.programs.index.title') }}">
            <template slot="body">
                <management-programs></management-programs>
            </template>
        </portlet>
        <empty-sortable-portlet></empty-sortable-portlet>
    </div>
@endsection

@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endpush