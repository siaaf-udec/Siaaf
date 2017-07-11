@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'Formulario para editar los datos del empleado registrado:')
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del personal'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                {!! Form::model ($empleado, ['id'=>'form_material','method'=>'PATCH', 'route'=> ['talento.humano.rrhh.update', $empleado->PK_PRSN_Cedula], 'role'=>'form'])  !!}
                    {{ csrf_field() }}
                    <div class="form-body">

                        {!! Field::radios('PRSN_Rol',['Docente'=>'Docente', 'Administrativo'=>'Administrativo'], ['list', 'label'=>'Rol del empleado: Selecciona una opción', 'icon'=>'fa fa-user']) !!}

                        {!! Field:: text('PRSN_Nombres',null,['label'=>'Nombre(s)','class'=> 'form-control','id'=>'name' ,'required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-user']) !!}

                        {!! Field:: text('PRSN_Apellidos',null,['label'=>'Apellido(s):', 'class'=> 'form-control','id'=>'apellido','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-user'] ) !!}

                        {!! Field:: text('PK_PRSN_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control','id'=>'cedula','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-credit-card'] ) !!}

                        {!! Field:: email('PRSN_Correo',null,['label'=>'Correo electrónico:', 'class'=> 'form-control','id'=>'email','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-envelope-open '] ) !!}

                        {!! Field:: text('PRSN_Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control','id'=>'telefono','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-phone'] ) !!}

                        {!! Field:: text('PRSN_Direccion',null,['label'=>'Dirección:', 'class'=> 'form-control','id'=>'direccion','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-building-o'] ) !!}

                        {!! Field:: text('PRSN_Ciudad',null,['label'=>'Ciudad de residencia:', 'class'=> 'form-control','id'=>'ciudad','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-map-o'] ) !!}

                        {!! Field:: text('PRSN_Area',null,['label'=>'Area o programa de trabajo:', 'class'=> 'form-control','id'=>'area','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-group'] ) !!}

                        {!! Field:: text('PRSN_Eps',null,['label'=>'EPS:', 'class'=> 'form-control','id'=>'eps','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-list-alt'] ) !!}

                        {!! Field:: text('PRSN_Fpensiones',null,['label'=>'Fondo de pensiones:', 'class'=> 'form-control','id'=>'fondoP','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-list-alt'] ) !!}

                        {!! Field:: text('PRSN_Caja_Compensacion',null,['label'=>'Caja de compensacion:', 'class'=> 'form-control','id'=>'cajaC','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-list-alt'] ) !!}

                        {!! Field::radios('PRSN_Estado_Persona',['Nuevo'=>'Nuevo', 'Antiguo'=>'Antiguo'],['list', 'label'=>'Estado del empleado: Selecciona una opción']) !!}

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endcomponent
    </div>
@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script type="text/javascript">
            @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.options.closeButton = true;
            toastr.info("{{Session::get('message')}}",'Modificación exitosa:');
            break;
    }
            @endif
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
                    toastr.error('Debes corregir algunos campos','Modificación fallida:')
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