@extends('material.layouts.dashboard')

@section('page-title')
    <b class="page-title">Registro de funcionario:</b>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase"> Formulario de registro:  </span>
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
                                    <span class="help-block"> Digita el nombre completo del funcionario. </span>
                                    <i class=" fa fa-user "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="50" autocomplete="off" class="form-control" id="email" name="email" type="email">
                                    <label for="email" class="control-label">Correo institucional:</label>
                                    <span class="help-block"> Digita un correo institucional.</span>
                                    <i class=" fa fa-envelope-open "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="20" minlength="6" class="form-control" id="password" name="password" type="password" value="">
                                    <label for="password" class="control-label">Contraseña:</label>
                                    <span class="help-block"> Digita una contraseña.</span>
                                    <i class=" fa fa-key "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input required maxlength="20" class="form-control" id="password_confirmation" name="password_confirmation" type="password" value="">
                                    <label for="password_confirmation" class="control-label">Confirmación de la contraseña:</label>
                                    <span class="help-block"> Digita la contraseña anterior.</span>
                                    <i class=" fa fa-key "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-offset-2">
                                {!! Form::submit('Registrar',['class' => 'btn default']) !!}
                                {!! Form::reset('Cancelar', ['class' => 'btn default']) !!}
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
        $.validator.addMethod(
            'passwordStr',
            function (value, element) {
                return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{6,}/.test(value);
            },
            "Tu contraseña debe tener al menos 6 caracteres, al menos una letra mayúscula, una letra minúscula, números y caracteres especiales."
        );
        $.validator.addMethod(
            'correo_institucional',
            function (value, element) {
                return this.optional(element) || /^.+@ucundinamarca.edu.co/.test(value);
            },
            "Solo se admiten correos electronicos con la terminacion ucundinamarca.edu.co "
        );

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
                        email: true,
                        correo_institucional:true
                    },
                    password: {
                        passwordStr: true,
                        required: true,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },

                },
                messages:{
                    name: {
                        required: "Debes digitar el nombre completo del funcionario."
                    },
                    email: {
                        required: "Debes ingresar un correo electronico.",

                    },
                    password: {
                        required: "Debes ingresar una contraseña.",

                    },
                    password_confirmation: {
                        required: "Debes confirmar la contraseña",
                        equalTo:"Las contraseñas no coinciden."

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