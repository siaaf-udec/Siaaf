@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('page-title', 'Documento Registrado:')
@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase"> Datos del Empleado  </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div>
                        {!! Form::model ($documento, ['id'=>'form-documento','method'=>'PUT', 'route'=> ['talento.humano.document.update', $documento->PK_DCMTP_Id_Documento], 'role'=>"form"]) !!}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-7 col-md-offset-2">
                                <div  class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        {!! Field:: text('DCMTP_Nombre_Documento',null,['label'=>'Nombre Del Documento:','class'=> 'form-control','id'=>'name','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                            ['icon'=>' fa fa-credit-card']) !!}
                                        <span class="help-block"> Digita el nombre del Documento. </span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>
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

                var form1 = $('#form_documento');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span',
                    errorClass: 'help-block help-block-error',
                    focusInvalid: true,
                    ignore: "",
                    rules: {
                        DCMTP_Nombre_Documento: {

                            required: true
                        }


                    },
                    messages:{
                        DCMTP_Nombre_Documento: {
                            required: "Debes digitar el nombre del documento."
                        }

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