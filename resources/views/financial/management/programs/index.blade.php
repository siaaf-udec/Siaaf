@extends('material.layouts.dashboard')

@push('styles')
    <!-- Bootstrap Modal Extended Style -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
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
            <template slot="actions">
                <a class="btn btn-circle btn-icon-only btn-default tooltips" data-placement="top" data-original-title="¿Qué puedo hacer?" data-toggle="modal" href="#modal-faq">
                    <i class="fa fa-question"></i>
                </a>
            </template>
            <template slot="body">
                <management-programs></management-programs>
            </template>
        </portlet>
        <empty-sortable-portlet></empty-sortable-portlet>
        <vue-modal id="modal-faq" modal-class="container" title="¿Qué puedo hacer?">
            <template slot="body">
                <p class="text-center">Video de Ayuda</p>
                {{-- <youtube video-id="BBJa32lCaaY" ></youtube> --}}
            </template>
        </vue-modal>
    </div>
@endsection

@push('plugins')
    <!-- Bootstrap Modal Extended Scripts  -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endpush