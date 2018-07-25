<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de vehículos'])
        @slot('actions', [
              'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                               ],
               ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ($codigoUsuario,['id'=>'form_moto_create', 'url' => '/forms']) !!}

                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">

                            {!! Field:: text('FK_CM_CodigoUser',$codigoUsuario,['label'=>'Código del usuario:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                         ['help' => 'Digite la placa del vehículo a registrar.','icon'=>'fa fa-id-card-o'] ) !!}

                            {!! Field:: text('CM_Placa',null,['label'=>'Placa del vehículo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite la placa del vehículo a registrar.','icon'=>'fa fa-motorcycle'] ) !!}



                        </div>
                        <div class="col-md-6">
                            
                            {!! Field:: text('CM_Marca',null,['label'=>'Marca del vehículo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite la marca del vehículo.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CM_NuPropiedad',null,['label'=>'Número de tarjeta de propiedad:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite el número de la tarjeta de propiedad del vehículo.','icon'=>'fa fa-id-card-o'] ) !!}

                          {{--   {!! Field:: text('CM_NuSoat',null,['label'=>'Número del SOAT:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                         ['help' => 'Digite el número del SOAT vigente.','icon'=>'fa fa-id-card-o'] ) !!}

                            {!! Field::date('CM_FechaSoat',['label' => 'Fecha de vencimiento del SOAT', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => 'Digite la fecha de vencimiento del SOAT', 'icon' => 'fa fa-calendar']) !!} --}}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                            <div class="col-md-4">
                                {{-- <span class="label label-primary">Seleccione la foto del vehículo</span>
                                {!! Field::file('CM_UrlFoto') !!} --}}
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
                            </div>
                           {{--  <div class="col-md-4">
                                <span class="label label-primary">Tarjeta de propiedad del vehículo</span>
                                {!! Field::file('CM_UrlPropiedad') !!}
                            </div>
                            <div class="col-md-4">
                                <span class="label label-primary">SOAT del vehículo</span>
                                {!! Field::file('CM_UrlSoat') !!}
                            </div> --}}
                        </div>
                    </div>


                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            @permission('PARK_CREATE_MOTO')<a href="javascript:;"
                                                           class="btn btn-outline red button-cancel"><i
                                        class="fa fa-angle-left"></i>
                                Cancelar
                            </a>@endpermission

                            @permission('PARK_CREATE_MOTO'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                            
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-actions">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="alert alert-success">
                                <strong>¡OPCIONAL!</strong> Registro de Motos utilizando camara web, sin cargar archivos del equipo.
                            </div>
                        </div>
                        <div class="col-md-12 col-md-offset-4">
                            <div class="actions">
                                @permission('PARK_CREATE_MOTO')<a href="javascript:;"
                                                                   class="btn btn-simple btn-success btn-icon create"
                                                                   title="Registar nueva Moto usando camara">
                                        <i class="fa fa-plus">
                                        </i>Registro usando camara
                                    </a>@endpermission
                            </div>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>

    @endcomponent
</div>
<!-- file script -->
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type = "text/javascript" > </script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
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
        /*Configuracion de input tipo fecha*/
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            regional: 'es',
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yyyy-mm-dd',
            firstDay: 1,
            showMonthAfterYear: false,
            yearSuffix: ''
        });
        /*FIN Configuracion de input tipo fecha*/
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });
        var createMoto = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.motosCarpark.store') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    var FileMoto = document.getElementById("CM_UrlFoto");
                    // var FileProp = document.getElementById("CM_UrlPropiedad");
                    // var FileSOAT = document.getElementById("CM_UrlSoat");
                    formData.append('CM_Placa', $('input:text[name="CM_Placa"]').val());
                    formData.append('CM_Marca', $('input:text[name="CM_Marca"]').val());
                    formData.append('CM_NuPropiedad', $('input:text[name="CM_NuPropiedad"]').val());
                    // formData.append('CM_NuSoat', $('input:text[name="CM_NuSoat"]').val());
                    // formData.append('CM_FechaSoat', $('#CM_FechaSoat').val());

                    var file=postCanvasToURL();
                    formData.append('CM_UrlFoto', file);
                    //formData.append('CM_UrlFoto', FileMoto.files[0]);
                    // formData.append('CM_UrlPropiedad', FileProp.files[0]);
                    // formData.append('CM_UrlSoat', FileSOAT.files[0]);
                    formData.append('FK_CM_CodigoUser', $('input:text[name="FK_CM_CodigoUser"]').val());
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
                            
                            if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
                                    $(".content-ajax").load(route);
                            }
                            else{
                                if (request.status === 200 && xhr === 'success') {
                                $('#form_moto_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.motosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
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
        var form = $('#form_moto_create');
        var formRules = {
            //CM_UrlFoto: {required: false, extension: "jpg|png"},
            CM_Placa: {minlength: 6, maxlength: 6, required: true, noSpecialCharacters:true},
            CM_Marca: {required: true, minlength: 3, maxlength: 50, noSpecialCharacters:true},
            CM_NuPropiedad: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            // CM_NuSoat: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            // CM_FechaSoat: {required: true},
            // CM_UrlPropiedad: {required: false, extension: "jpg|png"},
            // CM_UrlSoat: {required: false, extension: "jpg|png"},
        };
        var formMessage = {
            CM_Placa: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CM_Marca: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CM_NuPropiedad: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            // CM_NuSoat: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, createMoto());
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
            var codigo=  $('input:text[name="FK_CM_CodigoUser"]').val();
            var route = '{{ route('parqueadero.motosCarpark.RegistrarMoto') }}' + '/' + codigo;
            $(".content-ajax").load(route);
        });
    });
</script>