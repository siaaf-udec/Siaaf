@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Dashboard')

@section('page-title', 'Observaciones')

@section('page-description', 'Realizar observaciones')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Observaciones'])
        <div class="row">
            <div class="col-md-12" style="z-index: 1;">
                <div class="btn-group">
                    <a href="{{ route('anteproyecto.index.juryList') }}">
                        <button id="sample_editable_1_new" class="btn green" > 
                            <i class="fa fa-list"></i>Listar
                        </button>
                    </a> 
                </div>
            </div>
            @foreach ($anteproyectos as $anteproyecto)
                {!! Form::open(['route' => 'anteproyecto.guardar.observaciones', 'method' => 'post', 'novalidate','enctype'=>'multipart/form-data','id'=>'form-register-obser']) !!}
                    {!! Field::hidden('PK_anteproyecto', $anteproyecto->PK_NPRY_idMinr008) !!}
                    {!! Field::hidden('user', Auth::user()->id) !!}
                    <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
                        <div class="form-group">
                            <label class="control-label col-md-2" style="font-size: 14px;color: #888;padding:0px">Anteproyecto:</label>
                            <div class="col-md-10">
                                <p class="" data-display="username"> {{$anteproyecto->NPRY_Titulo}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
                        <div class="form-group form-md-line-input">
                            <div class="input-icon">
                                {{ Form::textarea('observacion', null, 
                                    ['required', 'auto' => 'off','size' => '40x5','class'=>'form-control'],
                                    [ 'icon' => 'fa fa-user']) 
                                }}
                                <label for="title" class="control-label">Observaciones</label>
                                <span class="help-block"> Ingrese el titulo del proyecto </span>
                                <i class=" fa fa-user "></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
                        <h3 class="center">Documentos Calificados(Opcional)</h3>
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
                                <input type="file" name="Min" class="" required> </span>
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
                        <input type="file" name="requerimientos" class="" required> </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div> 
        </div>
        
        
        
        <div class="col-xs-12 col-md-12 col-lg-12">
            {{ Form::reset('Reset', ['class' => 'btn yellow-gold','style'=>'float:right;margin-left:1rem']) }}
            {{ Form::submit('Guardar', ['class' => 'btn green','style'=>'float:right']) }}
        </div>
        
        
        {!! Form::close() !!}
    @endforeach
</div>
    @endcomponent
@endsection



@push('plugins')
    <script src="{{asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>

@endpush

@push('functions')
<script type="text/javascript">
var FormValidationMd = function() {
    var handleValidation = function() {
        var form1 = $('#form-register-obser');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span',                       //default input error message container
            errorClass: 'help-block help-block-error',  // default input error message class
            focusInvalid: true,                         // do not focus the last invalid input
            ignore: "",                                 // validate all fields including form hidden input
            invalidHandler: function(event, validator) {//display error alert on form submit
                success1.hide();
                error1.show();
                toastr.options.closeButton = true;
                toastr.options.showDuration= 1500;
                toastr.options.hideDuration= 1500;
                toastr.error('Campos Incorrectos','Error en el Registro:')
                App.scrollTo(error1, -500);
            },
            
            rules:{
                FechaR:{
                    xxxValidation: true
                }
                
                
                
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
                toastr.options.showDuration= 1500;
                toastr.options.hideDuration= 1500;
                toastr.success('Información guardada correctamente','Registro Completo:')
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
        });

</script>

@endpush