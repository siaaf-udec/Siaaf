@extends('material.layouts.dashboard')

@section('page-title', 'Registro de usuarios:')
@push('styles')
<link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
<link href="{{-- asset('assets/global/plugins/datatables/datatables.min.css') --}}" rel="stylesheet" type="text/css" />
<link href="{{-- asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') --}}" rel="stylesheet" type="text/css" />
 <link rel='stylesheet' type='text/css' property='stylesheet' href="{{-- asset('localhost/siaaf/public/index.php/_debugbar/assets/stylesheets?v=1498861062') --}}">
@endpush

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de usuarios'])

          
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                   
                    <div class="form-body">

                        {!! Form::open (['method'=>'POST', 'route'=> ['Registro_Usuario.store'], 'role'=>"form"]) !!}
                        
                        {!! Field:: text('PK_Usuario',null,['label'=>'Identificacion','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el nunemero de indentificacion del usuario.','icon'=>'fa fa-credit-card']) !!}

                        {!! Field:: text('Usuario',null,['label'=>'Usuario', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Nombre de usuario','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: text('Contraseña',null,['label'=>'Contraseña', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita la contraseña del usuario','icon'=>'fa fa-key'] ) !!}

                       {!! Field:: text('Nombre',null,['label'=>'Nombre(s)','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el nombre del usuario.','icon'=>'fa fa-user']) !!}
                        {!! Field:: text('Apellido',null,['label'=>'Apellido(s):', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el apellido del usuario.','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: email('Correo',null,['label'=>'Correo Electrónico:', 'class'=> 'form-control','id'=>'email','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                 ['icon'=>'fa fa-envelope-open '] ) !!}
                        {!! Field:: text('Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita un numero de telefono o celular.','icon'=>'fa fa-phone'] ) !!}
                        <div class="form-group">
                                                <label>Tipo Usuario</label>
                                                <select class="form-control" name="FK_TBL_Tipo_Usuario" >
                                                    @if($opcion)
                                                    @foreach($opcion as $row)
                                                    <option value="{{ $row->PK_Tipo_Usuario }}">{{ $row->Descripcion }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                        <div class="form-group">
                                                <label>Carrera</label>
                                                <select class="form-control" name="FK_TBL_Carrera">
                                                    @if($opciond)
                                                    @foreach($opciond as $row)
                                                    <option value="{{ $row->PK_Carrera }}">{{ $row->Carrera }}</option>
                                                    @endforeach
                                                    @endif
                                                    
                                                </select>
                                            </div>
                        

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                                    {!! Form::close() !!}
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
@endpush
@push('functions')
<script type="text/javascript">
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
                    PK_Usuario: {
                        required: true
                    },
                    Usuario: {
                        required: true
                    },
                    Contraseña: {
                        required: true
                    },
                    Nombre: {
                        required: true
                    },
                    Apellido: {
                        required: true

                    },
                    Correo: {
                        required: true,
                        email: true

                    },
                    Telefono: {
                        required: true

                    },
                    FK_TBL_Tipo_Usuario: {
                        required: true

                    },

                    FK_TBL_Carrera: {
                        required: true,
                        minlength: 1,
                    }

                },
                messages:{
                    PK_Usuario:: {
                        required: "Debes digitar el numero de identificacion del usauario."
                    },
                    Usuario: {
                        required: "Debes digitar el nick para el usuario"
                    },
                    Contraseña: {
                        required: 'Debes digitar la contraseña para el usuario'                       
                    },
                     Nombre: {
                        required: 'Debes digitar el nombre completo del usuario'
                    },
                    Correo: {
                        required: "Debes ingresar un correo electronico."

                    },
                    Apellido: {
                        required: "Debes ingresar una cedula."
                    },
                    Telefono: {
                        required: "Debes ingresar un telefono o celular."

                    },
                    FK_TBL_Tipo_Usuario: {
                        required: "Debes ingresar el tipo de usuario"

                    },
                    FK_TBL_Carrera: {
                        required: "Debes ingresar una carrera"

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