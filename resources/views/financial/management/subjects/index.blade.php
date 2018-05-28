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

@section('title', trans('financial.management.subjects.title'))

@section('page-title', trans('financial.management.subjects.index.title'))

@section('page-description', trans('financial.management.subjects.index.description'))

@section('content')
    <div class="col-md-12" id="app">
        <portlet icon="fa fa-book" title="{{ trans('financial.management.subjects.index.title') }}">
            <template slot="actions">
                <a class="btn btn-circle btn-icon-only btn-default tooltips" data-placement="top" data-original-title="¿Qué puedo hacer?" data-toggle="modal" href="#modal-faq">
                    <i class="fa fa-question"></i>
                </a>
            </template>
            <template slot="body">
                <management-subjects></management-subjects>
            </template>
        </portlet>
        <empty-sortable-portlet></empty-sortable-portlet>
        <vue-modal id="modal-faq" modal-class="container" title="¿Qué puedo hacer?">
            <template slot="body">
                <div class="col-md-12 text-center">
                    <youtube video-id="mZLgbOwpJzo" ></youtube>
                    <p class="text-center">Video de Ayuda</p>
                </div>
            </template>
        </vue-modal>
    </div>
@endsection

@push('plugins')
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
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endpush