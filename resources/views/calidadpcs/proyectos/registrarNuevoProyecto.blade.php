<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de proyectos'])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ($codigoUsuario ,['id'=>'form_proyecto_create', 'url' => '/forms']) !!}
                    <div class="form-body">
                        <div class="row">
                        <h3><i class="fa fa-arrow-right"></i><strong> Datos del proyecto</strong></h3> <br>
                            <div class="col-md-6">

                                {!! Field:: hidden ('PK_CU_Id_Usuario', $codigoUsuario)!!}
                                {!! Field:: hidden ('FK_CP_Id_Usuario', Auth::user()->id)!!}
                                {!! Field:: hidden ('CU_Cedula', Auth::user()->identity_no)!!}
                                {!! Field:: hidden ('CU_Nombre', Auth::user()->name)!!}
                                {!! Field:: hidden ('CU_Apellido', Auth::user()->lastname)!!}
                                {!! Field:: hidden ('CU_Telefono', Auth::user()->phone)!!}
                                {!! Field:: hidden ('CU_Correo', Auth::user()->email)!!}

                                {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Nombre del Proyecto:', 'max' => '190', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
                            </div>
                            <div class="col-md-6">

                                {!! Field::date('CP_Fecha_Inicio',['label' => 'Fecha de inicio del proyecto',  'class'=> 'form-control datepicker','auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => 'Digite la fecha de inicio del proyecto', 'icon' => 'fa fa-calendar']) !!}
                                {{--
                                {!! Field::date('CP_Fecha_Final',['label' => 'Fecha final del proyecto', 'class'=> 'form-control datepicker', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => 'Digite la fecha final del proyecto', 'icon' => 'fa fa-calendar']) !!}
                                --}}
                            </div>
                        </div>
                        <div class="row">
                        <h3><i class="fa fa-arrow-right"></i><strong>  Información de los roles Scrum</strong></h3><br>
                            <div class="col-md-6">

                                {!! Field:: text('CE_Nombre_1',['label'=>'Scrum Master:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del Scrum Master','icon'=>'fa fa-user'] ) !!}

                                {!! Field:: text('CE_Nombre_4',['label'=>'Lider del Equipo Scrum:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del Lider','icon'=>'fa fa-users'] ) !!}

                            </div>
                            <div class="col-md-6">

                                {!! Field:: text('CE_Nombre_2',['label'=>'Product Owner:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del Product Owner','icon'=>'fa fa-user'] ) !!}
                                                            
                                {!! Field:: text('CE_Nombre_3',['label'=>'Stakeholder:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del Stakeholder','icon'=>'fa fa-user'] ) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <h3>Integrantes del equipo </h3>
                                <hr>
                                {!! Field:: text('CE_Nombre_5',['label'=>'Integrante del equipo:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del integrante','icon'=>'fa fa-user-o'] ) !!}

                                {!! Field:: text('CE_Nombre_6',['label'=>'Integrante del equipo:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del integrante','icon'=>'fa fa-user-o'] ) !!}
                            </div>
                            <div class="col-md-12" id="ListaIntegrantes">
                               
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <a class="btn btn-outline blue btn-xs" id="agregarIntegrante"><i class="fa fa-user-plus"></i> Agregar integrante</a>  
                                <a class="btn btn-outline red btn-xs" id="eliminarIntegrante"><i class="fa fa-user-times"></i> Eliminar integrante</a> 
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('CALIDADPCS_CREATE_PROJECT')<a href="javascript:;"
                                                            class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>
                                {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                                
                                @endpermission
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type = "text/javascript" > </script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        /*Configuracion de input tipo fecha*/
        $('.datepicker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            language: 'es',
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
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        var createProyecto = function () {
            return {
                init: function () {
                    var route = '{{ route('calidadpcs.proyectosCalidad.store') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    //Tabla Usuarios
                    formData.append('PK_CU_Id_Usuario', $('input:hidden[name="PK_CU_Id_Usuario"]').val());
                    formData.append('CU_Cedula', $('input:hidden[name="CU_Cedula"]').val());
                    formData.append('CU_Nombre', $('input:hidden[name="CU_Nombre"]').val());
                    formData.append('CU_Apellido', $('input:hidden[name="CU_Apellido"]').val());
                    formData.append('CU_Telefono', $('input:hidden[name="CU_Telefono"]').val());
                    formData.append('CU_Correo', $('input:hidden[name="CU_Correo"]').val());
                    //Tabla Proyectos
                    formData.append('CP_Nombre_Proyecto', $('input:text[name="CP_Nombre_Proyecto"]').val());
                    formData.append('CP_Fecha_Inicio', $('#CP_Fecha_Inicio').val());
                    formData.append('FK_CP_Id_Usuario', $('input:hidden[name="FK_CP_Id_Usuario"]').val());
                    //Tabla Equipo Scrum
                    formData.append('CE_Nombre_1', $('input:text[name="CE_Nombre_1"]').val());
                    formData.append('CE_Nombre_2', $('input:text[name="CE_Nombre_2"]').val());
                    formData.append('CE_Nombre_3', $('input:text[name="CE_Nombre_3"]').val());
                    formData.append('CE_Nombre_4', $('input:text[name="CE_Nombre_4"]').val());
                    formData.append('CE_Nombre_5', $('input:text[name="CE_Nombre_5"]').val());
                    formData.append('CE_Nombre_6', $('input:text[name="CE_Nombre_6"]').val());
                    //integrantes adicionales
                    formData.append('CE_Nombre_7', $('input:text[name="integrante_0"]').val());
                    formData.append('CE_Nombre_8', $('input:text[name="integrante_1"]').val());
                    formData.append('CE_Nombre_9', $('input:text[name="integrante_2"]').val());
                    

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
                            if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
                                    $(".content-ajax").load(route);
                            }
                            else{
                                if (request.status === 200 && xhr === 'success') {
                                $('#form_proyecto_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
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
        var form = $('#form_proyecto_create');
        var formRules = {
            CP_Nombre_Proyecto: {required: true, minlength: 3, maxlength: 190, noSpecialCharacters:true, letters:true},
            CP_Fecha_Inicio: {required: true, minlength: 3, maxlength: 20},
            CE_Nombre_1: {required: true, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},
            CE_Nombre_2: {required: true, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},
            CE_Nombre_3: {required: true, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},
            CE_Nombre_4: {required: true, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},
            CE_Nombre_5: {required: true, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},
            CE_Nombre_6: {required: true, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},

            integrante_0: {required: false, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},
            integrante_1: {required: false, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},
            integrante_2: {required: false, minlength: 3, maxlength: 40, noSpecialCharacters:true, letters:true},

        };
        var formMessage = {
            CP_Nombre_Proyecto: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CE_Nombre_1: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CE_Nombre_2: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CE_Nombre_3: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CE_Nombre_4: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CE_Nombre_5: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CE_Nombre_6: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},

            integrante_0: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            integrante_1: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            integrante_2: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},

        };
        FormValidationMd.init(form, formRules, formMessage, createProyecto());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

        // Integrantes equipo scrum
        var integrantes_max = 3;   //maximo de campos
        var x_integrante = 0;
        $('#agregarIntegrante').click (function(e) {
                e.preventDefault();     //prevenir novos clicks
                if (x_integrante < integrantes_max) {
                    $('<div id="campo'+x_integrante+'" class="form-group form-md-line-input">\
                    <div class="input-icon">\
                    <input class="form-control form-control" autofocus="" autocomplete="off" maxlength="40" id="integrante_'+x_integrante+'" name="integrante_'+x_integrante+'" type="text">\
                    <label for="integrante_'+x_integrante+'" class="control-label">Integrante del equipo (adicional):</label>\
                    <span class="help-block"> Digite el nombre del integrante </span>\
                    <i class=" fa fa-user-o "></i>\
                    </div>\
                    </div>').appendTo($('#ListaIntegrantes')).hide().slideDown(600);
                    x_integrante++;
                }else{
                    xhr = "warning"
                    UIToastr.init(xhr, "¡Lo sentimos!", "Máximo puede agregar "+integrantes_max+" integrantes adicionales.");
                }
        });

        $('#eliminarIntegrante').click (function(e) {
            e.preventDefault();
            if(x_integrante==0){
                xhr = "warning"
                UIToastr.init(xhr, "¡Lo sentimos!", "No es posible eliminar más integrantes.");
            }else{
                x_integrante--;
                $("#campo"+x_integrante).slideUp(400, function(){$("#campo"+x_integrante).remove();});
            }
        });
        
      
    });
</script>

