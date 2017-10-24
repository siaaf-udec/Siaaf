@extends('material.layouts.dashboard')
@permission('auxapoyo')
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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Reporte docentes'])
            <div class="row">
                {{--DIVISION NAV--}}
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['id'=>'form-reporte', 'method'=>'POST', 'route'=> ['espacios.academicos.report.repDoc'], 'target'=>'_blank']) !!}

                    <div class="form-body">
                        {!! Field::select('SOL_laboratorios',
                            ['Aulas de Computo' => 'Aulas de Computo',
                            'Laboratorio psicología' => 'Laboratorio psicología',
                            'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales'],
                            null,
                            [ 'label' => 'Espacio académico:']) !!}

                        {!! Field::select(
                                                            'aula', null,
                                                            ['name' => 'aula']) !!}
                        <br>

                        {!! Field::text('date_range',['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
                        ['help' => 'Seleccione un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0" align="center">
                                    {{ Form::submit('Reporte Docentes', ['class' => 'btn blue']) }}

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
    {{--Form wizard--}}
    <script src="{{ asset('assets/main/acadspace/js/form-wizard.js') }}" type="text/javascript"></script>
    <script>
        /*PINTAR TABLA*/
        $(document).ready(function () {
            //Aplicando style a select
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });

            moment.locale('es');
            $('input[name="date_range"]').daterangepicker();
            $("#SOL_laboratorios").change(function (event) {
                /*Cargar select de aulas*/
                $.get("cargarSalasReportes/" + event.target.value + "", function (response) {
                    $("#aula").empty();
                    $("#aula").append("<option value=''></option>");
                    for (i = 0; i < response.length; i++) {
                        $("#aula").append("<option value='" + response[i].PK_SAL_Id_Sala + "'>" + response[i].SAL_Nombre_Sala + "</option>")
                    }
                });
            });

            var createUsers = function () {
            };
            var form_edit = $('#form-reporte');
            var rules_edit = {
                aula: {required: true},
                SOL_laboratorios: {required: true}
            };
            FormValidationMd.init(form_edit, rules_edit, false, createUsers());


        });


    </script>
@endpush
@endpermission
