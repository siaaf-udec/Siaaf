
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de empresas'])

          
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                   
                    <div class="form-body">

                         {!! Form::model ($Empresa, ['method'=>'PATCH','id' => 'from_concept_create', 'class' => '', 'url' => '/forms']) !!}
                        
                        
                        
                        {!! Field:: text('Nombre_Empresa',null,['label'=>'Nombre de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digitar el ombre de la empresa','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: text('Razon_Social',null,['label'=>'Razon saocial', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'digitar la razon social de la empresa','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: text('Telefono',null,['label'=>'Telefono', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digitar el numero de telefono de la empresa','icon'=>'fa fa-user'] ) !!}
                        {!! Field:: text('Direccion',null,['label'=>'Direccion de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'digitar la direcion de la empresa','icon'=>'fa fa-user'] ) !!}
                        

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
                    PK_Empresa: {
                        required: true
                    },
                    Nombre_Empresa: {
                        required: true
                    },
                    Razon_Social: {
                        required: true
                    },
                    Telefono: {
                        required: true
                    },
                    Direcion: {
                        required: true
                    }
                },
                messages:{
                    PK_Empresa:: {
                        required: "Debe digitar el numero de identificacion de la empresa."
                    },
                    Nombre_Empresa: {
                        required: "Debe digitar el nombre de la empresa"
                    },
                    Razon_Social: {
                        required: "Debe digitar la razon social de la empresa"
                    },
                    Telefono: {
                        required: "Debe digitar el telefono de la empresa"
                    },
                    Direcion: {
                        required: "Debe digitar la direcion de la empresa"
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
    
    
    var updatePermissions = function () {
            return{
                init: function () {
                    var id_edit = $('input[name="id_edit"]').val();
                    var route = '{{ route('anteproyecto.guardar.conceptos') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('PK_Empresa', $('select[name="PK_Empresa"]').val());
                    formData.append('Nombre_Empresa', $('input[name="Nombre_Empresa"]').val());
                    formData.append('Razon_Social', $('input[name="Razon_Social"]').val());
                    formData.append('Telefono', $('select[name="Telefono"]').val());
                    formData.append('Direccion', $('input[name="Direccion"]').val());
                    

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal-create-concept').modal('hide');
                                $('#from_concept_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
    
    
     var form_edit = $('#from_concept_create');
        var rules_edit = {
            concepto: {required: true}
        };
        FormValidationMd.init(form_edit,rules_edit,false,updatePermissions());


</script>
