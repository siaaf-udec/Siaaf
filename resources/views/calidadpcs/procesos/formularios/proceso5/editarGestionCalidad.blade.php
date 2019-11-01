<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
    <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Planificar la gestión de la calidad.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Gestion integrada del proyecto. <br><strong>Propósito:</strong>El propósito 
                                de la Gestión Integrada del Proyecto (IPM) es establecer y gestionar el proyecto y la involucración de las partes interesadas relevantes de acuerdo a un proceso 
                                integrado y definido, que se adapta a partir del conjunto de procesos estándar de la organización.<br><strong>Notas introductorias:</strong> La Gestión Integrada 
                                del Proyecto implica las siguientes actividades:<br> Establecer el proceso definido del proyecto al inicio del mismo, mediante la adaptación del conjunto de 
                                procesos estándar de la organización. <br>Gestionar el proyecto utilizando el proceso definido del proyecto.<br> Establecer el entorno de trabajo para el proyecto, 
                                basándose en los estándares del entorno de trabajo de la organización.<br>Establecer los equipos que tienen la tarea de conseguir los objetivos del proyecto.<br>
                                Utilizar y contribuir a los activos de proceso de la organización.<br>Posibilitar que los intereses de las partes interesadas relevantes se identifiquen, se 
                                consideren y, cuando sea apropiado, se traten durante el proyecto.<br>Asegurar que las partes interesadas relevantes (1) realizan sus tareas de forma coordinada y 
                                oportuna; (2) tratan los requisitos, los planes, los objetivos, los problemas y los riesgos del proyecto; (3) cumplen sus compromisos; (4) e identifican, siguen y 
                                resuelven las cuestiones de coordinación.<br>Utilizar el proceso definido del proyecto.<br>Establecer el proceso definido del proyecto.<br>Utilizar los activos de 
                                proceso de la organización para planificar las actividades del proyecto.<br>Establecer el entorno de trabajo del proyecto.<br>Integrar los planes.<br>Gestionar el 
                                proyecto utilizando planes integrados.<br>Establecer los equipos.<br>Contribuir a los activos de proceso de la organización.                
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
                                <strong>Proceso:</strong> Planificar la gestión de la calidad.<br>La Gestión de la Calidad del Proyecto incluye los procesos y actividades de la organización 
                                ejecutora que establecen las políticas de calidad, los objetivos y las responsabilidades de calidad para que el proyecto satisfaga las necesidades para las que fue 
                                acometido. La Gestión de la Calidad del Proyecto utiliza políticas y procedimientos para implementar el sistema de gestión de la calidad de la organización en el 
                                contexto del proyecto, y, en la forma que resulte adecuada, apoya las actividades de mejora continua del proceso, tal y como las lleva a cabo la organización ejecutora. 
                                La Gestión de la Calidad del Proyecto trabaja para asegurar que se alcancen y se validen los requisitos del proyecto, incluidos los del producto.<br><br><strong>
                                Planificar la Gestión de la Calidad:</strong><br>Es el proceso de identificar los requisitos y/o estándares de calidad para el proyecto y sus entregables, así como de 
                                documentar cómo el proyecto demostrará el cumplimiento con los mismos.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
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
                <div class="modal-dialog">
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

                                    {!! Field:: text('Requerimientos',null,['label'=>'Requerimientos:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-sliders'] ) !!}

                                    {!! Field:: text('Responsables',null,['label'=>'Responsables:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-users'] ) !!}
                                    
                                    {!! Field:: text('CPC_Entregable',null,['label'=>'Tareas a realizar :',  'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite las tareas que se van a cumplir en el sprint.', 'icon' => 'fa fa-file-text-o']) !!}
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
    <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                        <a href="javascript:;" class="btn btn-success button-cancel">
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
                defaultContent: '<a href="javascript:;" class="btn btn-success agregar"  title="Agregar entrega a este sprint" ><i class="fa fa-pencil-square-o"></i></a>',
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

    $(".guardarCosto").on('click', function(e) {
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