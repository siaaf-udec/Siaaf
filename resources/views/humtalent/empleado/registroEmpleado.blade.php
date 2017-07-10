@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'Registro de empleado:')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro del personal'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['id'=>'form_empleado','method'=>'POST', 'route'=> ['talento.humano.rrhh.store']]) !!}

                    <div class="form-body">

                        {!! Field::radios('PRSN_Rol',['Docente'=>'Docente', 'Administrativo'=>'Administrativo'], ['list', 'label'=>'Rol del empleado: Selecciona una opción', 'icon'=>'fa fa-user']) !!}


                        {!! Field:: text('PRSN_Nombres',null,['label'=>'Nombre(s)','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el nombre del empleado.','icon'=>'fa fa-user']) !!}

                        {!! Field:: text('PRSN_Apellidos',null,['label'=>'Apellido(s):', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el apellido del empleado.','icon'=>'fa fa-user'] ) !!}

                        {!! Field:: text('PK_PRSN_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita la cedula del empleado.','icon'=>'fa fa-credit-card'] ) !!}

                        {!! Field:: email('PRSN_Correo',null,['label'=>'Correo electrónico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita un correo válido.','icon'=>'fa fa-envelope-open '] ) !!}

                        {!! Field:: text('PRSN_Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita un numero de telefono o celular.','icon'=>'fa fa-phone'] ) !!}

                        {!! Field:: text('PRSN_Direccion',null,['label'=>'Dirección:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita la direccion de residencia.','icon'=>'fa fa-building-o'] ) !!}

                        {!! Field:: text('PRSN_Ciudad',null,['label'=>'Ciudad de residencia:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita la ciudad del empleado.','icon'=>'fa fa-map-o'] ) !!}

                        {!! Field:: text('PRSN_Area',null,['label'=>'Area o programa de trabajo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el area o facultad del empleado.','icon'=>'fa fa-group'] ) !!}

                        {!! Field:: text('PRSN_Eps',null,['label'=>'EPS:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                        ['help' => 'EPS (Es opcional).','icon'=>'fa fa-list-alt'] ) !!}

                        {!! Field:: text('PRSN_Fpensiones',null,['label'=>'Fondo de pensiones:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                        ['help' => 'Fondo de pensiones (Es opcional).','icon'=>'fa fa-list-alt'] ) !!}

                        {!! Field:: text('PRSN_Caja_Compensacion',null,['label'=>'Caja de compensación:', 'class'=> 'form-control','autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Caja de compensacion (Es opcional).','icon'=>'fa fa-list-alt'] ) !!}

                        {!! Field::radios('PRSN_Estado_Persona',['Nuevo'=>'Nuevo', 'Antiguo'=>'Antiguo'],['list', 'label'=>'Estado del empleado: Selecciona una opción']) !!}

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
                    PRSN_Nombres: {
                        required: true
                    },
                    PRSN_Apellidos: {
                        required: true
                    },
                    PRSN_Correo: {
                        required: true,
                        email: true

                    },
                    PK_PRSN_Cedula: {
                        required: true
                    },
                    PRSN_Telefono: {
                        required: true

                    },
                    PRSN_Direccion: {
                        required: true

                    },
                    PRSN_Ciudad: {
                        required: true

                    },
                    PRSN_Area: {
                        required: true

                    },

                    PRSN_Rol: {
                        required: true,
                        minlength: 1,
                    },
                    PRSN_Estado_Persona: {
                        required: true,
                        minlength: 1,
                    }

                },
                messages:{
                    PRSN_Nombres: {
                        required: "Debes digitar el nombre completo del empleado."
                    },
                    PRSN_Apellidos: {
                        required: "Debes digitar los apellidos del empleado."
                    },
                    PRSN_Rol: {
                        required: 'Por favor marca una opción',
                        minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                    },
                    PRSN_Estado_Persona: {
                        required: 'Por favor marca una opción',
                        minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                    },
                    PRSN_Correo: {
                        required: "Debes ingresar un correo electronico."

                    },
                    PK_PRSN_Cedula: {
                        required: "Debes ingresar una cedula."
                    },
                    PRSN_Telefono: {
                        required: "Debes ingresar un telefono o celular."

                    },
                    PRSN_Direccion: {
                        required: "Debes ingresar una direccion."

                    },
                    PRSN_Ciudad: {
                        required: "Debes ingresar una ciudad."

                    },
                    PRSN_Area: {
                        required: "Debes ingresar un area de trabajo."

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