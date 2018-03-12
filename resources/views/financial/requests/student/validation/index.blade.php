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

@section('title', ' | Solicitudes')

@section('page-title', 'Solicitud de Validación de Materias')

@section('page-description', 'solicitud y verificación del recurso')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers', 'title' => 'Solicitud de Validación de Materias'])
            <div class="row">
                <div class="col-md-12">
                    {{ Form::open(['role' => 'form', 'id' => 'financial-form-extension', 'route' => 'financial.requests.student.validation.store']) }}
                        <div class="form-body">
                            {!! Field::select('program', $programs, ['required']) !!}
                            {!! Field::select('teacher', $teachers, ['required']) !!}
                            {!! Field::select('subject_matter', $subjects, ['required']) !!}
                        </div>
                        <div class="form-actions">
                            {{ Form::submit('Solicitar', ['class' => 'btn green']) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        @endcomponent
    </div>

    <div class="col-md-12">
        @if(session('subject'))
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers', 'title' => 'Mis Solicitudes de Validaciones'])
                <div class="timeline  bg-inverse">
                    <!-- TIMELINE ITEM -->
                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <div class="timeline-icon">
                                <i class="icon-docs font-red-intense"></i>
                            </div>
                        </div>
                        <div class="timeline-body">
                            <div class="timeline-body-arrow"> </div>
                            <div class="timeline-body-head">
                                <div class="timeline-body-head-caption">
                                    <span class="timeline-body-alerttitle font-green-haze">{{ session('subject') }}</span>
                                    <span class="timeline-body-time font-grey-cascade">{{ \Carbon\Carbon::now()->toFormattedDateString() }}</span>
                                </div>
                            </div>
                            <div class="timeline-body-content">
                                <span class="font-grey-cascade"> {{ session('program') }}
                                    <a href="javascript:;">{{ session('teacher') }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- END TIMELINE ITEM -->
                </div>
            @endcomponent
        @else
            <div class="m-heading-1 border-green m-bordered">
                <h3>No hay solicitudes</h3>
                <p>No hay solicitudes pendientes</p>
            </div>
        @endif
    </div>
@endsection

@push('plugins')
<!-- Validation Scripts -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/financial-form-extension-validation.min.js') }}" type="text/javascript"></script>
<!-- SweetAlert Scripts -->
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<!-- Spinner Scripts -->
<script src="{{ asset('assets/global/plugins/ladda/spin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/ladda/ladda.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/ui-buttons-spinners.js') }}" type="text/javascript"></script>
<!-- Select2 Scripts -->
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
<script src="{{ mix('assets/pages/scripts/financial/financial-select2.min.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
<script>
    $(document).ready(function() {
        FormValidationExtension.init();
    });
</script>
@endpush