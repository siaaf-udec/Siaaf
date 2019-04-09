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
                 
                        {!! Field:: text('User_Codigo',null,['label'=>'Codigo Interno del Usuario:','class'=> 'form-control', 'autofocus', 'maxlength'=>'9','autocomplete'=>'off'],
                                                             ['help' => 'Digite el codigo interno del usuario.','icon'=>'fa fa-credit-card']) !!}
                                
                                {!! Field::select('User_Tipo_Documento',['T.I'=>'T.I', 'C.C'=>'C.C'],null,['label'=>'Tipo Documento: ']) !!}
                             
                                {!! Field:: text('User_Cedula',null,['label'=>'Documento:','class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                                ['help' => 'Digite el número de identificación del usuario. ','icon'=>'fa fa-credit-card']) !!}
                            
                                {!! Field:: text('User_Nombre1',null,['label'=>'Nombres:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite los nombres del usuario.','icon'=>'fa fa-user'] ) !!}

                                {!! Field:: text('User_Apellido1',null,['label'=>'Apellidos:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite los apellidos del usuario.','icon'=>'fa fa-user'] ) !!}

                                {!! Field::select('User_Sexo',['Masculino'=>'Masculino', 'Femenino'=>'Femenino'],null,['label'=>'Genero: ']) !!}

                                {!! Field:: email('User_Correo',null,['label'=>'Correo Electronico:', 'class'=> 'form-control', 'autofocus','maxlength'=>'150','autocomplete'=>'off'],
                                                                ['help' => 'Digite la direccion electronica del usuario.','icon'=>'fa fa-envelope-open'] ) !!}

                                {!! Field:: text('User_Direccion',null,['label'=>'Direccion de Residencia:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite la direccion de residencia del usuario.','icon'=>'fa fa-building-o'] ) !!}
                                
                                {!! Field::select('FK_User_IdRol',['1'=>'Estudiante', '2'=>'Docente','3'=>'Administrador'],null,['label'=>'ROL: ']) !!}
                            

                       
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('GESAP_ADMIN_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('GESAP_ADMIN_SUBMIT'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
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
                    //formulario UserControllerGesap
                    formData.append('name', $('input:text[name="User_Nombre1"]').val());
                    formData.append('lastname', $('input:text[name="User_Apellido1"]').val());
                    formData.append('birthday', "");
                    formData.append('sexo', $('select[name="User_Sexo"]').val());
                    formData.append('identity_type', $('select[name="User_Tipo_Documento"]').val());
                    formData.append('identity_no', $('input:text[name="User_Cedula"]').val());
                    formData.append('identity_expe_date', "");
                    formData.append('identity_expe_place', "");
                    formData.append('phone', "");
                    
                    formData.append('user_codigo', "#User_Codigo");
                    formData.append('state', "Aprobado");
                    formData.append('email', $('input[name="User_Correo"]').val());
                    formData.append('password', 12345);
                    formData.append('address_create', $('input:text[name="User_Direccion"]').val());
                   
                    formData.append('User_Codigo', $('#User_Codigo').val());
                    
                   
                   
                
                    formData.append('countries_id', 1);
                    formData.append('regions_id', 1);
                    formData.append('cities_id', 1);
                    formData.append('multi_select_roles_create', $('select[name="FK_User_IdRol"]').val());
                    formData.append('rol_gesap', $('#FK_User_IdRol').val());
                  
                    formData.append('image_profile_create', "undefined");
                    formData.append('identicon', "data:image/svg xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPSc0MjAnIGhlaWdodD0nNDIwJyBzdHlsZT0nYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDI1NSwyNTUsMjU1LDEpOyc PGcgc3R5bGU9J2ZpbGw6cmdiYSgwLDAsMCwxKTsgc3Ryb2tlOnJnYmEoMCwwLDAsMSk7IHN0cm9rZS13aWR0aDoyLjE7Jz48cmVjdCAgeD0nMTg1JyB5PSc4NScgd2lkdGg9JzUwJyBoZWlnaHQ9JzUwJy8 PHJlY3QgIHg9JzE4NScgeT0nMjg1JyB3aWR0aD0nNTAnIGhlaWdodD0nNTAnLz48cmVjdCAgeD0nMTM1JyB5PScxODUnIHdpZHRoPSc1MCcgaGVpZ2h0PSc1MCcvPjxyZWN0ICB4PScyMzUnIHk9JzE4NScgd2lkdGg9JzUwJyBoZWlnaHQ9JzUwJy8 PHJlY3QgIHg9Jzg1JyB5PSc4NScgd2lkdGg9JzUwJyBoZWlnaHQ9JzUwJy8 PHJlY3QgIHg9JzI4NScgeT0nODUnIHdpZHRoPSc1MCcgaGVpZ2h0PSc1MCcvPjxyZWN0ICB4PSc4NScgeT0nMTg1JyB3aWR0aD0nNTAnIGhlaWdodD0nNTAnLz48cmVjdCAgeD0nMjg1JyB5PScxODUnIHdpZHRoPSc1MCcgaGVpZ2h0PSc1MCcvPjxyZWN0ICB4PSc4NScgeT0nMjM1JyB3aWR0aD0nNTAnIGhlaWdodD0nNTAnLz48cmVjdCAgeD0nMjg1JyB5PScyMzUnIHdpZHRoPSc1MCcgaGVpZ2h0PSc1MCcvPjxyZWN0ICB4PSc4NScgeT0nMjg1JyB3aWR0aD0nNTAnIGhlaWdodD0nNTAnLz48cmVjdCAgeD0nMjg1JyB5PScyODUnIHdpZHRoPSc1MCcgaGVpZ2h0PSc1MCcvPjwvZz48L3N2Zz4=");


                                     
                 
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

                                
                                } else {
                                    $('#form_crear_usuario')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('UsuariosGesap.index.Ajax') }}';
                                    location.href="{{route('UsuariosGesap.index')}}";
                                    //$(".content-ajax").load(route);
                             
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
            PK_User_Codigo: {minlength: 7, maxlength: 10, required: true, number: true,},
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

        FormValidationMd.init(form, false, false, createUsers());

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
