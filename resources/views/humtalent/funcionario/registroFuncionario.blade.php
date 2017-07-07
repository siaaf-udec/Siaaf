@extends('material.layouts.dashboard')

@section('page-title','Registro de funcionario:')


@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro del personal'])

            @include('humtalent.flash-message')
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['id'=>'form_funcionario','method'=>'POST', 'route'=> ['talento.humano.rrhh.store']]) !!}
                    {!! Field:: text('name',null,['label'=>'Nombre completo','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el nombre completo del funcionario.','icon'=>'fa fa-user']) !!}
                    {!! Field:: email('email',null,['label'=>'Correo institucional:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                                         ['help' => 'Digita un correo institucional.','icon'=>'fa fa-envelope-open '] ) !!}


                    {!! Field:: password('password',['label'=>'Contraseña:', 'class'=> 'form-control','minlength'=>'6', 'autofocus', 'maxlength'=>'20','autocomplete'=>'off'],
                                                         ['help' => 'Digita una contraseña.','icon'=>'fa fa-key '] ) !!}

                    {!! Field:: password('password_confirmation',['label'=>'Confirmación de la contraseña:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'20','autocomplete'=>'off'],
                                                        ['help' => 'Digita la contraseña anterior.','icon'=>'fa fa-key '] ) !!}

                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-offset-0">
                                {!! Form::submit('Registrar',['class' => 'btn blue']) !!}
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

            var form1 = $('#form_funcionario');
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