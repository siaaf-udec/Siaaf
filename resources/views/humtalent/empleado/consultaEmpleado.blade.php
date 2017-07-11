@extends('material.layouts.dashboard')
@section('page-title', 'Buscar Empleado')
@section('content')
    <div class="col-md-12">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de busqueda:'])

                <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                        {!! Form::open (['id'=>'form-consultaEmpleado','method'=>'POST', 'route'=> ['talento.humano.buscarCedula'], 'role'=>"form"]) !!}
                        <div class="form-body">
                                {!! Field:: text('PK_PRSN_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control','id'=>'cedula','required', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                     ['help' => 'Digita el numero de cedula.','icon'=>'fa fa-credit-card'] ) !!}

                        <div class="form-actions">
                            <div class="row">
                                <div class=" col-md-offset-4">
                                    {!! Form::submit('Buscar',['class'=>'btn blue','btn-icon remove']) !!}
                                    {!! Form::reset('Cancelar', ['class' => 'btn btn-danger']) !!}
                                </div>
                            </div>
                        </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endcomponent
        </div>
    </div>
@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>
var FormValidationMd = function() {
var handleValidation = function() {

var form1 = $('#form-consultaEmpleado');
var error1 = $('.alert-danger', form1);
var success1 = $('.alert-success', form1);

form1.validate({
                    errorElement: 'span',
                    errorClass: 'help-block help-block-error',
                    focusInvalid: true,
                    ignore: "",
                    rules: {

                        PK_PRSN_Cedula: {
                            required: true

                        },
                    },
                    messages:{

                    PK_PRSN_Cedula: {
                    required: "Debes ingresar una cedula."
                    },



                    },

                    invalidHandler: function(event, validator) {
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
                    });

</script>
@endpush
