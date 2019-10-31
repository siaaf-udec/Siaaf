<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
    <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Proceso: Planificar la gestión de la calidad.</h4>
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
                                <strong>Nivel de madurez:</strong> 2. <br><br><strong>Meta especifica:</strong> Medición y análisis. <br><br><strong>Propósito:</strong>El propósito de Medición y Análisis (MA) 
                                es desarrollar y mantener la capacidad de medición utilizada para dar soporte a las necesidades de información de la gerencia.<br><br><strong>Notas introductorias: </strong>
                                El área de proceso Medición y Análisis implica las siguientes actividades:<br> Especificar los objetivos de medición y análisis para alinearlos con las necesidades de información 
                                y con los objetivos del proyecto, de la organización o del negocio.<br>Especificar las medidas, las técnicas de análisis y los mecanismos, para la recogida de datos, almacenamiento 
                                de datos, difusión y realimentación. <br>Implementar las técnicas de análisis y los mecanismos para la recogida de datos, difusión de datos y realimentación.<br>Proporcionar 
                                resultados objetivos que puedan utilizarse en la toma de decisiones informadas y en la toma de acciones correctivas apropiadas.<br><br><h4>DESARROLLO DE REQUISITOS</h4><br>
                                <strong>Nivel de madurez:</strong> 3. <br><br><strong>Propósito:</strong> El propósito del Desarrollo de Requisitos (RD) es educir, analizar y establecer los requisitos de cliente,
                                de producto y de componente de producto.<br><br><strong>Notas introductorias</strong>Éste área de proceso describe tres tipos de requisitos: de cliente, de producto y de componente 
                                de producto. Tomados en conjunto, estos requisitos tratan las necesidades de las partes interesadas relevantes, incluyendo las necesidades pertinentes a las diferentes fases del 
                                ciclo de vida del producto (p. ej., criterios de pruebas de aceptación) y a los atributos del producto (p. ej., capacidad de respuesta, protección, fiabilidad, capacidad de mantenimiento). 
                                Los requisitos también tratan las restricciones causadas por la selección de soluciones de diseño (p. ej., integración de productos disponibles comercialmente (COTS), o uso de un patrón 
                                particular de arquitectura). Todos los proyectos de desarrollo tienen requisitos. Los requisitos son la base para el diseño. El desarrollo de los requisitos incluye las siguientes 
                                actividades:<br>•	Educción, análisis, validación y comunicación de las necesidades, las expectativas y las restricciones del cliente para obtener los requisitos priorizados de cliente 
                                que constituyen una comprensión de lo que satisfará a las partes interesadas. <br>•	Recopilación y coordinación de las necesidades de las partes interesadas.<br>•	Desarrollo de los 
                                requisitos del ciclo de vida del producto.<br>•	Establecimiento de los requisitos funcionales de cliente y de los requisitos de los atributos de calidad.<br>•	Establecimiento de los 
                                requisitos iniciales de producto y de componente de producto consistentes con los requisitos de cliente.
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
                                    Roles Scrum que son necesarios para este proceso:<br><strong>Product Owner: </strong>{{ $equipoScrum[1]['CE_Nombre_Persona'] }}<br><strong>Scrum Master:</strong> 
                                    {{$equipoScrum[0]['CE_Nombre_Persona'] }}.<br><br><strong>Equipo desarrollo</strong>
                                    @foreach ($integrantes_equipo as $integrante)
                                    <br><strong>Integrante: </strong> {{$integrante->CE_Nombre_Persona}}
                                    @endforeach
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
                                    <strong>Proceso:</strong> Desarrollar plan para la dirección del proyecto.<br><br>Es el proceso de definir, preparar y coordinar todos los planes secundarios e incorporarlos 
                                    en un plan integral para la dirección del proyecto. Las líneas base y planes secundarios integrados del proyecto pueden incluirse dentro del plan para la dirección del proyecto.
                                    <br><br><strong>Procesos:</strong> Planificar la gestión del alcance, recopilar requisitos, definir el alcance, crear la estructura de división de trabajo EDT/WBS<br><br>
                                    <strong>Planificar la Gestión del Alcance:</strong>Es el proceso de crear un plan de gestión del alcance que documente cómo se va a definir, validar y controlar el alcance del proyecto.<br>
                                    <strong>Recopilar Requisitos: </strong>Es el proceso de determinar, documentar y gestionar las necesidades y los requisitos de los interesados para cumplir con los objetivos del proyecto.<br>
                                    <strong>Definir el Alcance:</strong> Es el proceso de desarrollar una descripción detallada del proyecto y del producto.<br><strong>Crear la EDT/WBS:</strong>Es el proceso de subdividir los 
                                    entregables y el trabajo del proyecto en componentes más pequeños y más fáciles de manejar.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <br><br>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
            @slot('columns', [
            '#',
            'Nombre Sprint',
            'Requerimientos',
            'Responsables',
            'Entrega',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal-create-permission" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Agregar Entrega</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('FK_CPP_Id_Proyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}


                                    {!! Field:: hidden ('PK_CPC_Id_Sprint', null)!!}

                                    {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-tag'] ) !!}

                                    {!! Field:: text('Requerimientos',null,['label'=>'Requerimientos:','class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-sliders'] ) !!}

                                    {!! Field:: text('Responsables',null,['label'=>'Responsables:',  'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-users'] ) !!}
                                    
                                    {!! Field:: text('CPC_Entregable',null,['label'=>'Tareas a realizar :', 'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite las tareas que se van a cumplir en el sprint.', 'icon' => 'fa fa-file-text-o']) !!}
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
    <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                        <a href="javascript:;" class="btn btn-success guardarProceso">
                            Continuar <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaGestionCalidad')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPC_Nombre_Sprint',
                name: 'CPC_Nombre_Sprint'
            },
            {
                data: 'RequerimientoNombre',
                name: 'RequerimientoNombre'
            },
            {
                data: 'RecursoNombre',
                name: 'RecursoNombre'
            },
            {
                data: 'CPC_Entregable',
                name: 'CPC_Entregable'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success agregar"  title="Agregar entrega a este sprint" ><i class="fa fa-plus"></i></a>',
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

        table.on('click', '.agregar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('calidadpcs.procesosCalidad.agregarEntrega') }}'+ '/'+ dataTable.PK_CPC_Id_Sprint;

            $.get( route_edit, function( info ) {
                $('input[name="PK_CPC_Id_Sprint"]').val(info.data.PK_CPC_Id_Sprint);
                $('input[name="CPC_Nombre_Sprint"]').val(info.data.CPC_Nombre_Sprint);
                $('input[name="Requerimientos"]').val(info.data.requerimientos);
                $('input[name="Responsables"]').val(info.data.responsables);
                $('input[name="CPC_Entregable"]').val(info.data.CPC_Entregable);
                $('#modal-create-permission').modal('toggle');
            });
        });

        var createModal = function () {
            return{
                init: function () {
                    var id_sprint =  $('input:hidden[name="PK_CPC_Id_Sprint"]').val();
                    var route = '{{ route('calidadpcs.procesosCalidad.updateProceso5') }}'+'/'+ id_sprint;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('CPC_Entregable', $('input:text[name="CPC_Entregable"]').val());
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                // table.ajax.reload();
                                table.ajax.reload();
                                $('#modal-create-permission').modal('hide');
                                $('#form_permissions_update')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_create_modal = $('#form_permissions_update');
        var rules_create_modal = {
            CPC_Entregable: { required: true, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false },
        };
        var formMessage = {
            CPC_Entregable: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,formMessage,createModal());
    });

    $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso5') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('FK_CPP_Id_Proyecto', {{$idProyecto}});
                    formData.append('FK_CPP_Id_Proceso', {{$idProceso}});
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
                        success: function(response, xhr, request) {
                            if (response.data == 422) {
                                xhr = "warning"
                                UIToastr.init(xhr, response.title, response.message);
                            } else {
                                if (request.status === 200 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
                                }
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

</script>