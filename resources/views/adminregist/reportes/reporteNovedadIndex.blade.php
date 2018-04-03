@extends('material.layouts.dashboard')
@section('page-title', 'Reportes:')
@push('styles')
    {{--Select2--}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    {{--Date--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Reportes por Novedad'])
            <div class="row">
                {{--DIVISION NAV--}}
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['id'=>'form-reporte', 'class' => 'form-horizontal', 'method'=>'POST', 'route'=> ['adminRegist.report.novedad'], 'target'=>'_blank']) !!}
                    <div class="form-body">
                        {!! Field::select(
                        'novedad',
                        ['1' => 'Matricula','2' => 'Estudiantes Matriculados', '3' => 'Aplicación Transferencias Internas','4' => 'Modificación Situación Estudiante', '5' => 'Aplicación Cancelación de Materia', '6' => 'Aplicación Traslado', '7' => 'Aplicación Homologaciones', '8' => 'Validaciones y Habilitaciones', '9' => 'Modificación de Notas'],null,
                        ['label' => 'Novedades' , 'autofocus', 'auto' => 'off']) !!}
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0" align="center">
                                    {{ Form::submit('Generar Reporte', ['class' => 'btn blue']) }}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
    </div>
    {{-- FIN DIVISION NAV--}}

    @endcomponent

@endsection

@push('plugins')
    {{--Select 2--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    {{--Moment--}}
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    {{--Daterange--}}
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
            type="text/javascript"></script>
    {{-- wizard Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"
            type="text/javascript"></script>
    {{--MaxLength--}}
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>
    {{--Validation--}}
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>
@endpush

@push('functions')
    {{--Validation--}}
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            /*Select*/
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });
            /*Wizard*/
            var report = function () {
            };
            var form_report = $('#form-reporte');
            var rules_report = {
                novedad: {required: true}
            };
            FormValidationMd.init(form_report, rules_report, false, report());
        });
    </script>
@endpush