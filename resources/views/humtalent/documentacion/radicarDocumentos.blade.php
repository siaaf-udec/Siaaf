@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de documentos solicitados'])
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                        {!! Form::open (['id'=>'form-radicar','method'=>'POST', 'route'=> ['talento.humano.radicarDocumentos'], 'role'=>"form"]) !!}

                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example-table-ajax">
                                <thead>
                                <th>Número de Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Rol</th>
                                <th>Área o Programa</th>
                                </thead>
                                @foreach($empleados as $empleado)
                                    <tbody>
                                    <td>{{$empleado->PK_PRSN_Cedula}}</td>
                                    <td>{{$empleado->PRSN_Nombres}}</td>
                                    <td>{{$empleado->PRSN_Apellidos}}</td>
                                    <td>{{$empleado->PRSN_Rol}}</td>
                                    <td>{{$empleado->PRSN_Area}}</td>
                                    </tbody>
                                @endforeach
                            </table>
                            {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula) !!}

                            {!!  Field::checkboxes('FK_Personal_Documento',$docs,$seleccion,['list', 'label'=>'Seleccione si fue entregado el Documento']) !!}
                             {!! Field::date('EDCMT_Fecha',
                                ['label'=>'Fecha','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                ['help' => 'Selecciona la fecha de radicación.', 'icon' => 'fa fa-calendar']) !!}

                         {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            @endcomponent
            </div>


@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript" charset="UTF-8"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>
            @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'success':
            toastr.options.closeButton = true;
            toastr.success("{{Session::get('message')}}",'Registro exitoso:');
            break;
    }
            @endif
    var FormValidationMd = function() {
        var handleValidation = function() {

            var form1 = $('#form-radicar');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: true,
                ignore: "",
                rules: {
                    EDCMT_Fecha: {
                        required: true
                    }


                },
                messages:{
                    EDCMT_Fecha: {
                        required: "Debes seleccionar una fecha de radicación."
                    }


                },

                invalidHandler: function(event, validator) {
                    success1.hide();
                    error1.show();
                    toastr.options.closeButton = true;
                    toastr.options.showDuration= 1000;
                    toastr.options.hideDuration= 1000;
                    toastr.error('Debes corregir algunos campos','Error:')
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
        var handleDatePickers = function () {
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    language: 'es',
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
    jQuery(document).ready(function() {
        FormValidationMd.init();
        ComponentsDateTimePickers.init();
    });
</script>
@endpush