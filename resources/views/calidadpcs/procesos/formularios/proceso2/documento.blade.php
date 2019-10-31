<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Etapa de planificacion:'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
            ],
        ])
        <div class="row">
        <div class="col-md-12 col-md-offset-0">
        <h4 style="margin-top: 0px;">Proceso: Desarrollar plan para la dirección del proyecto.</h4>
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
                                    @foreach ($integrantes as $integrante)
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

            <div class="col-md-10 col-md-offset-1">
                {!! Form::model([[$idProceso],[$equipoScrum],[$idProyecto],[$integrantes]],['id'=>'form_update_proyecto', 'url' => '/forms']) !!}
                    <div class="form-body">
                        <div class="row">
                            <h3>Informacion del proceso</h3><br>
                                <div class="col-md-12">

                                    {!! Field:: hidden ('PK_CP_Id_Proyecto', $idProyecto)!!}

                                    {!! Field:: hidden ('PK_CP_Id_Proceso', $idProceso)!!}

                                    {!! Field::textArea('Alcance',['label' => 'Alcance:', 'required', 'auto' => 'off', 'max' => '500', "rows" => '2'],
                                        ['help' => 'Escribe el alcance del proyecto.', 'icon' => 'fa fa-quote-right']) !!}
                                </div>
                        </div><br>
                        <div class="row">
                            <h3>Requerimientos</h3>
                            <br>
                            <div class="col-md-12">
                                @component('themes.bootstrap.elements.tables.datatables',['id' => 'tablaRequerimientos'])
                                    @slot('columns', [
                                        '#',
                                        'Requerimiento',
                                        ''
                                    ])
                                @endcomponent
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

        var table, url, columns;
        table = $('#tablaRequerimientos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaRequermientos')}}"+ "/"+ {{$idProyecto}};
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CPR_Nombre_Requerimiento', name: 'CPR_Nombre_Requerimiento'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-danger remove"  title="Eliminar este requerimiento" ><i class="fa fa-trash"></i></a>',
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
        
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = "{{route('calidadpcs.procesosCalidad.deleteRequerimiento')}}"+"/"+ dataTable.PK_CPR_Id_Requerimientos;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar el requerimiento seleccionado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun requerimiento", "error");
                    }
                });

        });
      
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        var editarProyecto = function () {
            return {
                init: function () {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso2') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('FK_CPP_Id_Proyecto', $('input:hidden[name="PK_CP_Id_Proyecto"]').val());
                    formData.append('FK_CPP_Id_Proceso', $('input:hidden[name="PK_CP_Id_Proceso"]').val());
                    formData.append('Alcance', $('#Alcance').val());
                   
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
            Alcance:{required: true, minlength: 3, maxlength: 500, noSpecialCharacters:true, letters:false},
        };
        var formMessage = {
            Alcance: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, editarProyecto());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

    });
</script>