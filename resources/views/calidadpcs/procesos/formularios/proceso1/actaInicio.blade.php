<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Etapa de inicio:'])
    @slot('actions', [
    'link_cancel' => [
    'link' => '',
    'icon' => 'fa fa-arrow-left',
    ],
    ])
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
        <h4 style="margin-top: 0px;">Proceso: Desarrollar acta de constitución del proyecto.</h4>
            <br>
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
                                Roles Scrum que son necesarios para este proceso:<br><strong>Stakeholder: </strong>{{ $equipoScrum[2]['CE_Nombre_Persona'] }}<br><strong>Product Owner: </strong>{{ $equipoScrum[1]['CE_Nombre_Persona'] }}<br><strong>Scrum Master: </strong>{{ $equipoScrum[0]['CE_Nombre_Persona'] }}.
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
            {!! Form::model ([[$idProceso],[$equipoScrum],[$infoProyecto]],['id'=>'form_create_proceso_1', 'url' => '/forms']) !!}
            <div class="form-body">
                <div class="row">
                    <h3><i class="fa fa-arrow-right"></i><strong> Informacion del proyecto</strong></h3><br>
                    <div class="col-md-6">

                        {!! Field:: hidden ('FK_CPP_Id_Proyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}

                        {!! Field:: hidden ('FK_CPP_Id_Proceso', $idProceso) !!}

                        {!! Field:: text('Nombre_Proyecto',$infoProyecto[0]['CP_Nombre_Proyecto'],['label'=>'Nombre de proyecto:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                        {!! Field::select('Duracion en meses:',['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12' ],null,
                            ['name' => 'Duracion']) !!}

                    </div>
                    <div class="col-md-6">

                        {!! Field::date('Fecha_Inicio',$infoProyecto[0]['CP_Fecha_Inicio'],['label' => 'Fecha de inicio', 'class'=> '','auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d",'readonly'],['help' => 'Digite la fecha de inicio del proyecto', 'icon' => 'fa fa-calendar']) !!}

                        {!! Field:: text('Entidades',null,['label'=>'Entidades participantes:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite las entidades participantes.','icon'=>'fa fa-file-text-o'] ) !!}
                        
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <h3><i class="fa fa-arrow-right"></i><strong> Objetivos</strong></h3><br>
                        <div class="col-md-12">
                            {!! Field:: text('Objetivo_General',null,['label'=>'Objetivo General:',  'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                            ['help' => 'Digite el objetivo general.','icon'=>'fa fa-file-text-o'] ) !!}
                        </div>
                        <div class="col-md-12">
                            <h4>Objetivos especificos </h4><br>

                            {!! Field:: text('Objetivo_Especifico_1',['label'=>'Objetivo especifico:', 'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                            ['help' => 'Digite el objetivo especifico','icon'=>'fa fa-angle-right'] ) !!}

                            {!! Field:: text('Objetivo_Especifico_2',['label'=>'Objetivo especifico:', 'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                            ['help' => 'Digite el objetivo especifico','icon'=>'fa fa-angle-right'] ) !!}
                        </div>
                        <div class="col-md-12" id="objetivos">

                        </div>
                        <div class="col-md-12">
                            <hr>
                            <a class="btn btn-outline blue btn-xs" id="agregarObjetivo"><i class="fa fa-plus"></i> Agregar objetivo</a>
                            <a class="btn btn-outline red btn-xs" id="remover_objetivo"><i class="fa fa-times"></i> Eliminar objetivo</a>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <h3><i class="fa fa-arrow-right"></i><strong> Requisitos</strong></h3><br>

                        {!! Field:: text('CPR_Nombre_Requerimiento_1',['label'=>'Nombre del requisito:', 'max' => '100', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el requisito','icon'=>'fa fa-angle-right'] ) !!}

                        {!! Field:: text('CPR_Nombre_Requerimiento_2',['label'=>'Nombre del requisito:', 'max' => '100', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el requisito','icon'=>'fa fa-angle-right'] ) !!}

                        {!! Field:: text('CPR_Nombre_Requerimiento_3',['label'=>'Nombre del requisito:', 'max' => '100', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el requisito','icon'=>'fa fa-angle-right'] ) !!}

                        {!! Field:: text('CPR_Nombre_Requerimiento_4',['label'=>'Nombre del requisito:', 'max' => '100', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el requisito','icon'=>'fa fa-angle-right'] ) !!}

                        {!! Field:: text('CPR_Nombre_Requerimiento_5',['label'=>'Nombre del requisito:', 'max' => '100', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el requisito','icon'=>'fa fa-angle-right'] ) !!}

                    </div>
                    <div class="col-md-12" id="ListaRequisitos">

                    </div>
                    <div class="col-md-12">
                        <hr>
                        <a class="btn btn-outline blue btn-xs" id="agregarRequisito"><i class="fa fa-plus"></i> Agregar requisito</a>
                        <a class="btn btn-outline red btn-xs" id="eliminarRequisito"><i class="fa fa-times"></i> Eliminar requisito</a>
                    </div>
                </div>
                <div class="row">
                    <h3><i class="fa fa-arrow-right"></i><strong> Informacion de los roles Scrum</strong></h3><br>

                    <div class="col-md-6">

                        {!! Field:: text('CE_Nombre_1',$equipoScrum[0]['CE_Nombre_Persona'],['label'=>'Scrum Master:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                        ['help' => '','icon'=>'fa fa-user'] ) !!}

                        {!! Field:: text('CE_Nombre_4',$equipoScrum[3]['CE_Nombre_Persona'],['label'=>'Lider del Equipo Scrum:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                        ['help' => '','icon'=>'fa fa-users'] ) !!}

                    </div>
                    <div class="col-md-6">
                        {!! Field:: text('CE_Nombre_2',$equipoScrum[1]['CE_Nombre_Persona'],['label'=>'Product Owner:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                        ['help' => '','icon'=>'fa fa-user'] ) !!}
                        @if(empty($equipoScrum[2]['CE_Nombre_Persona']))
                        {!! Field:: text('CE_Nombre_3',null,['label'=>'Stakeholder:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                        ['help' => '','icon'=>'fa fa-user'] ) !!}
                        @else
                        {!! Field:: text('CE_Nombre_3',$equipoScrum[2]['CE_Nombre_Persona'],['label'=>'Stakeholder:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                        ['help' => '','icon'=>'fa fa-user'] ) !!}
                        @endif
                    </div>

                    <div class="col-md-12">
                        <h3>Integrantes del equipo </h3>
                        <hr>
                        {!! Field:: text('CE_Nombre_5',$equipoScrum[4]['CE_Nombre_Persona'],['label'=>'Integrante del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                        ['help' => '','icon'=>'fa fa-user-o'] ) !!}

                        {!! Field:: text('CE_Nombre_6',$equipoScrum[5]['CE_Nombre_Persona'],['label'=>'Integrante del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                        ['help' => '','icon'=>'fa fa-user-o'] ) !!}

                    </div>
                    <div class="col-md-12" id="ListaIntegrantes">
                        @if(empty($equipoScrum[6]['CE_Nombre_Persona']))

                        @else
                        <div id="campo7">
                            {!! Field:: text('CE_Nombre_7',$equipoScrum[6]['CE_Nombre_Persona'],['label'=>'Integrante del equipo (opcional):', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}
                        </div>
                        @endif
                        @if(empty($equipoScrum[7]))

                        @else
                        <div id="campo8">
                            {!! Field:: text('CE_Nombre_8',$equipoScrum[7]['CE_Nombre_Persona'],['label'=>'Integrante del equipo (opcional):', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}
                        </div>
                        @endif
                        @if(empty($equipoScrum[8]))

                        @else
                        <div id="campo9">
                            {!! Field:: text('CE_Nombre_9',$equipoScrum[8]['CE_Nombre_Persona'],['label'=>'Integrante del equipo (opcional):', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                        @permission('CALIDADPCS_CREATE_PROJECT')<a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
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
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });
       
        var editarProyecto = function() {
            return {
                init: function() {
                    var route = "{{route('calidadpcs.procesosCalidad.storeProceso')}}";
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();

                    //Tabla Proyecto Proceso
                    formData.append('FK_CPP_Id_Proyecto', $('input:hidden[name="FK_CPP_Id_Proyecto"]').val());
                    formData.append('FK_CPP_Id_Proceso', $('input:hidden[name="FK_CPP_Id_Proceso"]').val());
                    //Info del proceso
                    formData.append('Fecha_Inicio', $('#Fecha_Inicio').val());
                    formData.append('Duracion', $('select[name="Duracion"]').val());
                    formData.append('Entidades', $('input:text[name="Entidades"]').val());
                    // Objetivo general
                    formData.append('Objetivo_General', $('input:text[name="Objetivo_General"]').val());
                    // Objetivos especificos
                    formData.append('Objetivo_Especifico_1', $('input:text[name="Objetivo_Especifico_1"]').val());
                    formData.append('Objetivo_Especifico_2', $('input:text[name="Objetivo_Especifico_2"]').val());
                    formData.append('Objetivo_Especifico_3', $('input:text[name="Objetivo_Especifico_3"]').val());
                    formData.append('Objetivo_Especifico_4', $('input:text[name="Objetivo_Especifico_4"]').val());
                    formData.append('Objetivo_Especifico_5', $('input:text[name="Objetivo_Especifico_5"]').val());
                    // requerimientos
                    formData.append('CPR_Nombre_Requerimiento_1', $('input:text[name="CPR_Nombre_Requerimiento_1"]').val());
                    formData.append('CPR_Nombre_Requerimiento_2', $('input:text[name="CPR_Nombre_Requerimiento_2"]').val());
                    formData.append('CPR_Nombre_Requerimiento_3', $('input:text[name="CPR_Nombre_Requerimiento_3"]').val());
                    formData.append('CPR_Nombre_Requerimiento_4', $('input:text[name="CPR_Nombre_Requerimiento_4"]').val());
                    formData.append('CPR_Nombre_Requerimiento_5', $('input:text[name="CPR_Nombre_Requerimiento_5"]').val());
                    formData.append('CPR_Nombre_Requerimiento_6', $('input:text[name="CPR_Nombre_Requerimiento_6"]').val());
                    formData.append('CPR_Nombre_Requerimiento_7', $('input:text[name="CPR_Nombre_Requerimiento_7"]').val());
                    formData.append('CPR_Nombre_Requerimiento_8', $('input:text[name="CPR_Nombre_Requerimiento_8"]').val());
                    formData.append('CPR_Nombre_Requerimiento_9', $('input:text[name="CPR_Nombre_Requerimiento_9"]').val());
                    formData.append('CPR_Nombre_Requerimiento_10', $('input:text[name="CPR_Nombre_Requerimiento_10"]').val());
                    formData.append('CPR_Nombre_Requerimiento_11', $('input:text[name="CPR_Nombre_Requerimiento_11"]').val());
                    formData.append('CPR_Nombre_Requerimiento_12', $('input:text[name="CPR_Nombre_Requerimiento_12"]').val());
                    formData.append('CPR_Nombre_Requerimiento_13', $('input:text[name="CPR_Nombre_Requerimiento_13"]').val());
                    formData.append('CPR_Nombre_Requerimiento_14', $('input:text[name="CPR_Nombre_Requerimiento_14"]').val());
                    formData.append('CPR_Nombre_Requerimiento_15', $('input:text[name="CPR_Nombre_Requerimiento_15"]').val());


                    console.log(formData);

                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function() {
                            App.blockUI({
                                target: '.portlet-form',
                                animate: true
                            });
                        },
                        success: function(response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_create_proceso_1')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = "{{route('calidadpcs.proyectosCalidad.index.ajax')}}";
                                location.href = "{{route('calidadpcs.proyectosCalidad.index')}}";
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form = $('#form_create_proceso_1');
        var formRules = {
            Duracion: {required: true},
            Entidades: {required: false, minlength: 3, maxlength: 50, noSpecialCharacters:true, letters:false},
            Objetivo_General:{required: true, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false},
            Objetivo_Especifico_1:{required: true, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false},
            Objetivo_Especifico_2:{required: true, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false},
            Objetivo_Especifico_3:{required: false, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false},
            Objetivo_Especifico_4:{required: false, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false},
            Objetivo_Especifico_5:{required: false, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_1:{required: true, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_2:{required: true, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_3:{required: true, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_4:{required: true, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_5:{required: true, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_6:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_7:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_8:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_9:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_10:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_11:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_12:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_13:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_14:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
            CPR_Nombre_Requerimiento_15:{required: false, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false},
        };
        var formMessage = {
            Entidades: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Objetivo_General: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Objetivo_Especifico_1: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Objetivo_Especifico_2: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Objetivo_Especifico_3: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Objetivo_Especifico_4: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Objetivo_Especifico_5: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_1: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_2: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_3: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_4: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_5: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_6: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_7: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_8: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_9: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_10: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_11: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_12: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_13: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_14: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            CPR_Nombre_Requerimiento_15: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, editarProyecto());

        $(".pmd-select2").select2({
                width: '100%',
                placeholder: "Selecccionar",
        });

        $('.button-cancel').on('click', function(e) {
            e.preventDefault();
            var route = "{{route('calidadpcs.proyectosCalidad.index.ajax')}}";
            location.href = "{{route('calidadpcs.proyectosCalidad.index')}}";
        });

        $("#link_cancel").on('click', function(e) {
            var route = "{{route('calidadpcs.proyectosCalidad.index.ajax')}}";
            location.href = "{{route('calidadpcs.proyectosCalidad.index')}}";
        });

        //objetivos
        var objetivos_max = 6; //maximo de campos
        var x_objetivo = 3;
        $('#agregarObjetivo').click(function(e) {
            e.preventDefault(); //prevenir novos clicks
            if (x_objetivo < objetivos_max) {
                $('<div id="objetivo' + x_objetivo + '" class="form-group form-md-line-input">\
                    <div class="input-icon">\
                    <input class="form-control form-control" autofocus="" autocomplete="off" maxlength="100" id="Objetivo_Especifico_' + x_objetivo + '" name="Objetivo_Especifico_' + x_objetivo + '" type="text">\
                    <label for="Objetivo_Especifico_' + x_objetivo + '" class="control-label">Objetivo especifico (adicional):</label>\
                    <span class="help-block"> Digite el requisito</span>\
                    <i class=" fa fa-angle-right "></i>\
                    </div>\
                    </div>').appendTo($('#objetivos')).hide().slideDown(600);
                x_objetivo++;
            } else {
                xhr = "warning"
                UIToastr.init(xhr, "¡Lo sentimos!", "Maximo puede agregar objetivos adicionales.");
            }
        });
        $('#remover_objetivo').click(function(e) {
            e.preventDefault();
            if (x_objetivo == 3) {
                xhr = "warning"
                UIToastr.init(xhr, "¡Lo sentimos!", "No es posible eliminar mas objetivos.");
            } else {
                x_objetivo--;
                $("#objetivo" + x_objetivo).slideUp(400, function() {
                    $("#objetivo" + x_objetivo).remove();
                });
            }
        });
        // Requisitos
        var requisitos_max = 16; //maximo de campos
        var x_requisitos = 6;
        $('#agregarRequisito').click(function(e) {
            e.preventDefault(); //prevenir novos clicks
            if (x_requisitos < requisitos_max) {
                $('<div id="requisito' + x_requisitos + '" class="form-group form-md-line-input">\
                    <div class="input-icon">\
                    <input class="form-control form-control" autofocus="" autocomplete="off" maxlength="100" id="CPR_Nombre_Requerimiento_' + x_requisitos + '" name="CPR_Nombre_Requerimiento_' + x_requisitos + '" type="text">\
                    <label for="CPR_Nombre_Requerimiento_' + x_requisitos + '" class="control-label">Nombre del requisito (adicional):</label>\
                    <span class="help-block"> Digite el requisito</span>\
                    <i class=" fa fa-angle-right "></i>\
                    </div>\
                    </div>').appendTo($('#ListaRequisitos')).hide().slideDown(600);
                x_requisitos++;
            } else {
                xhr = "warning"
                UIToastr.init(xhr, "¡Lo sentimos!", "Maximo puede agregar más requisitos adicionales.");
            }
        });
        $('#eliminarRequisito').click(function(e) {
            e.preventDefault();
            if (x_requisitos == 6) {
                xhr = "warning"
                UIToastr.init(xhr, "¡Lo sentimos!", "No es posible eliminar mas requisitos.");
            } else {
                x_requisitos--;
                $("#requisito" + x_requisitos).slideUp(400, function() {
                    $("#requisito" + x_requisitos).remove();
                });
            }
        });
    });
</script>