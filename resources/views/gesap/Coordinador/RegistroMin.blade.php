@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush



@section('title', '| Anteproyectos')


@section('page-title', 'Registro')


@section('page-description', 'Añadir nuevo anteproyecto')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-plus', 'title' => 'Registrar Anteproyecto'])

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
    
        {!! Form::open(['route' => 'min.store', 'method' => 'POST', 'novalidate','enctype'=>'multipart/form-data','id'=>'form-register-min']) !!}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
                    <div class="form-group form-md-line-input">
                        <div class="input-icon">
                            {{ Form::textarea('title', null, ['required', 'auto' => 'off','size' => '30x1','class'=>'form-control'],[ 'icon' => 'fa fa-user']) }}
                            <label for="title" class="control-label">Titulo del proyecto</label>
                            <span class="help-block"> Ingrese el titulo del proyecto </span>
                            <i class=" fa fa-user "></i>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 col-lg-6">
                    {!! Field::select('estudiante1',$estudiantes,null,[ 'label' => 'Estudiante 1', 'required', 'auto' => 'off']) !!}
                </div>
                <div class="col-xs-12 col-md-8 col-lg-6">
                    {!! Field::select('estudiante2',array_replace(["0"=>"No aplica"],$estudiantes),null,[ 'label' => 'Estudiante 2','required', 'auto' => 'off']) !!}
                </div>
                <div class="col-xs-12 col-md-12 col-lg-12">
                    {!! Field::text('Keywords',['label' => 'Palabras Clave', 'max' => '300', 'min' => '2', 'required', 'auto' => 'off'],['help' => 'Palabras Clave (max 5)', 'icon' => 'fa fa-user']) !!}
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4">
                    {!! Field::text('duracion',['label' => 'Duracion del Proyecto', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],['help' => 'Duracion del Proyecto', 'icon' => 'fa fa-user']) !!}
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4">
                    {!! Field::date('FechaR',['label' => 'Fecha de Radicacion','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => '', 'icon' => 'fa fa-calendar']) !!}
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4">
                    {!! Field::date('FechaL',['label' => 'Fecha Limite','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => '', 'icon' => 'fa fa-calendar']) !!}
                </div>
                <div class="col-xs-12 col-md-8 col-lg-6" id="file">
                    <div class="form-md-line-input" style="margin: 0 0 35px;">
                        <div class="fileinput-new input-icon" data-provides="fileinput">    
                            <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Requerimientos</label>
                            <div class="input-group input-large">
                                <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                    <span class="fileinput-new"> Select file </span>
                                    <span class="fileinput-exists"> Change </span>
                                    <input type="file" name="Requerimientos" class="" required> 
                                </span>
                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-xs-12 col-md-8 col-lg-6" id="file">
                    <div class="form-md-line-input" style="margin: 0 0 35px;">
                        <div class="fileinput-new input-icon" data-provides="fileinput">    
                            <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Min</label>
                            <div class="input-group input-large">
                                <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                <span class="fileinput-new"> Select file </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="file" name="Min" class="" required> </span>
                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-xs-12 col-md-12 col-lg-12">
                    {{ Form::reset('Reset', ['class' => 'btn yellow-gold','style'=>'float:right;margin-left:1rem']) }}
                    {{ Form::submit('Guardar', ['class' => 'btn green','style'=>'float:right']) }}
                </div>
            </div>
        {!! Form::close() !!}
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


    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>

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
        var form1 = $('#form-register-min');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        $.validator.addMethod("xxxValidation", function(value, element) {
            return value !== '0000-00-00'
        }, "Falta la fecha");
        
        
        form1.validate({
            errorElement: 'span',                       //default input error message container
            errorClass: 'help-block help-block-error',  // default input error message class
            focusInvalid: true,                         // do not focus the last invalid input
            ignore: "",                                 // validate all fields including form hidden input
            rules:{
                FechaR:{
                    required: true
                }  
                ,title:{
                    required: true
                }
                ,estudiante1:{
                    required: true
                }
                ,estudiante2:{
                    required: true
                }
                ,Keywords:{
                    required: true
                }
                ,duracion:{
                    required: true
                }
                ,FechaR:{
                    required: true
                }
                ,FechaL:{
                    required: true
                }
            },
            invalidHandler: function(event, validator) {//display error alert on form submit
                success1.hide();
                error1.show();
                toastr.options.closeButton = true;
                toastr.options.showDuration= 1000;
                toastr.options.hideDuration= 1000;
                toastr.error('Campos Incorrectos','Error en el Registro:')
                App.scrollTo(error1, -500);
            },
            
            
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {     
                    error.insertAfter(element.next('span'));  // select2
                }else if (element.is(':file')) {     
                    error.insertAfter(element.closest('.fileinput-new '));  // select2
                }else{
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            highlight: function(element) { // hightlight error inputs
                var elem=$(element)
                if(elem.is(':file')){
                    elem.closest('.form-md-line-input').addClass('has-error');
                }else
                    elem.closest('.form-group').addClass('has-error');                           
            },

            unhighlight: function(element) { // revert the change done by hightlight
                if(element.is(':file')){
                    element.closest('.form-md-line-input').removeClass('has-error');
                }else
                    element.closest('.form-group').removeClass('has-error');
                },

            success: function(label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function(form1) {
                success1.show();
                error1.hide();
                toastr.options.closeButton = true;
                toastr.options.showDuration= 1000;
                toastr.options.hideDuration= 1000;
                toastr.success('Información guardada correctamente','Registro exitoso:')
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
            $('.select2-selection--single').addClass('form-control');
            FormValidationMd.init();
            ComponentsSelect2.init();
            ComponentsDateTimePickers.init();
        });

</script>

@endpush