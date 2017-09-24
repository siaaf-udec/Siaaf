@extends('material.layouts.dashboard')

@section('page-title', 'Registro de solicitud:')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de solicitud'])



            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open ([ 'method'=>'POST', 'route'=> ['espacios.academicos.espacad.store'], 'id'=>'form_material']) !!}

                    <div class="form-body">
                        {!! Field::hidden('ID_Practica', '1') !!}

                        {!! Field::radios('SOL_ReqGuia',['Si'=>'Si', 'No'=>'No'], ['list', 'label'=>'Requiere guia de practica', 'icon'=>'fa fa-user']) !!}

                        {!! Field::text('SOL_nucleo_tematico',null,['label'=>'Nucleo tematico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                        ['help' => 'Digite el nucleo tematico.','icon'=>'fa fa-building-o'] ) !!}

                        {!! Form::label('soft', 'Requiere software') !!}
                        {!! Form::select('SOL_NombSoft', $software, null, ['class' => 'form-control'] ) !!}
                        {{ Form::hidden('espacio', 'espacio') }}

                        {!! Field::text('SOL_grupo',null,['label'=>'Grupo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                        ['icon'=>'fa fa-group'] ) !!}

                        {!! Field::text('SOL_cant_estudiantes',null,['label'=>'Cantidad de estudiantes:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                        ['icon'=>'fa fa-group'] ) !!}

                        {!! Field::date('SOL_fecha_inicial',
                        ['label' => 'Fecha inicial', 'required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                        ['icon' => 'fa fa-calendar']) !!}

                        {!! Field::text(
                        'SOL_hora_inicio',
                        ['label' => 'Hora de inicio', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                        ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}

                        {!! Field::text(
                        'SOL_hora_fin',
                        ['label' => 'Hora de fin', 'class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                        ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}




                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                        {{ Form::reset('Cancelar', ['class' => 'btn btn-danger']) }}

                    </div>
                </div>
            </div>


            {!! Form::close() !!}
    </div>
    </div>
    </div>

    @endcomponent
    </div>
@endsection

@push('plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script type="text/javascript">
            @if(Session::has('message'))
                var type="{{Session::get('alert-type','info')}}"
            switch(type){
                case 'success':
                toastr.options.closeButton = true;
                toastr.success("{{Session::get('message')}}",'Registro exitoso:');
                break;
            }
            @endif
    //--1

    var FormValidationMd = function() {

        var handleValidation = function() {

            var form1 = $('#form_material');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: true,
                ignore: "",
                rules: {
                    SOL_ReqGuia: {
                        required: true
                    },
                    SOL_nucleo_tematico: {
                        required: true
                    },

                    SOL_grupo:{
                        required: true
                    },
                    SOL_cant_estudiantes:{
                        required: true,
                        number: true
                    },
                    SOL_fecha_inicial:{
                        required: true
                    },
                    SOL_hora_inicio:{
                        required: true
                    },
                    SOL_hora_fin:{
                        required: true
                    }
                },
                messages: {
                    SOL_nucleo_tematico: {
                        required: 'Digita el campo',
                    },
                    SOL_grupo: {
                        required: 'Digita el campo',
                    },
                    SOL_cant_estudiantes: {
                        required: 'Digita el campo',
                    },
                    SOL_fecha_inicial: {
                        required: 'Digita el campo',
                    },
                    SOL_hora_inicio: {
                        required: 'Digita el campo',
                    },
                    SOL_hora_fin: {
                        required: 'Digita el campo',
                    },
                    SOL_ReqGuia: {
                        required: 'Por favor marca una opción',
                        minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                    }
                },

                invalidHandler: function(event, validator) {
                    success1.hide();
                    error1.show();
                    toastr.options.closeButton = true;
                    toastr.options.showDuration= 1000;
                    toastr.options.hideDuration= 1000;
                    toastr.error('Debe corregir algunos campos','Registro fallido:')
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function(error, element) {
                    if (element.is(':checkbox')) {
                        error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                    } else if (element.is(':radio')) {
                        error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                    } else {
                        error.insertAfter(element);
                    }
                },

                highlight: function(element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error');
                },

                unhighlight: function(element) {
                    $(element)
                        .closest('.form-group').removeClass('has-error');
                },

                success: function(label) {
                    label
                        .closest('.form-group').removeClass('has-error');

                },

                submitHandler: function(form1) {
                    success1.show();
                    error1.hide();
                    form1.submit();
                }
            });
        }

        return {
            init: function() {
                handleValidation();
            }
        };
    }();

    var ComponentsDateTimePickers = function () {
        var handleTimePickers = function () {
            if (jQuery().timepicker) {
                $('.timepicker-no-seconds').timepicker({
                    autoclose: true,
                    minuteStep: 5,
                });

            }
        }

        return {
            init: function () {
                handleTimePickers();
            }
        };
    }();
            jQuery(document).ready(function() {
                ComponentsDateTimePickers.init();
            });

    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                limitReachedClass: "label label-danger",
                alwaysShow: true
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };

    }();
    jQuery(document).ready(function() {
        FormValidationMd.init();
        ComponentsBootstrapMaxlength.init();
    });


</script>
@endpush