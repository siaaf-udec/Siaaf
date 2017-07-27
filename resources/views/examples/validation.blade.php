@extends('material.layouts.dashboard')

@push('styles')
<!-- Editor -->
<link href="{{ asset('assets/global/plugins/codemirror/lib/codemirror.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/codemirror/theme/material.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('title', '| Validaciones')

@section('page-title', 'Validaciones')

@section('page-description', 'Ejemplo de Formularios con validación')

@section('content')
<div class="col-md-12">
    {{-- BEGIN COMPONENTS SAMPLE --}}
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formularios'])
            @slot('actions', [

                'link_upload' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-trash',
                ],

            ])
            {!! Form::open(['id' => 'form_material', 'class' => '', 'url' => '/forms']) !!}
    <div class="form-body">
        {!! Field::text(
                            'name',
                            ['label' => 'Texto para el Label', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                            ['help' => 'Texto de ayuda', 'icon' => 'fa fa-user']) !!}

                {!! Field::email(
                            'email',
                            ['required', 'auto' => 'off', 'max' => '50'],
                            ['help' => 'Digita un email', 'icon' => 'fa fa-envelope-open']) !!}

                {!! Field::password(
                            'password',
                            ['required', 'max' => '20'],
                            ['help' => 'Digita una contraseña.', 'icon' => 'fa fa-key']) !!}

                {!! Field::password(
                    'password_confirmation',
                    ['required', 'max' => '20'],
                    ['help' => 'Digita una contraseña.', 'icon' => 'fa fa-key']) !!}

                {!! Field::checkboxes('tags',
                            ['php' => 'PHP', 'python' => 'Python', 'js' => 'JS', 'ruby' => 'Ruby on Rails'],
                            ['php', 'js'], ['position' => 'inline', 'label' => 'Selecciona un Lenguaje de Proramación']) !!}

                {!! Field::url(
                            'url',
                            ['required', 'auto' => 'off', 'max' => '255'],
                            ['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-link']) !!}
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                {{ Form::submit('Validar', ['class' => 'btn green']) }}
                        {{ Form::button('Cancelar', ['class' => 'btn red']) }}
                        {{ Form::reset('Reset', ['class' => 'btn yellow-gold']) }}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <hr>
        <div class="m-heading-1 border-green m-bordered">
            <h3>
                Validaciones
            </h3>
            <p>
                Validaciones
                <a href="http://jqueryvalidation.org/" target="_blank">
                    Documentación Oficial
                </a>
                .
            </p>
        </div>
        <p>
            Requisitos
        </p>
        <pre><span><</span>script src="{<span>{</span> asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></pre>
    </hr>
</div>
<pre><span><</span>script src="{<span>{</span> asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></pre>
<pre><span><</span>script src="{<span>{</span> asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></pre>
<textarea id="validation-editor">
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
                    messages: {
                        'tags[]': {
                            required: 'Por favor marca una opción',
                            minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                        },
                        'radios': {
                            required: 'Por favor marca una opción',
                            minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                        }
                    },
                    rules: {
                        name: {
                            minlength: 2,
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            passwordStr: true,
                            required: true,
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        },
                        url: {
                            required: true,
                            url: true
                        },
                        'tags[]': {
                            required: true,
                            minlength: 3,
                        },
                        radios: {
                            required: true,
                            minlength: 1,
                        },
                    },

                    invalidHandler: function(event, validator) { //display error alert on form submit
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
                            error.insertAfter(element); // for other inputs, just perform default behavior
                        }
                    },

                    highlight: function(element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function(element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function(label) {
                        label
                            .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },

                    submitHandler: function(form) {
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
    jQuery(document).ready(function() {
        FormValidationMd.init();
    });
</textarea>
<hr>
    <div class="m-heading-1 border-green m-bordered">
        <h3>
            Max Length
        </h3>
        <p>
            Max Length
            <a href="http://mimo84.github.io/bootstrap-maxlength/" target="_blank">
                Documentación Oficial
            </a>
            .
        </p>
    </div>
    <p>
        Requisitos
    </p>
    <pre><span><</span>script src="{<span>{</span> asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></pre>
</hr>
<textarea id="max-editor">
    var ComponentsBootstrapMaxlength = function () {

        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                limitReachedClass: "label label-danger",
                alwaysShow: true
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };

    }();
    jQuery(document).ready(function() {
        ComponentsBootstrapMaxlength.init();
    });
</textarea>
@endcomponent
        {{-- END COMPONENTS SAMPLE --}}
@endsection

@push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- Editor -->
<script src="{{ asset('assets/global/plugins/codemirror/lib/codemirror.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/codemirror/addon/edit/closebrackets.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/codemirror/mode/javascript/javascript.js') }}" type="text/javascript">
</script>
@endpush

@push('functions')
<script type="text/javascript">
    var FormValidationMd = function() {

            $.validator.addMethod(
                'passwordStr',
                function (value, element) {
                    return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{6,}/.test(value);
                },
                "Tu contraseña debe tener al menos 6 caracteres, al menos una letra mayúscula, una letra minúscula, números y caracteres especiales."
            );

            $.validator.addMethod(
                'phone',
                function (value, element) {
                    return this.optional(element) || /^(1?(-?\d{3})-?)?(\d{3})(-?\d{4})$/.test(value);
                },
                "Digita un número de teléfono válido."
            );

            var handleValidation = function() {

                var form1 = $('#form_material');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: true, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    messages: {
                        'tags[]': {
                            required: 'Por favor marca una opción',
                            minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                        },
                        'radios': {
                            required: 'Por favor marca una opción',
                            minlength: jQuery.validator.format("Al menos {0} items deben ser seleccionados"),
                        }
                    },
                    rules: {
                        name: {
                            minlength: 2,
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            passwordStr: true,
                            required: true,
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        },
                        url: {
                            required: true,
                            url: true
                        },
                        'tags[]': {
                            required: true,
                            minlength: 3,
                        },
                        radios: {
                            required: true,
                            minlength: 1,
                        },
                    },

                    invalidHandler: function(event, validator) { //display error alert on form submit
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
                            error.insertAfter(element); // for other inputs, just perform default behavior
                        }
                    },

                    highlight: function(element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function(element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function(label) {
                        label
                            .closest('.form-group').removeClass('has-error');
                    },

                    submitHandler: function(form) {
                        success1.show();
                        error1.hide();
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

        var ComponentsBootstrapMaxlength = function () {

            var handleBootstrapMaxlength = function() {
                $("input[maxlength], textarea[maxlength]").maxlength({
                    limitReachedClass: "label label-danger",
                    alwaysShow: true
                });
            }

            return {
                //main function to initiate the module
                init: function () {
                    handleBootstrapMaxlength();
                }
            };

        }();

        var ComponentsCodeEditors = function () {

            var handleVal = function () {
                    var myTextArea = document.getElementById('validation-editor');
                    var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                        lineNumbers: true,
                        matchBrackets: true,
                        styleActiveLine: true,
                        theme:"material",
                        mode: "javascript",
                        readOnly: true
                    });
                };
            var handleMax = function () {
                    var myTextArea = document.getElementById('max-editor');
                    var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                        lineNumbers: true,
                        matchBrackets: true,
                        styleActiveLine: true,
                        theme:"material",
                        mode: "javascript",
                        readOnly: true
                    });
                };

            return {
                init: function () {
                    handleVal();
                    handleMax();

                }
            };

        }();

        jQuery(document).ready(function() {
            FormValidationMd.init();
            ComponentsBootstrapMaxlength.init();
            ComponentsCodeEditors.init();
        });
</script>
@endpush
