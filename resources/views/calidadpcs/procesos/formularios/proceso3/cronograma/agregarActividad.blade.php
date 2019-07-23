<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Registrar actividad'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
            ],
        ])
        <div class="row">
        <div class="col-md-12 col-md-offset-0">
                <div class="panel-group accordion" id="date-range">
                    <!--Primer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_1"><strong>CMMI:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Nivel de madurez:</strong> 2. <br><br><strong>Meta especifica:</strong> Gestionar los requisitos.<br><br><strong>Propósito:</strong> El propósito de la Gestión de Requisitos (REQM) es gestionar los requisitos de los productos y los componentes de producto del proyecto, y asegurar la alineación entre esos requisitos, y los planes y los productos de trabajo del proyecto.
                                <br><br><strong>Notas introductorias: </strong> Los procesos de gestión de requisitos gestionan todos los requisitos recibidos o generados por el proyecto, incluyendo tanto los requisitos técnicos como los no técnicos, así como los requisitos impuestos al proyecto por la organización. En particular, si se implementa el área de proceso 
                                Desarrollo de Requisitos, sus procesos generarán requisitos de producto y de componente de producto que también serán gestionados por los procesos de gestión de requisitos. En todas las áreas de proceso, cuando se utilizan los términos “producto” y “componente de producto”, sus significados previstos también incluyen los servicios, 
                                los sistemas de servicio y sus componentes. Cuando las áreas de proceso Gestión de Requisitos, Desarrollo de Requisitos y Solución Técnica están implementadas, sus procesos asociados pueden estar estrechamente relacionados y realizarse de manera concurrente. El proyecto realiza los pasos apropiados para asegurar que el conjunto de 
                                requisitos aprobados se gestiona para dar soporte a las necesidades de planificación y de ejecución del proyecto. Cuando un proyecto recibe requisitos de un proveedor de requisitos aprobado, éstos se revisan con dicho proveedor para resolver las cuestiones y para prevenir malentendidos antes de que los requisitos se incorporen en 
                                los planes del proyecto. Una vez que el proveedor y el receptor de los requisitos alcanzan un acuerdo, se obtiene un compromiso sobre los requisitos por parte de los participantes en el proyecto. El proyecto gestiona los cambios a los requisitos a medida que evolucionan e identifica inconsistencias que ocurren entre los planes, los 
                                productos de trabajo y los requisitos.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Segundo acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_2"><strong>SCRUM:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tercer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"><strong>PMBOK:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                    <strong>Gestión de la Integración del Proyecto: </strong>La Gestión de la Integración del Proyecto incluye los procesos y actividades necesarios para identificar, definir, combinar, unificar y coordinar los diversos procesos y actividades de dirección del proyecto dentro de los Grupos de Procesos de la Dirección de Proyectos. 
                                    En el contexto de la dirección de proyectos, la integración incluye características de unificación, consolidación, comunicación y acciones integradoras cruciales para que el proyecto se lleve a cabo de manera controlada, de modo que se complete, que se manejen con éxito las expectativas de los interesados y se cumpla con los 
                                    requisitos. La Gestión de la Integración del Proyecto implica tomar decisiones en cuanto a la asignación de recursos, equilibrar objetivos y alternativas contrapuestas y manejar las interdependencias entre las Áreas de Conocimiento de la dirección de proyectos. Los procesos de la dirección de proyectos se presentan normalmente 
                                    como procesos diferenciados con interfaces definidas, aunque en la práctica se superponen e interactúan entre ellos de formas que no pueden detallarse en su totalidad dentro de la Guía del PMBOK®.<br><br>
                                    <strong>Desarrollar el Acta de Constitución del Proyecto: </strong>Es el proceso de desarrollar un documento que autoriza formalmente la existencia de un proyecto y confiere al director del proyecto la autoridad para asignar los recursos de la organización a las actividades del proyecto.<br><br>
                                    <strong>Gestión de los interesados del proyecto: </strong>La Gestión de los Interesados del Proyecto incluye los procesos necesarios para identificar a las personas, grupos u organizaciones que pueden afectar o ser afectados por el proyecto, para analizar las expectativas de los interesados y su impacto en el proyecto, y para 
                                    desarrollar estrategias de gestión adecuadas a fin de lograr la participación eficaz de los interesados en las decisiones y en la ejecución del proyecto. La gestión de los interesados también se centra en la comunicación continua con los interesados para comprender sus necesidades y expectativas, abordando los incidentes en el 
                                    momento en que ocurren, gestionando conflictos de intereses y fomentando una adecuada participación de los interesados en las decisiones y actividades del proyecto. La satisfacción de los interesados debe gestionarse como uno de los objetivos clave del proyecto.<br><br>
                                    <strong>Identificar a los Interesados: </strong>El proceso de identificar las personas, grupos u organizaciones que podrían afectar o ser afectados por una decisión, actividad o resultado del proyecto, así como de analizar y documentar información relevante relativa a sus intereses, participación, interdependencias, influencia 
                                    y posible impacto en el éxito del proyecto.<br><br>
                                    <strong>Planificar la Gestión de los Interesados: </strong>El proceso de desarrollar estrategias de gestión adecuadas para lograr la participación eficaz de los interesados a lo largo del ciclo de vida del proyecto, con base en el análisis de sus necesidades, intereses y el posible impacto en el éxito del proyecto.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([[$idProceso],[$idProyecto]],['id'=>'form_update_proyecto', 'url' => '/forms']) !!}
                    <div class="form-body">
                        <div class="row">
                        <h3>Informacion del proceso</h3><br>
                            <div class="col-md-6">

                                {!! Field:: hidden ('FK_CP_Id_Usuario', Auth::user()->id)!!}

                                {!! Field:: hidden ('PK_CP_Id_Proyecto', null)!!}

                                {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Nombre de la actividad:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                                {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Recursos:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off',],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
                                {{-- 
                                {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Por quien:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                                {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Alcance:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
                                --}}
                            </div>
                            <div class="col-md-6">
                                
                                {!! Field::date('CP_Fecha_Inicio',['label' => 'Fecha de inicio del proyecto',  'class'=> 'form-control datepicker','auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => 'Digite la fecha de inicio del proyecto', 'icon' => 'fa fa-calendar']) !!}
                                
                                {!! Field::date('CP_Fecha_Final',['label' => 'Fecha final del proyecto', 'class'=> 'form-control datepicker', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],['help' => 'Digite la fecha final del proyecto', 'icon' => 'fa fa-calendar']) !!}
                                
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
                                {{ Form::submit('Guardar', ['class' => 'btn blue']) }}
                                
                                @endpermission
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

    jQuery(document).ready(function () {

        /*Configuracion de input tipo fecha*/
        $('.datepicker').datepicker({
            //rtl: App.isRTL(),
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
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });
        var editarProyecto = function () {
            return {
                init: function () {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso1') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    //var FileMoto = document.getElementById("CM_UrlFoto");
              
                    // var FileProp = document.getElementById("CM_UrlPropiedad");
                    // var FileSOAT = document.getElementById("CM_UrlSoat");
                    /*Tabla Usuarios
                    formData.append('PK_CU_Id_Usuario', $('input:hidden[name="PK_CU_Id_Usuario"]').val());
                    formData.append('CU_Cedula', $('input:hidden[name="CU_Cedula"]').val());
                    formData.append('CU_Nombre', $('input:hidden[name="CU_Nombre"]').val());
                    formData.append('CU_Apellido', $('input:hidden[name="CU_Apellido"]').val());
                    formData.append('CU_Telefono', $('input:hidden[name="CU_Telefono"]').val());
                    formData.append('CU_Correo', $('input:hidden[name="CU_Correo"]').val());*/
                    //Tabla Proyectos
                    //formData.append('PK_CP_Id_Proyecto', $('input:hidden[name="PK_CP_Id_Proyecto"]').val());
                    //formData.append('CP_Nombre_Proyecto', $('input:text[name="CP_Nombre_Proyecto"]').val());
                    //formData.append('CP_Fecha_Inicio', $('#CP_Fecha_Inicio').val());
                    //formData.append('CP_Fecha_Final', $('#CP_Fecha_Final').val());
                    //formData.append('PK_CP_Id_Usuario', $('input:hidden[name="PK_CP_Id_Usuario"]').val());
                    //formData.append('FK_CP_Id_Usuario', $('input:hidden[name="FK_CP_Id_Usuario"]').val());
                    //Tabla Equipo Scrum

                    formData.append('FK_CPP_Id_Proceso', $('input:hidden[name="FK_CPP_Id_Proceso"]').val());
                    formData.append('CE_Nombre_1', $('input:text[name="CE_Nombre_1"]').val());
                    formData.append('CE_Nombre_2', $('input:text[name="CE_Nombre_2"]').val());
                    formData.append('CE_Nombre_3', $('input:text[name="CE_Nombre_3"]').val());
                    formData.append('CE_Nombre_4', $('input:text[name="CE_Nombre_4"]').val());

                    //formData.append('CE_Nombre_5', $('input:text[name="CE_Nombre_5"]').val());
                    //formData.append('CE_Nombre_6', $('input:text[name="CE_Nombre_6"]').val());
                    //formData.append('CE_Nombre_7', $('input:text[name="CE_Nombre_7"]').val());
                    //formData.append('CE_Nombre_8', $('input:text[name="CE_Nombre_8"]').val());
                   
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
                                $('#form_update_proyecto')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
                                location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
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
        var form = $('#form_update_proyecto');
        var formRules = {
            //CM_UrlFoto: {required: false, extension: "jpg|png"},
            CP_Nombre_Proyecto: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CP_Fecha_Inicio: {required: true, minlength: 3, maxlength: 20},
            CP_Fecha_Final: {required: true, minlength: 3, maxlength: 20},
            CE_Nombre_1: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_2: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_3: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_4: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_5: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_6: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_7: {maxlength: 50, required: false, noSpecialCharacters:true, letters:true},
            CE_Nombre_8: {maxlength: 50, required: false, noSpecialCharacters:true, letters:true},
            // CM_NuSoat: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            // CM_FechaSoat: {required: true},
            // CM_UrlPropiedad: {required: false, extension: "jpg|png"},
            // CM_UrlSoat: {required: false, extension: "jpg|png"},
        };
        var formMessage = {
            CP_Nombre_Proyecto: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CP_Nombre_Proyecto: {letters: 'Los numeros no son válidos'},
            CE_Nombre_1: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_1: {letters: 'Los numeros no son válidos'},
            CE_Nombre_2: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_2: {letters: 'Los numeros no son válidos'},
            CE_Nombre_3: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_3: {letters: 'Los numeros no son válidos'},
            CE_Nombre_4: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_4: {letters: 'Los numeros no son válidos'},
            CE_Nombre_5: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_5: {letters: 'Los numeros no son válidos'},
            CE_Nombre_6: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_6: {letters: 'Los numeros no son válidos'},
            CE_Nombre_7: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_7: {letters: 'Los numeros no son válidos'},
            CE_Nombre_8: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_8: {letters: 'Los numeros no son válidos'},
            //CP_fecha_inicio: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            //CP_fecha_final: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            // CM_NuSoat: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, editarProyecto());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
            //$(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
            //$(".content-ajax").load(route);
        });
        /*
         $(".create").on('click', function (e) {
            e.preventDefault();
            var codigo=  $('input:text[name="FK_CP_Codigo"]').val();
            var route = '{{ route('parqueadero.motosCarpark.RegistrarMoto2') }}' + '/' + codigo;
            $(".content-ajax").load(route);
        });*/

    });
</script>