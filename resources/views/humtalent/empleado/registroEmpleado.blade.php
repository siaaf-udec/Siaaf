@extends('material.layouts.dashboard')

@section('page-title')
    <b class="page-title">Registro de empleado:<small> Personal docente y administrativo</small></b>
@endsection

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
                <form  role="form" method="POST" id="form_material" action="{{ route('rrhh.store') }} ">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="40" autocomplete="off" class="form-control" id="name" name="name" type="text">
                                    <label for="name" class="control-label">Nombre completo:</label>
                                    <span class="help-block"> Digita el nombre completo del empleado. </span>
                                    <i class=" fa fa-user "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="30" autocomplete="off" class="form-control" id="cedula" name="cedula" type="text">
                                    <label for="cedula" class="control-label">Cedula de ciudadania:</label>
                                    <span class="help-block"> Digita el numero de identificación.</span>
                                    <i class=" fa fa-credit-card "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="50" autocomplete="off" class="form-control" id="email" name="email" type="email">
                                    <label for="email" class="control-label">Correo electronico:</label>
                                    <span class="help-block"> Digita un correo electronico valido.</span>
                                    <i class=" fa fa-envelope-open "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            <input required maxlength="20" autocomplete="off" class="form-control" id="telefono" name="telefono" type="text">
                                            <label for="telefono" class="control-label">Teléfono</label>
                                            <span class="help-block"> Digita un número de teléfono o celular. </span>
                                            <i class=" fa fa-phone "></i>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="70" autocomplete="off" class="form-control" id="direccion" name="direccion" type="text">
                                    <label for="direccion" class="control-label">Dirección:</label>
                                    <span class="help-block"> Digita la dirección de residencia. </span>
                                    <i class=" fa fa-building-o "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="20" autocomplete="off" class="form-control" id="ciudad" name="ciudad" type="text">
                                    <label for="ciudad" class="control-label">Ciudad:</label>
                                    <span class="help-block"> Digita la ciudad del empleado. </span>
                                    <i class=" fa fa-map-o "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="25" autocomplete="off" class="form-control" id="area" name="area" type="text">
                                    <label for="area" class="control-label">Area de trabajo:</label>
                                    <span class="help-block"> Digita el area de trabajo. </span>
                                    <i class=" fa fa-group"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input  maxlength="40" autocomplete="off" class="form-control" id="eps" name="eps" type="text">
                                    <label for="eps" class="control-label">EPS:</label>
                                    <span class="help-block"> Digita la entidad prestadora de salud. </span>
                                    <i class=" fa fa-list-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input  maxlength="40" autocomplete="off" class="form-control" id="fondoP" name="fondoP" type="text">
                                    <label for="fondoP" class="control-label">Fondo de pensiones:</label>
                                    <span class="help-block"> Digita el fondo de pensiones. </span>
                                    <i class=" fa fa-list-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input  maxlength="40" autocomplete="off" class="form-control" id="cajaC" name="cajaC" type="text">
                                    <label for="cajaC" class="control-label">Caja de compensacion:</label>
                                    <span class="help-block"> Digita la caja de compensacion. </span>
                                    <i class=" fa fa-list-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div class="form-group form-md-radios">
                                <label for="form_control">Estado del empleado:</label>

                                <div class="md-radio-list">
                                    <div class="md-radio">
                                        <input id="radios_n" name="radios" type="radio" value="n">
                                        <label for="radios_n">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Nuevo </label>
                                    </div>
                                    <div class="md-radio">
                                        <input id="radios_a" checked="checked" name="radios" type="radio" value="a">
                                        <label for="radios_a">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Antiguo </label>
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

                </form>
            </div>
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