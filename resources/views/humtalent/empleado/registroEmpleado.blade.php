@extends('material.layouts.dashboard')

@section('page-title', 'Registro de empleado:')

@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase"> Formulario de registro del personal:  </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div>
                {!! Form::open (['method'=>'POST', 'route'=> ['talento.humano.rrhh.store'], 'role'=>'form']) !!}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div class="form-group form-md-radios">
                                <div class="md-radio-list">
                                    <div class="md-radio">
                                        {!! Field::radios('PRSN_Rol',['Docente'=>'Docente', 'Administrativo'=>'Administrativo'], ['list', 'label'=>'Rol del empleado: Selecciona una opción', 'icon'=>'fa fa-user']) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Nombres',null,['label'=>'Nombre(s)','class'=> 'form-control','id'=>'name' ,'required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-user']) !!}
                                    <span class="help-block"> Digita el nombre del empleado. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Apellidos',null,['label'=>'Apellido(s):', 'class'=> 'form-control','id'=>'apellido','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-user'] ) !!}
                                    <span class="help-block"> Digita el apellido del empleado. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PK_PRSN_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control','id'=>'cedula','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-credit-card'] ) !!}
                                    <span class="help-block"> Digita el numero de identificación.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: email('PRSN_Correo',null,['label'=>'Correo electrónico:', 'class'=> 'form-control','id'=>'email','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-envelope-open '] ) !!}
                                    <span class="help-block"> Digita un correo electronico valido.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control','id'=>'telefono','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-phone'] ) !!}
                                    <span class="help-block"> Digita un número de teléfono o celular. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Direccion',null,['label'=>'Dirección:', 'class'=> 'form-control','id'=>'direccion','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-building-o'] ) !!}
                                    <span class="help-block"> Digita la dirección de residencia. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Ciudad',null,['label'=>'Ciudad de residencia:', 'class'=> 'form-control','id'=>'ciudad','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-map-o'] ) !!}
                                    <span class="help-block"> Digita la ciudad del empleado. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Area',null,['label'=>'Area o facultad de trabajo:', 'class'=> 'form-control','id'=>'area','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-group'] ) !!}
                                    <span class="help-block"> Digita el area de trabajo. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Eps',null,['label'=>'EPS:', 'class'=> 'form-control','id'=>'eps','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-list-alt'] ) !!}
                                    <span class="help-block"> Digita la entidad prestadora de salud. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Fpensiones',null,['label'=>'Fondo de pensiones:', 'class'=> 'form-control','id'=>'fondoP','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-list-alt'] ) !!}
                                    <span class="help-block"> Digita el fondo de pensiones. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('PRSN_Caja_Compensacion',null,['label'=>'Caja de compensacion:', 'class'=> 'form-control','id'=>'cajaC','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['icon'=>'fa fa-list-alt'] ) !!}
                                    <span class="help-block"> Digita la caja de compensacion. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                        <div class="form-group form-md-radios">
                            <div class="md-radio-list">
                                <div class="md-radio">
                                    {!! Field::radios('PRSN_Estado_Persona',['Nuevo'=>'Nuevo', 'Antiguo'=>'Antiguo'],['list', 'label'=>'Estado del empleado: Selecciona una opción']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-offset-2">
                                {!! Form::submit('Registrar',['class' => 'btn blue']) !!}
                                {!! Form::reset('Cancelar', ['class' => 'btn btn-danger']) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>
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
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true

                    },
                    cedula: {
                        required: true
                    },
                    telefono: {
                        required: true

                    },
                    direccion: {
                        required: true

                    },
                    ciudad: {
                        required: true

                    },
                    area: {
                        required: true

                    },
                    eps: {
                        required: true
                    },
                    fondoP: {
                        required: true

                    },
                    cajaC: {
                        required: true

                    },

                },
                messages:{
                    name: {
                        required: "Debes digitar el nombre completo del empleado."
                    },
                    'radios': {
                        required: 'Por favor marca una opción',
                        minlength: jQuery.validator.format("Al menos {1} items deben ser seleccionados")
                    },
                    email: {
                        required: "Debes ingresar un correo electronico."

                    },
                    cedula: {
                        required: "Debes ingresar una cedula."
                    },
                    telefono: {
                        required: "Debes ingresar un telefono o celular."

                    },
                    direccion: {
                        required: "Debes ingresar una direccion."

                    },
                    ciudad: {
                        required: "Debes ingresar una ciudad."

                    },
                    area: {
                        required: "Debes ingresar un area de trabajo."

                    },
                    eps: {
                        required: "Debes ingresar una EPS"

                    },
                    fondoP: {
                        required: "Debes ingresar un fondo de pensiones."

                    },
                    cajaC: {
                        required: "Debes ingresar una caja de compensacion."

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