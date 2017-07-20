@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title','Creación de eventos:')


@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de eventos: '])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::model ($evento,['id'=>'form_eventos','method'=>'PUT', 'route'=> ['talento.humano.evento.update', $evento->PK_EVNT_IdEvento],'role'=>"form"]) !!}
                    {!! Field::textarea(
                            'EVNT_Descripcion',
                            ['label' => 'Descripción del evento:', 'required', 'auto' => 'off', 'max' => '300', "rows" => '4'],
                            ['help' => 'Escribe una descripción.', 'icon' => 'fa fa-quote-right']) !!}
                    {!! Field::date(
                            'EVNT_Fecha',
                            ['label' => 'Fecha del evento:','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digita la fecha de realización del evento.', 'icon' => 'fa fa-calendar']) !!}
                    {!! Field::text(
                            'EVNT_Hora',
                            ['label'=>'Hora:','class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "hh/mm-", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                            ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}

                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-offset-4">
                                {!! Form::submit('Editar',['class' => 'btn blue']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
    </div>
    @endcomponent

@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>
            @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.options.closeButton = true;
            toastr.info("{{Session::get('message')}}",'Modificación exitosa:');
            break;
    }
            @endif


    var ComponentsDateTimePickers = function () {
        var handleTimePickers = function () {

            if (jQuery().timepicker) {

                $('.timepicker-no-seconds').timepicker({
                    autoclose: true,
                    format: 'HH:mm',
                    minuteStep: 1,
                    //defaultTime: 'current',
                    //showMeridian: false,
                });

            }
        }

        return {
            init: function () {
                handleTimePickers();
            }
        };
    }();
    var FormValidationMd = function() {


        var handleValidation = function() {

            var form1 = $('#form_eventos');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: true,
                ignore: "",
                rules: {
                    EVNT_Descripcion: {

                        required: true
                    },
                    EVNT_Fecha: {
                        required: true,

                    },
                    EVNT_Hora: {
                        passwordStr: true,
                        required: true,
                    },


                },
                messages:{
                    EVNT_Descripcion: {

                        required: "Debes ingresar la descripci'on del evento"
                    },
                    EVNT_Fecha: {
                        required: "Debes ingresar cuando se realizara el evento"

                    },
                    EVNT_Hora: {

                        required: "Debes ingresar la hora del evento"
                    },

                },

                invalidHandler: function(event, validator) {
                    success1.hide();
                    error1.show();
                    toastr.options.closeButton = true;
                    toastr.options.showDuration= 1000;
                    toastr.options.hideDuration= 1000;
                    toastr.error('Debes corregir algunos campos','Registro fallido:')
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
                    toastr.options.closeButton = true;
                    toastr.options.showDuration= 1000;
                    toastr.options.hideDuration= 1000;
                    toastr.success('Información del funcionario almacenada correctamente','Registro exitoso:')
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
    var ComponentsBootstrapMaxlength = function () {

        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                limitReachedClass: "label label-danger",
                alwaysShow: true
            });
        };

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
        ComponentsDateTimePickers.init();
    });

</script>
@endpush