@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush



@section('title', '| Anteproyectos')


@section('page-title', 'Modificar')


@section('page-description', 'Modificar anteproyectos')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-edit', 'title' => 'Modificacion'])

<div class="row">
        
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{{ route('min.index') }}">
                    <button id="sample_editable_1_new" class="btn green" style="margin-bottom:-8px;"> 
                        <i class="fa fa-list"></i>Listar
                    </button>
                </a> 
            </div>
        </div>


    @foreach ($anteproyectos as $anteproyecto)
{!! Form::open(['route' => array('min.update', $anteproyecto->PK_NPRY_idMinr008), 'method' => 'post', 'novalidate','enctype'=>'multipart/form-data','id'=>'']) !!}
                    
    {!! Field::hidden('_method', 'PUT') !!}
    {!! Field::hidden('FK', $anteproyecto->FK_TBL_Radicacion_id) !!}
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
            {!! Field::text('title',$anteproyecto->NPRY_Titulo,
                ['label' => 'Titulo del proyecto', 'max' => '250', 'min' => '2', 'required', 'auto' => 'off'],
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
            {!! Field::text('Keywords',$anteproyecto->NPRY_Keywords,
                ['label' => 'Palabras Clave', 'max' => '300', 'min' => '2', 'required', 'auto' => 'off'],
                ['help' => 'Palabras Clave (max 5)', 'icon' => 'fa fa-user']) !!}
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            {!! Field::text('duracion',$anteproyecto->NPRY_Duracion,
                ['label' => 'Duracion del Proyecto', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                ['help' => 'Duracion del Proyecto', 'icon' => 'fa fa-user']) !!}
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            {!! Field::date('FechaR',$anteproyecto->NPRY_FechaR,
                ['label' => 'Fecha de Radicacion','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                ['help' => '', 'icon' => 'fa fa-calendar']) !!}
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            {!! Field::date('FechaL',$anteproyecto->NPRY_FechaL,
                ['label' => 'Fecha Limite','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                ['help' => '', 'icon' => 'fa fa-calendar']) !!}
            
        </div>

        
        
        <div class="col-xs-12 col-md-8 col-lg-6">
            <div class="form-md-line-input" style="margin: 0 0 35px;">
                <div class="fileinput-new input-icon" data-provides="fileinput">    
                        <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Requerimientos</label>
                    <div class="input-group input-large">
                        <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                            <?=$anteproyecto->RDCN_Requerimientos?>
                            <span class="fileinput-filename"> </span>
                        </div>
                        <span class="input-group-addon btn default btn-file">
                        <span class="fileinput-new"> Select file </span>
                        <span class="fileinput-exists"> Change </span>
                        <input type="file" name="Requerimientos" class="" value=""> </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6">
            <div class="form-md-line-input" style="margin: 0 0 35px;">
                <div class="fileinput-new input-icon" data-provides="fileinput">    
                        <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Min</label>
                    <div class="input-group input-large">
                        <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                            <?=$anteproyecto->RDCN_Min?>
                            <span class="fileinput-filename"> </span>
                        </div>
                        
                        
                        <span class="input-group-addon btn default btn-file">
                        <span class="fileinput-new"> Select file </span>
                        <span class="fileinput-exists"> Change </span>
                        <input type="file" name="Min" class=""> </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div> 
        </div>

        
        
        <div class="col-xs-12 col-md-12 col-lg-12">
            {{ Form::submit('Actualizar', ['class' => 'btn green','style'=>'float:right']) }}
        </div>
        
        
        {!! Form::close() !!}
        @endforeach
    </div>
@endcomponent
@endsection



@push('plugins')
    <script src="{{asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

    <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

    <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
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
                        title: {
                            minlength: 2,
                            required: true
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