<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de usuarios'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
                             ],
         ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::open (['id'=>'form_crear_usuario', 'url'=>'/forms']) !!}
          

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <span class="label label-primary">Ingrese los Datos</span>
                                <br><br>
                                <br><br> 
                                
                                {!! Field:: text('User_Codigo',null,['label'=>'Codigo Interno del Usuario:','class'=> 'form-control', 'autofocus', 'maxlength'=>'9','autocomplete'=>'off'],
                                                             ['help' => 'Digite el codigo interno del usuario.','icon'=>'fa fa-credit-card']) !!}
                                
                                {!! Field::select('User_Tipo_Documento',['T.I'=>'T.I', 'C.C'=>'C.C'],null,['label'=>'Tipo Documento: ']) !!}
                             
                                
                                {!! Field:: text('User_Nombre1',null,['label'=>'Nombres:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite los nombres del usuario.','icon'=>'fa fa-user'] ) !!}

                                {!! Field:: text('User_Apellido1',null,['label'=>'Apellidos:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite los apellidos del usuario.','icon'=>'fa fa-user'] ) !!}

                                {!! Field:: email('User_Correo',null,['label'=>'Correo Electronico:', 'class'=> 'form-control', 'autofocus','maxlength'=>'150','autocomplete'=>'off'],
                                                                ['help' => 'Digite la direccion electronica del usuario.','icon'=>'fa fa-envelope-open'] ) !!}

                                {!! Field:: text('User_Direccion',null,['label'=>'Direccion de Residencia:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite la direccion de residencia del usuario.','icon'=>'fa fa-building-o'] ) !!}
                                
                                {!! Field::select('FK_User_IdRol',['1'=>'Estudiante', '2'=>'Docente','3'=>'Administrador'],null,['label'=>'ROL: ']) !!}
                             
                                     
                               
                            </div>
                            
                          
                             <div class="form-group divcode">
                                
                            </div>
                            
                        <br><br>
                        <a href="https://www.ucundinamarca.edu.co/index.php/proteccion-de-datos-personales" target="_blank">- Ver la Resolución No. 050 de 2018 , tratamiento de datos personales</a>
                        </div>


                        <div class="col-md-6">
                            <br><br>
                            <br><br>
                            <br><br>
                            <br><br>
                            <br><br>

                            {!! Field:: text('User_Cedula',null,['label'=>'Documento:','class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                                ['help' => 'Digite el número de identificación del usuario. ','icon'=>'fa fa-credit-card']) !!}
                            {!! Field::date('User_Fecha_Expedicion',null,['label'=>'Fecha de expedición :'],
                                                                ['help' => 'Digite la primera fecha de radicacion del proximo este semestre','icon'=>'fa fa-calendar']) !!}

                            {!! Field::date('User_Nacimiento',null,['label'=>'Fecha de nacimiento :'],
                                                                ['help' => 'Digite la primera fecha de radicacion del proximo este semestre','icon'=>'fa fa-calendar']) !!}

                            {!! Field::select('User_Sexo',['Masculino'=>'Masculino', 'Femenino'=>'Femenino'],null,['label'=>'Genero: ']) !!}
                            <br><br>
                            <br><br>
                            <br><br>
                            <br><br>
                            <br><br>

                            {!! Field::checkbox('acceptTeminos2', '1', ['label' => 'Acepta términos y condiciones de la resolución numero 050 de 2018.','required']) !!}

                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('ADD_USER')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('ADD_USER'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
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
<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
    
        /* Configuración del Select cargado de la BD */

       /*  var $widget_select_SelectRol = $('select[name="SelectRol"]');

        var route_Rol = '{{ route('UsuariosGesap.listRoles') }}';
        $.get(route_Rol, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectRol.append(new Option(value.Rol_Usuario, value.PK_Id_Rol_Usuario));
            });
            $widget_select_SelectRol.val([]);
            $('#FK_User_IdRol').val(1);
        });
 */
        /*Configuracion de Select*/
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

        var createUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('UsuariosGesap.createUsuario') }}';
                    var formData = new FormData();
                    var async = async || false;

                    formData.append('PK_User_Codigo', $('input:text[name="User_Cedula"]').val());
                    formData.append('User_Codigo', $('input:text[name="User_Codigo"]').val());
                    formData.append('User_Nombre1', $('input:text[name="User_Nombre1"]').val());
                    formData.append('User_Apellido1', $('input:text[name="User_Apellido1"]').val());
                    formData.append('User_Correo', $('input[name="User_Correo"]').val());
                    formData.append('User_Direccion', $('input:text[name="User_Direccion"]').val());
                    formData.append('FK_User_IdEstado', '1');
                    formData.append('User_Tipo_Documento', $('select[name="User_Tipo_Documento"]').val());
                    formData.append('User_Sexo', $('select[name="User_Sexo"]').val());
                    formData.append('User_Nacimiento', $('#User_Nacimiento').val());
                    formData.append('User_Fecha_Expedicion', $('#User_Fecha_Expedicion').val());
                    formData.append('FK_User_IdRol', $('#FK_User_IdRol').val());
                    
                                     
                 
                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: async || false,
                         success: function (response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('UsuariosGesap.index.Ajax') }}';
                                    location.href="{{route('UsuariosGesap.index')}}";
                                } else {
                                    $('#form_crear_usuario')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('UsuariosGesap.index.Ajax') }}';
                                    location.href="{{route('UsuariosGesap.index')}}";
                                     }
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
        var form = $('#form_crear_usuario');
        var formRules = {
            PK_User_Codigo: {minlength: 7, maxlength: 9, required: true, number: true,},
            User_Cedula: {minlength: 8, maxlength: 10, required: true, number: true,},
            User_Nombre1: {required: true, letters: true},
            //User_Nombre2: {required: true, letters: true},
            User_Apellido1: {required: true, letters: true},
            //User_Apellido2: {required: true, letters: true},
            User_Correo: {required: true, email: true},
            User_Contra: {required: true},
            User_Direccion: {noSpecialCharacters:true},
            //Fk_User_IdEstado: {required: true},
            FK_User_IdRol: {required: true},
            acceptTeminos2: {required: true},
        };
        var formMessage = {
          //  NPRY_Titulo: {letters: 'Solo se pueden letras'},//arreglar
            User_Nombre1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Nombre2: {letters: 'Solo se pueden ingresar letras'},
            User_Apellido1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Apellido2: {letters: 'Solo se pueden ingresar letras'},
            User_Direccion: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };

        FormValidationMd.init(form, formRules, formMessage, createUsers());

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
