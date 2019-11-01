<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de cierre:'])
    <h4 style="margin-top: 0px;">Proceso: Cerrar el proyecto y las adquisiciones.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Enfoque en procesos de la organización.<br><strong>Propósito: </strong>El propósito de Enfoque en 
                                Procesos de la Organización (OPF) es planificar, implementar y desplegar las mejoras de proceso de la organización, basadas en una comprensión completa de las fortalezas y debilidades 
                                actuales de los procesos y de los activos de proceso de la organización.<br><br><strong>Notas introductorias: </strong>Los procesos de la organización incluyen todos los procesos 
                                utilizados por la organización y sus proyectos. Las mejoras candidatas a los procesos y a los activos de proceso de la organización se obtienen de diferentes fuentes, incluyendo la 
                                medición de procesos, las lecciones aprendidas en la implementación de procesos, los resultados de las evaluaciones de proceso, los resultados de las actividades de evaluación de productos 
                                y servicios, los resultados de las evaluaciones de satisfacción del cliente, los resultados de benchmarking frente a procesos de otras organizaciones, y las recomendaciones de otras 
                                iniciativas de mejora en la organización. La mejora de procesos tiene lugar en el contexto de las necesidades de la organización y se utiliza para abordar los objetivos de la organización. 
                                La organización promueve la participación en actividades de mejora de procesos de aquellos que realizan el proceso. La responsabilidad de facilitar y gestionar las actividades de mejora de 
                                procesos de la organización, incluyendo la coordinación de la participación de otros, se asigna normalmente a un grupo de procesos. La organización proporciona el compromiso a largo plazo y 
                                los recursos requeridos para patrocinar este grupo y asegurar el despliegue eficaz y oportuno de las mejoras.<br><br>Determinar las oportunidades de mejora de procesos.<br>- Establecer las 
                                necesidades de proceso de la organización.<br>- Evaluar los procesos de la organización.<br>- Identificar las mejoras de procesos de la organización.
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
                                    Roles Scrum que son necesarios para este proceso:<br><strong>Scrum Master:</strong>{{$equipoScrum[0]['CE_Nombre_Persona'] }}.<br><strong>Equipo desarrollo</strong>
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
                                <strong>Proceso:</strong> Cerrar el Proyecto y las Adquisiciones.<br><br><strong>Cerrar las Adquisiciones: </strong>El proceso de finalizar cada adquisición para el proyecto.
                                <br><br>La Gestión de la Integración del Proyecto incluye los procesos y actividades necesarios para identificar, definir, combinar, unificar y coordinar los diversos procesos 
                                y actividades de dirección del proyecto dentro de los Grupos de Procesos de la Dirección de Proyectos. En el contexto de la dirección de proyectos, la integración incluye 
                                características de unificación, consolidación, comunicación y acciones integradoras cruciales para que el proyecto se lleve a cabo de manera controlada, de modo que se complete, 
                                que se manejen con éxito las expectativas de los interesados y se cumpla con los requisitos. La Gestión de la Integración del Proyecto implica tomar decisiones en cuanto a la 
                                asignación de recursos, equilibrar objetivos y alternativas contrapuestas y manejar las interdependencias entre las Áreas de Conocimiento de la dirección de proyectos. Los procesos 
                                de la dirección de proyectos se presentan normalmente como procesos diferenciados con interfaces definidas, aunque en la práctica se superponen e interactúan entre ellos de formas 
                                que no pueden detallarse en su totalidad dentro de la Guía del PMBOK®.<br><br><strong>Cerrar el Proyecto o Fase: </strong>Es el proceso que consiste en finalizar todas las actividades 
                                en todos los Grupos de Procesos de la Dirección de Proyectos para completar formalmente el proyecto o una fase del mismo.<br><br>La Gestión de las Adquisiciones del Proyecto incluye los 
                                procesos necesarios para comprar o adquirir productos, servicios o resultados que es preciso obtener fuera del equipo del proyecto. La organización puede ser la compradora o vendedora de 
                                los productos, servicios o resultados de un proyecto.<br><br>La Gestión de las Adquisiciones del Proyecto incluye los procesos de gestión del contrato y de control de cambios requeridos 
                                para desarrollar y administrar contratos u órdenes de compra emitidos por miembros autorizados del equipo del proyecto.<br><br>La Gestión de las Adquisiciones del Proyecto también incluye 
                                el control de cualquier contrato emitido por una organización externa (el comprador) que esté adquiriendo entregables del proyecto a la organización ejecutora (el vendedor), así como la 
                                administración de las obligaciones contractuales contraídas por el equipo del proyecto en virtud del contrato.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'TablaObjetivos'])
            @slot('columns', [
            '#',
            'Objetivo',
            'Tipo',
            'Estado'
            ])
            @endcomponent
        </div>
    </div>
    <br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'TablaScrum'])
            @slot('columns', [
            '#',
            'Nombre',
            'Rol',
            'Estado',
            ''
            ])
            @endcomponent
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

        var table2, url2, columns2;
        table2 = $('#TablaObjetivos');
        url2 = "{{ route('calidadpcs.procesosCalidad.tablaproceso16')}}"+"/"+ {{$idProyecto}};
        columns2 = [{
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
                data: 'Estado',
                name: 'Estado'
            }
        ];
        dataTableServer.init(table2, url2, columns2);
        table2 = table2.DataTable();

        var table, url, columns;
        table = $('#TablaScrum');
        url = "{{ route('calidadpcs.procesosCalidad.tablaproceso25')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CE_Nombre_Persona',
                name: 'CE_Nombre_Persona'
            },
            {
                data: 'Rol',
                name: 'Rol'
            },
            {
                data: 'Estado',
                name: 'Estado'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Cambiar el estado del integrante" ><i class="fa fa-exchange"></i></a>',
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

        table.on('click', '.verEtapas', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();

            var route = '{{ route('calidadpcs.procesosCalidad.storeProceso25') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('idIntegrante', dataTable.PK_CE_Id_Equipo_Scrum);
                    formData.append('Estado', dataTable.CE_Estado);
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
                                    table.ajax.reload();
                                    // location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
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

        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso25_1') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('id_Proyecto', {{$idProyecto}});
                    formData.append('id_Proceso', {{$idProceso}});
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
        

    });
</script> 