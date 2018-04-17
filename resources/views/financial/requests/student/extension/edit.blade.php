@extends('material.layouts.dashboard')

@push('styles')
    <!-- SweetAlert Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- Spinner Styles -->
    <link href="{{asset('assets/global/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 Style -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.extension.title'))

@section('page-title', trans('financial.extension.edit.title'))

@section('page-description', trans('financial.extension.edit.description'))

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers', 'title' => trans('financial.extension.edit.title')])
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        @include('financial.templates.errors.laravel-errors')
                    @endif
                </div>
                <div class="col-md-12">
                    {{ Form::open(['role' => 'form', 'method' => 'PUT', 'id' => 'financial-form-extension', 'route' => ['financial.requests.student.extension.update', $id]]) }}
                    <div class="form-body">
                        {!! Field::select('program', [ '' => trans('validation.select') ] , ['required', 'disabled']) !!}
                        {{ Form::hidden('program_select', ( isset( $extension->{ program_fk() } ) ) ? $extension->{ program_fk() } : 0, ['id' => 'program_select'] ) }}
                        {!! Field::select('subject_matter', [ '' => trans('validation.select') ], ['required', 'disabled']) !!}
                        {{ Form::hidden('subject_select', ( isset( $extension->{ subject_fk() } ) ) ? $extension->{ subject_fk() } : 0, ['id' => 'subject_select'] ) }}
                        {!! Field::select('teacher', [ '' => trans('validation.select') ], ['required', 'disabled']) !!}
                        {{ Form::hidden('teacher_select', ( isset( $extension->{ teacher_fk() } ) ) ? $extension->{ teacher_fk() } : 0, ['id' => 'teacher_select'] ) }}
                    </div>
                    <div class="form-actions">
                        {{ Form::submit( trans('financial.buttons.apply') , ['class' => 'btn green']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        @endcomponent
    </div>
@endsection

@push('routes')
    @routes('api_options')
@endpush

@push('plugins')
    <!-- Validation Scripts -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_'.config('app.locale').'.js') }}" type="text/javascript"></script>
    <!-- SweetAlert Scripts -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <!-- Spinner Scripts -->
    <script src="{{ asset('assets/global/plugins/ladda/spin.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/ladda/ladda.min.js') }}" type="text/javascript"></script>
    <!-- Select2 Scripts -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/i18n/'.config('app.locale').'.js') }}"></script>
@endpush

@push('functions')
    <script src="{{ asset('assets/pages/scripts/ui-buttons-spinners.js') }}" type="text/javascript"></script>
    <script src="{{ mix('assets/pages/scripts/financial/financial-form-extension-validation.min.js') }}" type="text/javascript"></script>
    <script src="{{ mix('assets/pages/scripts/financial/financial-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ mix('assets/pages/scripts/financial/edit-requests-filter-select2.min.js') }}" type="text/javascript"></script>
@endpush