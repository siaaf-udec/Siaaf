<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de Edición de usuarios'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
                             ],
         ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                   {!! Form::model ([$infoUsuario],[
                   'id' => 'form_editar_usuario']) !!}

                <div class="form-body">
                    <div class="row">
                        

                            {!! Field:: text('PK_User_Codigo',$infoUsuario['PK_User_Codigo'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite codigo interno del usuario en la universidad.','icon'=>'fa fa-credit-card'] ) !!}  

                            {!! Field:: text('User_Cedula',$infoUsuario['User_Cedula'],['label'=>'Cedula:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número de identificación del usuario. ','icon'=>'fa fa-credit-card']) !!}

                            {!! Field:: text('User_Nombre1',$infoUsuario['User_Nombre1'],['label'=>'Nombres:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite los nombres del usuario.','icon'=>'fa fa-user'] ) !!}

                            {{--{!! Field:: text('User_Nombre2',$infoUsuario['User_Nombre2'],['label'=>'Nombre 2:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo nombre.','icon'=>'fa fa-user'] ) !!} --}}

                            {!! Field:: text('User_Apellido1',$infoUsuario['User_Apellido1'],['label'=>'Apellidos:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite los apellidos del usuario.','icon'=>'fa fa-user'] ) !!}

                            {{--{!! Field:: text('User_Apellido2',$infoUsuario['User_Apellido2'],['label'=>'PALABRAS CLAVE:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo apellido.','icon'=>'fa fa-user'] ) !!}--}}

                            {!! Field:: email('User_Correo',$infoUsuario['User_Correo'],['label'=>'Correo Electronico:', 'class'=> 'form-control', 'autofocus','maxlength'=>'200','autocomplete'=>'off'],
                                                             ['help' => 'Digite la direccion electronica del usuario.','icon'=>'fa fa-envelope-open'] ) !!}

                            {!! Field:: text('User_Direccion',$infoUsuario['User_Direccion'],['label'=>'Direccion de Residencia:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite la direccion de residencia del usuario.','icon'=>'fa fa-building-o'] ) !!}

                            {{--{!! Field::select('FK_User_IdEstado',['1'=>'ACTIVO', '2'=>'INACTIVO'],null,['label'=>'ESTADO: ']) !!}--}}

                            {!! Field::select('FK_User_IdEstado', null,['name' => 'SelectEstado','label'=>'ESTADO: ']) !!}

                            {{--{!! Field::select('FK_User_IdRol',['1'=>'ESTUDIANTE', '2'=>'PROFESOR', '3'=>'ADMINISTRADOR'],null,['label'=>'ROL: ']) !!}--}}

                            {!! Field::select('FK_User_IdRol', null,['name' => 'SelectRol','label'=>'ROL: ']) !!}

                            {!! Field::checkbox('acceptTeminos2', '1', ['label' => 'Acepta términos y condiciones de la resolución numero 050 de 2018.','required']) !!}
                        
                        
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('CANCEL_GESAP')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('SUBMIT_GESAP'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    <br>
                    
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
        
        /* Configuración del Select roles cargado de la BD */
        var $widget_select_SelectRol = $('select[name="SelectRol"]');

        var valorSelectedRol = <?php echo $infoUsuario['FK_User_IdRol']; ?>

        var route_Rol = '{{ route('UsuariosGesap.listRoles') }}';
        $.get(route_Rol, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectRol.append(new Option(value.Rol_Usuario, value.PK_Id_Rol_Usuario));
            });
            $widget_select_SelectRol.val();
            $('#FK_User_IdRol').val(valorSelectedRol);
        });

        /* Configuración del Select estados cargado de la BD */
        var $widget_select_SelectEstado = $('select[name="SelectEstado"]');

        var valorSelectedEstado = <?php echo $infoUsuario['FK_User_IdEstado']; ?>

        var route_Estado = '{{ route('UsuariosGesap.listEstados') }}';
        $.get(route_Estado, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectEstado.append(new Option(value.STD_Descripcion, value.PK_IdEstado));
            });
            $widget_select_SelectEstado.val();
            $('#FK_User_IdEstado').val(valorSelectedEstado);
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
        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
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
                    var route = '{{ route('UsuariosGesap.update') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();

                    formData.append('PK_User_Codigo', $('input:text[name="PK_User_Codigo"]').val());
                    formData.append('User_Cedula', $('input:text[name="User_Cedula"]').val());
                    formData.append('User_Nombre1', $('input:text[name="User_Nombre1"]').val());
                    //formData.append('User_Nombre2', $('input:text[name="User_Nombre2"]').val());
                    formData.append('User_Apellido1', $('input:text[name="User_Apellido1"]').val());
                    //formData.append('User_Apellido2', $('input:text[name="User_Apellido2"]').val());
                    formData.append('User_Correo', $('input[name="User_Correo"]').val());
                    //formData.append('User_Contra', $('input:text[name="User_Nombre1"]').val());
                    formData.append('User_Direccion', $('input:text[name="User_Direccion"]').val());
                    //formData.append('FK_User_IdEstado', $('select[name="FK_User_IdEstado"]').val());
                    //formData.append('FK_User_IdRol', $('select[name="FK_User_IdRol"]').val());
                    formData.append('FK_User_IdEstado', $('select[name="SelectEstado"]').val());
                    formData.append('FK_User_IdRol', $('select[name="SelectRol"]').val());

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
                                $('#form_editar_usuario')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('UsuariosGesap.index.Ajax') }}';
                                location.href="{{route('UsuariosGesap.index')}}";
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

        var form = $('#form_editar_usuario');
        var formRules = {
            PK_User_Codigo: {required:true, minlength: 9, maxlength: 9, number: true,},
            User_Cedula: {minlength: 8, maxlength: 10, required: true, number: true,},
            User_Nombre1: {required: true, letters: true},
            //User_Nombre2: {required: true, letters: true},
            User_Apellido1: {required: true, letters: true},
            //User_Apellido2: {required: true, letters: true},
            User_Correo: {required: true, email: true},
            User_Contra: {required: true},
            User_Direccion: {noSpecialCharacters:true},
            Fk_User_IdEstado: {required: true},
            FK_User_IdRol: {required: true},
            acceptTeminos2: {required: true},
        };
        var formMessage = {
            User_Nombre1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Nombre2: {letters: 'Solo se pueden ingresar letras'},
            User_Apellido1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Apellido2: {letters: 'Solo se pueden ingresar letras'},
            User_Direccion: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };

        FormValidationMd.init(form, formRules, formMessage, editarUsers());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('UsuariosGesap.index.Ajax') }}';
            location.href="{{route('UsuariosGesap.index')}}";
            //$(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('UsuariosGesap.index.Ajax') }}';
            location.href="{{route('UsuariosGesap.index')}}";
            //$(".content-ajax").load(route);
        });

    });

</script>