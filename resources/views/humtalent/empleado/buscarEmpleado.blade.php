@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('page-title', 'Buscar Empleado')
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de busqueda del personal'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form-docrad','method'=>'POST', 'route'=> ['talento.humano.listarDocsRad'], 'role'=>"form"]) !!}
                    {!! Field:: text('PK_PRSN_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control','id'=>'cedula','required', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                     ['help'=>'Digita el número de cedula.','icon'=>'fa fa-credit-card'] ) !!}

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
<script>
    @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'success':
            toastr.options.closeButton = true;
            toastr.success("{{Session::get('message')}}",'Radicación exitosa:');
            break;
    }
    @endif
            var FormValidationMd = function() {
                    var handleValidation = function() {

                        var form1 = $('#form-docrad');
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
                                }

                            },
                            messages:{
                                PK_PRSN_Cedula: {
                                    required: "Debes digitar la cédula del empleado."
                                }
                            },

                            invalidHandler: function(event, validator) {
                                success1.hide();
                                error1.show();
                                toastr.options.closeButton = true;
                                toastr.options.showDuration= 1000;
                                toastr.options.hideDuration= 1000;
                                toastr.error('Debes corregir algunos campos','Error en la busqueda:')
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