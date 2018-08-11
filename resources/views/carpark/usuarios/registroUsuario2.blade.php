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
                {!! Form::model ($listaDependencias,['id'=>'form_usuario_create', 'url' => '/forms']) !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center" >
                                {{-- <span class="label label-primary">Seleccione la foto del usuario</span>
                                {!! Field::file('CU_UrlFoto') !!}
                                <br><br> --}}

                                <video id="video" width="100%" height="100%" ></video>
                                <br>
                                <button id="boton" type="button" class="btn btn-info btn-responsive btninter centrado" >Tomar foto</button>
                                <br>
                                <div align="center">
                                     <span class="label label-success" id="estado"></span>
                                </div>
                                <canvas id="canvas" style="display: none"></canvas>
                            </div>
                            
                            <br>
                            <br>

                             {!! Field::select('FK_CU_IdDependencia', null,['name' => 'SelectDependencia','label'=>'Dependencia: ']) !!}


                            

                            {!! Field:: text('CU_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número cedula del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            
                           {{--  {!! Field:: text('CU_Nombre2',null,['label'=>'Segundo Nombre:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo nombre del usuario.','icon'=>'fa fa-user'] ) !!} --}}
                            
                            
                            
                             <div class="form-group divcode">
                                

                                {!! Field:: text('PK_CU_Codigo',null,['label'=>'Código interno:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                     ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}
                               
                            </div>
                        <br>
                        <a href="http://intranet.unicundi.edu.co/portal/index.php/resoluciones/774-resolucion-307-de-diciembre-4-de-2008" target="_blank">- Ver la resolución número 307 de 2008 , uso de parqueaderos</a>
                        <br><br>
                        <a href="https://www.ucundinamarca.edu.co/index.php/proteccion-de-datos-personales" target="_blank">- Ver la Resolución No. 050 de 2018 , tratamiento de datos personales</a>
                        </div>


                        <div class="col-md-6">

                            {!! Field:: text('CU_Nombre1',null,['label'=>'Nombres:','class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                                             ['help' => 'Digite los nombres del usuario.','icon'=>'fa fa-user']) !!}


                            {!! Field:: text('CU_Apellido1',null,['label'=>'Apellidos:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite los apellidos del usuario.','icon'=>'fa fa-user'] ) !!}

                            {{-- {!! Field:: text('CU_Apellido2',null,['label'=>'Segundo Apellido:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!} --}}

                            {!! Field:: text('CU_Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número de teléfono del usuario.','icon'=>'fa fa-phone'] ) !!}

                            {!! Field:: email('CU_Correo',null,['label'=>'Correo electrónico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'90','autocomplete'=>'off'],
                                                             ['help' => 'Digite un correo electronico válido.','icon'=>'fa fa-envelope-open '] ) !!}

                            {!! Field:: text('CU_Direccion',null,['label'=>'Dirección:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'70','autocomplete'=>'off'],
                                                             ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-building-o'] ) !!}

                           

                            {!! Field::select('FK_CU_IdEstado',['1'=>'Activo', '2'=>'Inactivo'],null,['label'=>'Estado del usuario: ']) !!}

                            {!! Field::checkbox('acceptTeminos', '1', ['label' => 'Acepta términos y condiciones de la resolución número 307 de 2008.','required']) !!}

                            {!! Field::checkbox('acceptTeminos2', '1', ['label' => 'Acepta términos y condiciones de la resolución numero 050 de 2018.','required']) !!}

                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('PARK_CREATE_USER')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('PARK_CREATE_USER'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                     <br>
                <div class="form-actions">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="alert alert-success">
                            <strong>¡OPCIONAL!</strong> Registro de usuarios sin utilizar camara web, solo cargando archivos del equipo.
                        </div>
                    </div>
                    <div class="col-md-12 col-md-offset-4">
                        <div class="actions">
                            @permission('PARK_CREATE_USER')<a href="javascript:;"
                                                                   class="btn btn-simple btn-success btn-icon create"
                                                                   title="Registar nuevo usuario sin usar camara">
                                        <i class="fa fa-plus">
                                        </i>Registro sin camara
                                    </a>@endpermission
                        </div>
                    </div>
                </div>


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


    //SCRIPT TOMAR FOTO

           
            function tieneSoporteUserMedia() {
            return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
            }
            function _getUserMedia() {
            return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
            }
            // Declaramos elementos del DOM
            var $video = document.getElementById("video"),
            $canvas = document.getElementById("canvas"),
            $boton = document.getElementById("boton"),
            $estado = document.getElementById("estado");


            if (tieneSoporteUserMedia()) {
                _getUserMedia({
                video: true
                },
                function(stream) {

                    console.log("Permiso concedido");
                    $video.srcObject = stream;
                    $video.play();
                    //Escuchar el click
                    $boton.addEventListener("click", function() {
                    //Pausar reproducción
                    $video.pause();
                    //Obtener contexto del canvas y dibujar sobre él
                    var contexto = $canvas.getContext("2d");
                    $canvas.width = $video.videoWidth;
                    $canvas.height = $video.videoHeight;
                    contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
                    var foto = $canvas.toDataURL; //Esta es la foto, en base 64
                    $estado.innerHTML = "FOTO TOMADA";

                });
                },
                function(error) {
                    console.log("Permiso denegado o error: ", error);
                    $estado.innerHTML = "ACCESO DENEGADO A LA CAMARA";
                });
            } else {
                alert("Lo siento. Tu navegador no soporta esta característica");
                $estado.innerHTML = "NAVEGADOR NO SOORTA CAMARA";
            }


//FIN SCRIPT

//CONVERTIR FOTO EN ARCHIVO


            function postCanvasToURL() {
                  // Convert canvas image to Base64
                  var img = $canvas.toDataURL();
                  // Convert Base64 image to binary
                  var file = dataURItoBlob(img);

                  return file;
            }

            function dataURItoBlob(dataURI) {
                // convert base64/URLEncoded data component to raw binary data held in a string
                var byteString;
                if (dataURI.split(',')[0].indexOf('base64') >= 0){
                    byteString = atob(dataURI.split(',')[1]);
                }
                else{
                    byteString = unescape(dataURI.split(',')[1]);
                }
                // separate out the mime component
                var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
                // write the bytes of the string to a typed array
                var ia = new Uint8Array(byteString.length);
                for (var i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }
                return new Blob([ia],{type:'image/png'});
            }


//FIN SCRIPT

    jQuery(document).ready(function () {

        /* Configuración del Select cargado de la BD */


        var $widget_select_SelectDependencia = $('select[name="SelectDependencia"]');

        var route_Dependencia = '{{ route('parqueadero.usuariosCarpark.listDependencias') }}';
        $.get(route_Dependencia, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectDependencia.append(new Option(value.CD_Dependencia, value.PK_CD_IdDependencia));
            });
            $widget_select_SelectDependencia.val([]);
            $('#FK_CU_IdDependencia').val(2);
        });


        /*Configuracion de Select*/
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });


        //hola
        $('.divcode').hide();
        

        $("#FK_CU_IdDependencia").on('change', function () {
            var tipo = $('select[name="SelectDependencia"]').val();
            if (tipo == 1) {
                $('.divcode').show();
                
            }
            if (tipo == 2) {
                $('.divcode').hide();
                
            }
            if (tipo == 3) {
                $('.divcode').hide();
                
            }
            if (tipo == 4) {
                $('.divcode').hide();
               
            }
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
                    var route = '{{ route('parqueadero.usuariosCarpark.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    var File = document.getElementById("CU_UrlFoto");

                    formData.append('PK_CU_Codigo', $('input:text[name="PK_CU_Codigo"]').val());
                    formData.append('CU_Cedula', $('input:text[name="CU_Cedula"]').val());
                    formData.append('CU_Nombre1', $('input:text[name="CU_Nombre1"]').val());
                    // formData.append('CU_Nombre2', $('input:text[name="CU_Nombre2"]').val());
                    formData.append('CU_Apellido1', $('input:text[name="CU_Apellido1"]').val());
                    // formData.append('CU_Apellido2', $('input:text[name="CU_Apellido2"]').val());
                    formData.append('CU_Telefono', $('input:text[name="CU_Telefono"]').val());
                    formData.append('CU_Correo', $('input[name="CU_Correo"]').val());
                    formData.append('CU_Direccion', $('input:text[name="CU_Direccion"]').val());

                    
                    var file=postCanvasToURL();
                    formData.append('CU_UrlFoto', file);
                    

                    formData.append('FK_CU_IdEstado', $('select[name="FK_CU_IdEstado"]').val());
                    formData.append('FK_CU_IdDependencia', $('select[name="SelectDependencia"]').val());

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
                                if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                                    location.href="{{route('parqueadero.usuariosCarpark.index')}}";
                                    //$(".content-ajax").load(route);;
                                } else {
                                    $('#form_usuario_create')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                                    location.href="{{route('parqueadero.usuariosCarpark.index')}}";
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
        var form = $('#form_usuario_create');
        var formRules = {
            //CU_UrlFoto: {required: true, extension: "jpg|png"},
            CU_Cedula: {minlength: 8, maxlength: 10, required: true, number: true,},
            PK_CU_Codigo: {required:false, minlength: 9, maxlength: 9, number: true},
            CU_Nombre1: {required: true, letters: true},
            // CU_Nombre2: {letters: true},
            CU_Apellido1: {required: true, letters: true},
            // CU_Apellido2: {letters: true},
            CU_Telefono: {noSpecialCharacters:true},
            CU_Correo: {required: true, email: true},
            CU_Direccion: { noSpecialCharacters:true},
            FK_CU_IdDependencia: {required: true},
            FK_CU_IdEstado: {required: true},
            acceptTeminos: {required: true},
            acceptTeminos2: {required: true},
        };

        var formMessage = {
            CU_Nombre1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Nombre2: {letters: 'Solo se pueden ingresar letras'},
            CU_Apellido1: {letters: 'Solo se pueden ingresar letras'},
            // CU_Apellido2: {letters: 'Solo se pueden ingresar letras'},
            CU_Telefono: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CU_Direccion: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };

        FormValidationMd.init(form, formRules, formMessage, createUsers());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
            location.href="{{route('parqueadero.usuariosCarpark.index')}}";
            //$(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
            location.href="{{route('parqueadero.usuariosCarpark.index')}}";
            //$(".content-ajax").load(route);
        });
        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.usuariosCarpark.create') }}';
            $(".content-ajax").load(route);
        });


    });

</script>
