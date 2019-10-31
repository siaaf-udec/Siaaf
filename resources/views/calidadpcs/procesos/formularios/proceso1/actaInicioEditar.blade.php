<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Etapa de inicio'])
    @slot('actions', [
    'link_cancel' => [
    'link' => '',
    'icon' => 'fa fa-arrow-left',
    ],
    ])
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <h4 style="margin-top: 0px;">Editar proceso: Desarrollar acta de constitución del proyecto.</h4>
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
    </div>


    <div class="col-md-10 col-md-offset-1">
        {!! Form::model ([[$idProceso],[$equipoScrum],[$infoProyecto]],['id'=>'form_update_proyecto', 'url' => '/forms']) !!}
        <div class="form-body">
            <div class="row">
                <h3>Informacion del proyecto</h3><br>
                <div class="col-md-6">

                    {!! Field:: hidden ('FK_CPP_Id_Proyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}

                    {!! Field:: hidden ('FK_CPP_Id_Proceso', $idProceso) !!}

                    {!! Field:: text('Nombre_Proyecto',$infoProyecto[0]['CP_Nombre_Proyecto'],['label'=>'Nombre de proyecto:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                    ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                    {!! Field:: text('Duracion',$infoProyecto[0]['CP_Duracion'],['label'=>'Duracion en meses:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                    ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                </div>
                <div class="col-md-6">

                    {!! Field::date('Fecha_Inicio',$infoProyecto[0]['CP_Fecha_Inicio'],['label' => 'Fecha de inicio', 'class'=> '','auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d",'readonly'],
                    ['help' => 'Digite la fecha de inicio del proyecto', 'icon' => 'fa fa-calendar']) !!}


                    {!! Field:: text('Entidades',$infoProyecto[0]['CP_Entidades'],['label'=>'Entidades participantes:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                    ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                </div>
            </div>
            <div class="row">
                <h3><i class="fa fa-arrow-right"></i><strong>Objetivos</strong></h3><br>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Crear un nuevo proyecto"><i class="glyphicon glyphicon-plus"></i>Agregar objetivo</a>
                </div><br>
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
                    @slot('columns', [
                    '#',
                    'Objetivo',
                    'Tipo',
                    ''
                    ])
                    @endcomponent
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
                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                    {{ Form::submit('Actualizar', ['class' => 'btn blue']) }}
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_objetivo" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_objetivo', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h4>Agregar objetivo especifico</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: text('Objetivo',null,['label'=>'Objetivo:', 'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del objetivo.', 'icon' => 'fa fa-tag'] ) !!}

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_objetivo_editar" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_objetivo_editar', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h4>Editar objetivo especifico</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('idObjetivo') !!}

                                    {!! Field:: text('Objetivo_editar',null,['label'=>'Objetivo:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del objetivo.', 'icon' => 'fa fa-tag'] ) !!}

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Actualizar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
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
<script type="text/javascript">
    jQuery(document).ready(function() {

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaproceso16')}}" + "/" + {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CO_Objetivo',
                name: 'CO_Objetivo'
            },
            {
                data: 'Tipo_Objetivo',
                name: 'Tipo_Objetivo'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-sm btn-info editar"  title="Editar este objetivo" ><i class="fa fa-pencil-square-o"></i></a>  <a href="javascript:;" class="btn btn-sm btn-danger eliminar"  title="Eliminar este objetivo" ><i class="fa fa-trash-o"></i></a>',
                data: 'action',
                name: 'Acciones',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        var editarProyecto = function() {
            return {
                init: function() {
                    var route = '{{ route('calidadpcs.procesosCalidad.updateProceso1') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();

                    formData.append('FK_CPP_Id_Proyecto', $('input:hidden[name="FK_CPP_Id_Proyecto"]').val());
                    formData.append('FK_CPP_Id_Proceso', $('input:hidden[name="FK_CPP_Id_Proceso"]').val());
                    formData.append('Entidades', $('input:text[name="Entidades"]').val());

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
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_update_proyecto')[0].reset(); //Limpia formulario
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
        var form = $('#form_update_proyecto');
        var formRules = {
            Entidades: {
                required: false,
                minlength: 3,
                maxlength: 50,
                noSpecialCharacters: true,
                letters: false
            },
        };
        var formMessage = {
            Entidades: {
                noSpecialCharacters: 'Existen caracteres que no son válidos',
                letters: 'Los numeros no son válidos'
            },
        };
        FormValidationMd.init(form, formRules, formMessage, editarProyecto());

        $(".create").on('click', function(e) {
            e.preventDefault();
            $('#modal_objetivo').modal('toggle');
        });

        var createModal = function() {
            return {
                init: function() {
                    var route = "{{ route('calidadpcs.procesosCalidad.storeObjetivo') }}";
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();

                    formData.append('Objetivo', $('input:text[name="Objetivo"]').val());
                    formData.append('idProyecto', {{$idProyecto}});

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

                        },
                        success: function(response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal_objetivo').modal('hide');
                                $('#form_objetivo')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_create_modal = $('#form_objetivo');
        var rules_create_modal = {
            Objetivo: {
                required: true,
                minlength: 3,
                maxlength: 300,
                noSpecialCharacters: true,
                letters: false
            },
        };
        var message_create_modal = {
            Objetivo: {
                noSpecialCharacters: 'Existen caracteres que no son válidos',
                letters: 'Los numeros no son válidos'
            },
        };
        FormValidationMd.init(form_create_modal, rules_create_modal, message_create_modal, createModal());

        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idObjetivo"]').val(dataTable.PK_CO_Id_Objetivo);
            $("#Objetivo_editar").val(dataTable.CO_Objetivo);
            $('#modal_objetivo_editar').modal('toggle');
        });

        var EditModal = function() {
            return {
                init: function() {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateObjetivo') }}";
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();

                    formData.append('idObjetivo', $('input:hidden[name="idObjetivo"]').val());
                    formData.append('Objetivo', $('input:text[name="Objetivo_editar"]').val());
                    formData.append('idProyecto', {{$idProyecto}});

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
                        beforeSend: function() {},
                        success: function(response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal_objetivo_editar').modal('hide');
                                $('#form_objetivo_editar')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_edit_modal = $('#form_objetivo_editar');
        var rules_edit_modal = {
            Objetivo_editar: {
                required: true,
                minlength: 3,
                maxlength: 300,
                noSpecialCharacters: true,
                letters: false
            },
        };
        var message_edit_modal = {
            Objetivo_editar: {
                noSpecialCharacters: 'Existen caracteres que no son válidos',
                letters: 'Los numeros no son válidos'
            },
        };
        FormValidationMd.init(form_edit_modal, rules_edit_modal, message_edit_modal, EditModal());


        table.on('click', '.eliminar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            if (dataTable.CO_Tipo_Objetivo == 1) {
                xhr = "warning"
                UIToastr.init(xhr, "¡Lo sentimos!", "El objetivo general, no se puede eliminar.");
            } else {
                var route = "{{route('calidadpcs.procesosCalidad.deleteObjetivo')}}" + "/" + dataTable.PK_CO_Id_Objetivo;
                var type = 'DELETE';
                var async = async ||false;
                swal({
                        title: "¿Está seguro?",
                        text: "¿Está seguro de eliminar el objetivo seleccionado?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "De acuerdo",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: true,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: route,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                cache: false,
                                type: type,
                                contentType: false,
                                processData: false,
                                async: async,
                                success: function(response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        table.ajax.reload();
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                },
                                error: function(response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        } else {
                            swal("Cancelado", "No se eliminó ningun requerimiento", "error");
                        }
                    });
            }
        });

        $('.button-cancel').on('click', function(e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax')}}';
            location.href = "{{route('calidadpcs.proyectosCalidad.index')}}";
        });

        $("#link_cancel").on('click', function(e) {
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href = "{{route('calidadpcs.proyectosCalidad.index')}}";
        });
    });
</script>