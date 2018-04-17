@extends('material.layouts.dashboard')

@push('styles')
    <!-- Select2 Style -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.extension.title'))

@section('page-title', trans('financial.extension.create.title'))

@section('page-description', trans('financial.extension.create.description'))

@section('content')
    <div class="col-md-12" id="app">
        <student-extension-request-create></student-extension-request-create>
        {{--
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers', 'title' => trans('financial.extension.create.title')])
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        @include('financial.templates.errors.laravel-errors')
                    @endif
                </div>
                <div class="col-md-12">
                    {{ Form::open(['role' => 'form', 'id' => 'financial-form-extension', 'route' => 'financial.requests.student.extension.store']) }}
                    <div class="form-body">
                        {!! Field::select('program', [ '' => trans('validation.select') ] , ['required', 'disabled']) !!}
                        {!! Field::select('subject_matter', [ '' => trans('validation.select') ], ['required', 'disabled']) !!}
                        {!! Field::select('teacher', [ '' => trans('validation.select') ], ['required', 'disabled']) !!}
                    </div>
                    <div class="form-actions">
                        {{ Form::submit( trans('financial.buttons.apply') , ['class' => 'btn green tooltips', 'data-riginal-title' => trans('javascript.tooltip.add')]) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        @endcomponent
        --}}
    </div>
@endsection

@push('plugins')
    <!-- Max Length Scripts -->
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
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@endpush