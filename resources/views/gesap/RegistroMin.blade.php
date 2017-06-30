@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
@endpush



@section('title', '| Dashboard')


@section('page-title', 'Dashboard')


@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])

    <a href="{{ route('min.index') }}">Listar</a>
    {!! Form::open(['id' => 'form_material', 'class' => '', 'url' => '/forms']) !!}
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
            {!! Field::text('title',
                ['label' => 'Titulo del proyecto', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                ['help' => 'Ingrese el titulo del proyecto', 'icon' => 'fa fa-user']) !!}
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6">
            {!! Field::select('estudiante1',
                ['1' => 'Daniel', '2' => 'Felipe'],
                null,
                [ 'label' => 'Estudiante 1']) !!}
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6">
            {!! Field::select('estudiante2',
                    ['1' => 'Daniel', '2' => 'Felipe'],
                    null,
                    [ 'label' => 'Estudiante 2']) !!}
        </div>
        <div class="col-xs-12 col-md-12 col-lg-12">
            {!! Field::text(
                'Keywords',
                ['label' => 'Palabras Clave', 'max' => '50', 'min' => '2', 'required', 'auto' => 'off'],
                ['help' => 'Palabras Clave (max 5)', 'icon' => 'fa fa-user']) !!}
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            {!! Field::text('Duracion',
                ['label' => 'Duracion del Proyecto', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                ['help' => 'Duracion del Proyecto', 'icon' => 'fa fa-user']) !!}
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            {!! Field::date('FechaR',
                ['label' => 'Fecha de Radicacion','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                ['help' => '', 'icon' => 'fa fa-calendar']) !!}
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            {!! Field::date('FechaL',
                ['label' => 'Fecha Limite','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                ['help' => '', 'icon' => 'fa fa-calendar']) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-xs-12 col-md-12 col-lg-12">
            {{ Form::reset('Reset', ['class' => 'btn yellow-gold','style'=>'float:right;margin-left:1rem']) }}
            {{ Form::submit('Validar', ['class' => 'btn green','style'=>'float:right']) }}
        </div>
    </div>
@endcomponent
@endsection



@push('plugins')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>


    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

@endpush

@push('functions')
<script type="text/javascript">
var ComponentsDateTimePickers = function () {
            var handleDatePickers = function () {
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        regional: 'es',
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'yyyy-mm-dd',
                        firstDay: 1,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                    });
                }
            }

            return {
                init: function () {
                    handleDatePickers();
                }
            };
        }();
    
var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");

            $(".pmd-select2").select2({
                width: null,
                placeholder: "Selecccionar",
            });

        }

        return {
            init: function() {
                handleSelect();
            }
        };

    }();
    
var FormValidationMd = function() {

            $.validator.addMethod(
                'passwordStr',
                function (value, element) {
                    return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{6,}/.test(value);
                },
                "Tu contraseña debe tener al menos 6 caracteres, al menos una letra mayúscula, una letra minúscula, números y caracteres especiales."
            );

            $.validator.addMethod(
                'phone',
                function (value, element) {
                    return this.optional(element) || /^(1?(-?\d{3})-?)?(\d{3})(-?\d{4})$/.test(value);
                },
                "Digita un número de teléfono válido."
            );

            var handleValidation = function() {

                var form1 = $('#form_material');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: true, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    messages: {
                        'tags[]': {
                            required: 'Por favor marca una opción',
                            minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                        },
                        'radios': {
                            required: 'Por favor marca una opción',
                            minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                        }
                    },
                    rules: {
                        name: {
                            minlength: 2,
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            passwordStr: true,
                            required: true,
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        },
                        url: {
                            required: true,
                            url: true
                        },
                        'tags[]': {
                            required: true,
                            minlength: 3,
                        },
                        radios: {
                            required: true,
                            minlength: 1,
                        },
                    },

                    invalidHandler: function(event, validator) { //display error alert on form submit
                        success1.hide();
                        error1.show();
                        App.scrollTo(error1, -200);
                    },

                    errorPlacement: function(error, element) {
                        if (element.is(':checkbox')) {
                            error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                        } else if (element.is(':radio')) {
                            error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                        } else {
                            error.insertAfter(element); // for other inputs, just perform default behavior
                        }
                    },

                    highlight: function(element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function(element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function(label) {
                        label
                            .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },

                    submitHandler: function(form) {
                        success1.show();
                        error1.hide();
                    }
                });
            }

            return {
                //main function to initiate the module
                init: function() {
                    handleValidation();
                }
            };
        }();    

        jQuery(document).ready(function() {
            FormValidationMd.init();
            ComponentsSelect2.init();
            ComponentsDateTimePickers.init();
        });

</script>

@endpush