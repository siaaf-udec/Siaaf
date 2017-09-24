@extends('material.layouts.dashboard')

@section('page-title', 'Registro de solicitud:')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de software'])

            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['method'=>'POST', 'route'=> ['espacios.academicos.soft.store'], 'id'=>'form_material']) !!}
                    <div class="form-body">

                        {!! Field:: text('nombre_soft',null,
                        ['label'=>'Nombre Software:','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                        ['help' => 'Digita el nombre','icon'=>'fa fa-desktop'] ) !!}


                        {!! Field:: text('version',null,
                        ['label'=>'Version','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                        ['help' => 'Digita la version.','icon'=>'fa fa-desktop']) !!}

                        {!! Field:: text('licencias',null,
                        ['label'=>'Cantidad de licencias','class'=> 'form-control', 'autofocus', 'maxlength'=>'2','autocomplete'=>'off'],
                        ['help' => 'Digita cantidad de licencias disponibles.','icon'=>'fa fa-user']) !!}

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
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<!--//validaciones-->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script type="text/javascript">
    @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'success':
            toastr.options.closeButton = true;
            toastr.success("{{Session::get('message')}}",'Registro exitoso');
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
                    nombre_soft: {
                        minlength: 2,
                        required: true
                    },
                    version: {
                        number: true,
                        required: true
                    },
                    licencias: {
                        number: true,
                        required: true
                    }
                },
                messages:{
                    nombre_soft: {
                        required: "Debe digitar el nombre del software."
                    },
                    version: {
                        required: "Campo numerico."
                    },
                    licencias: {
                        required: "Campo numerico."
                    }

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
    jQuery(document).ready(function() {
        FormValidationMd.init();
        ComponentsBootstrapMaxlength.init();
    });
</script>
@endpush