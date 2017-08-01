@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'Registro de usuarios del Parqueadero:')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para el registro de usuarios del parqueadero'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['id'=>'form_userCK','method'=>'POST', 'route'=> ['usuariosCK.store']]) !!}

                    <div class="form-body">
                        {!! Field:: text('PK_CK_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                       ['help' => 'Ingrese la cedula del nuevo usuario.','icon'=>'fa fa-credit-card'] ) !!}

                        {!! Field:: text('CK_Nombres',null,['label'=>'Nombre:','class'=> 'form-control', 'autofocus', 'maxlength'=>'60','autocomplete'=>'off'],
                                                         ['help' => 'Ingrese el nombre del nuevo usuario.','icon'=>'fa fa-user']) !!}

                        {!! Field:: text('CK_Apellidos',null,['label'=>'Apellidos:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'60','autocomplete'=>'off'],
                                                         ['help' => 'Ingrese los apellidos del nuevo usuario.','icon'=>'fa fa-user'] ) !!}

                        {!! Field:: text('CK_Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'25','autocomplete'=>'off'],
                                                        ['help' => 'Ingrese un número telefónico o celular del nuevo usuario.','icon'=>'fa fa-phone'] ) !!}

                        {!! Field:: email('CK_Correo',null,['label'=>'Correo electrónico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Ingrese un correo válido del nuevo usuario.','icon'=>'fa fa-envelope-open '] ) !!}

                        {!! Field:: text('CK_Direccion',null,['label'=>'Dirección:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'70','autocomplete'=>'off'],
                                                         ['help' => 'Ingrese la dirección del nuevo usuario.','icon'=>'fa fa-building-o'] ) !!}

                        {!! Field:: text('CK_Ciudad',null,['label'=>'Ciudad:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],
                                                         ['help' => 'Ingrese la ciudad de vivienda del nuevo usuario.','icon'=>'fa fa-map-o'] ) !!}

                        {!! Field:: text('CK_Codigo',null,['label'=>'Código Interno:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                        ['help' => 'Ingrese el código del nuevo usuario.','icon'=>'fa fa-credit-card'] ) !!}

                        {!! Field:: select('CK_IdPrograma', array('1'=>'Administrativo',
                                                                  '2'=>'Funcionario',
                                                                  '3'=>'Ingeniería de Sistemas'),['label'=>'Programa:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                        ['help' => 'Ingrese el código del nuevo usuario.','icon'=>'fa fa-credit-card'] ) !!}


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
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
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
    var FormValidationMd = function() {
        var handleValidation = function() {

            var form1 = $('#form_empleado');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: true,
                ignore: "",
                rules: {
                    CK_Nombres: {
                        required: true
                    },
                    CK_Apellidos: {
                        required: true
                    },
                    CK_Correo: {
                        required: true,
                        email: true

                    },
                    PK_CK_Cedula: {
                        required: true
                    },
                    CK_Telefono: {
                        required: true

                    },
                    CK_Direccion: {
                        required: true

                    },
                    CK_Ciudad: {
                        required: true

                    },
                    CK_Codigo: {
                        required: true

                    },
                    CK_IdPrograma: {
                        required: true

                    }

                },
                messages:{
                    CK_Nombres: {
                        required: "Debe digitar el nombre completo del nuevo usuario."
                    },
                    CK_Apellidos: {
                        required: "Debe digitar los apellidos del nuevo usuario."
                    },
                    CK_Correo: {
                        required: "Debe ingresar un correo electrónico."
                    },
                    PK_CK_Cedula: {
                        required: "Debe ingresar un número de cedula valida."
                    },
                    CK_Telefono: {
                        required: "Debe ingresar un número telefónico o celular."

                    },
                    CK_Direccion: {
                        required: "Debe ingresar una dirección valida."

                    },
                    CK_Ciudad: {
                        required: "Debe ingresar una ciudad."

                    },
                    CK_Codigo: {
                        required: "Debe ingresar un código valido."

                    },


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


            jQuery(document).ready(function() {
                ComponentsSelect2.init();
        FormValidationMd.init();
        ComponentsBootstrapMaxlength.init();
    });

</script>
@endpush
