<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos de los usuarios'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$infoUsuario], ['id'=>'form_update_usuario', 'url' => '/forms'])  !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            

                            {!! Field:: text('PK_CU_Codigo',$infoUsuario['PK_CU_Codigo'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CU_Cedula',$infoUsuario['CU_Cedula'],['label'=>'Cedula de ciudadanía:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número cedula del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CU_Nombre1',$infoUsuario['CU_Nombre1'],['label'=>'Nombres:','class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                                             ['help' => 'Digite los nombres del usuario.','icon'=>'fa fa-user']) !!}

                            {{-- {!! Field:: text('CU_Nombre2',$infoUsuario['CU_Nombre2'],['label'=>'Segundo Nombre:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo nombre del usuario.','icon'=>'fa fa-user'] ) !!} --}}
                            
                            {!! Field:: text('CU_Apellido1',$infoUsuario['CU_Apellido1'],['label'=>'Apellidos:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite los apellidos del usuario.','icon'=>'fa fa-user'] ) !!}

                            {{--   {!! Field:: text('CU_Apellido2',$infoUsuario['CU_Apellido2'],['label'=>'Segundo Apellido:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!} --}}
                            
                            {!! Field:: text('CU_Telefono',$infoUsuario['CU_Telefono'],['label'=>'Teléfono:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número de teléfono del usuario.','icon'=>'fa fa-phone'] ) !!}
                        
                        </div>
                        <div class="col-md-6">

                            {!! Field:: email('CU_Correo',$infoUsuario['CU_Correo'],['label'=>'Correo electrónico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'90','autocomplete'=>'off'],
                                                             ['help' => 'Digite un correo electronico válido.','icon'=>'fa fa-envelope-open '] ) !!}

                            {!! Field:: text('CU_Direccion',$infoUsuario['CU_Direccion'],['label'=>'Dirección:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'70','autocomplete'=>'off'],
                                                             ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-building-o'] ) !!}

                            {!! Field::select('FK_CU_Id_Dependencia', null,['name' => 'SelectDependencia','label'=>'Dependencia:']) !!}

                            {!! Field::select('FK_CU_Id_Estado',null,['name' => 'SelectEstado','label'=>'Estado del Usuario: ']) !!}
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('CALIDADPCS_UPDATE_USER')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('CALIDADPCS_UPDATE_USER'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endcomponent

</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        /* Configuración del Select cargado de la BD */

        var $widget_select_SelectDependencia = $('select[name="SelectDependencia"]');

        var valorSelected =
            <?php echo $infoUsuario['FK_CU_Id_Dependencia']; ?>

        var route_Dependencia = '{{ route('calidadpcs.usuariosCalidadPcs.listDependencias') }}';
        $.get(route_Dependencia, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectDependencia.append(new Option(value.CD_Dependencia, value.PK_CD_Id_Dependencia));
            });
            $widget_select_SelectDependencia.val();
            $('#FK_CU_Id_Dependencia').val(valorSelected);
        });

        var $widget_select_SelectEstado = $('select[name="SelectEstado"]');

        var valorSelectedEstado =
            <?php echo $infoUsuario['FK_CU_Id_Estado']; ?>

        var route_Estado = '{{ route('calidadpcs.usuariosCalidadPcs.listEstados') }}';
        $.get(route_Estado, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectEstado.append(new Option(value.CE_Estado, value.PK_CE_Id_Estado));
            });
            $widget_select_SelectEstado.val([]);
            $('#FK_CU_Id_Estado').val(valorSelectedEstado);
        });


        /*Configuracion de Select*/

        ///////////////////////
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Seleccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });
        
        //////////////////////FUNCION DE EDITAR//////////////////////////////////////

        var editarUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('calidadpcs.usuariosCalidadPcs.update') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('PK_CU_Codigo', $('input:text[name="PK_CU_Codigo"]').val());
                    formData.append('CU_Cedula', $('input:text[name="CU_Cedula"]').val());
                    formData.append('CU_Nombre1', $('input:text[name="CU_Nombre1"]').val());
                    // formData.append('CU_Nombre2', $('input:text[name="CU_Nombre2"]').val());
                    formData.append('CU_Apellido1', $('input:text[name="CU_Apellido1"]').val());
                    // formData.append('CU_Apellido2', $('input:text[name="CU_Apellido2"]').val());
                    formData.append('CU_Telefono', $('input:text[name="CU_Telefono"]').val());
                    formData.append('CU_Correo', $('input[name="CU_Correo"]').val());
                    formData.append('CU_Direccion', $('input:text[name="CU_Direccion"]').val());
                    formData.append('FK_CU_Id_Estado', $('select[name="SelectEstado"]').val());
                    formData.append('FK_CU_Id_Dependencia', $('select[name="SelectDependencia"]').val());

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_update_usuario')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('calidadpcs.usuariosCalidadPcs.index.ajax') }}';
                                location.href="{{route('calidadpcs.usuariosCalidadPcs.index')}}";
                                //$(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form = $('#form_update_usuario');
        var formRules = {
            //CU_UrlFoto: {required: true, extension: "jpg|png"},
            CU_Cedula: {minlength: 8, maxlength: 10, required: false, number: true,},
            PK_CU_Codigo: {required: false, minlength: 5, maxlength: 12, number: true},
            CU_Nombre1: {required: true, letters: true},
            // CU_Nombre2: {letters: true},
            CU_Apellido1: {required: true, letters: true},
            // CU_Apellido2: {letters: true},
            CU_Telefono: {required: false, noSpecialCharacters:true},
            CU_Correo: {required: true, email: true},
            CU_Direccion: {required: false, noSpecialCharacters:true},
            FK_CU_Id_Dependencia: {required: true},
            FK_CU_Id_Estado: {required: true},
            acceptTeminos: {required: true},
        };
        var formMessage = {
            CU_Nombre1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Nombre2: {letters: 'Solo se pueden ingresar letras'},
            CU_Apellido1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Apellido2: {letters: 'Solo se pueden ingresar letras'},
            CU_Telefono: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CU_Direccion: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, editarUsers());

        /////////////////////FIN FUNCION EDITAR ////////////////////////////////////////////
        
        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.usuariosCalidadPcs.index.ajax') }}';
            location.href="{{route('calidadpcs.usuariosCalidadPcs.index')}}";
            //$(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('calidadpcs.usuariosCalidadPcs.index.ajax') }}';
            location.href="{{route('calidadpcs.usuariosCalidadPcs.index')}}";
            //$(".content-ajax").load(route);
        });


    });

</script>
