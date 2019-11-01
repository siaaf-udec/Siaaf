<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
        <div class="row">
            <div class="col-md-12">
                <h4 style="margin-top: 0px;">Editar proceso: Planificar la gestión de los recursos humanos.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Formación en la organización. <br><strong>Propósito:</strong>El propósito de la Formación 
                                en la Organización (OT) es desarrollar las habilidades y los conocimientos de las personas para que puedan desempeñar sus roles eficaz y eficientemente.<br><br>
                                <strong>Notas introductorias</strong><br>La Formación de la organización trata la formación proporcionada para dar soporte a los objetivos estratégicos del negocio 
                                de la organización y para cumplir las necesidades tácticas de formación que son comunes a los proyectos y grupos de soporte. Las necesidades de formación para cumplir 
                                las necesidades especificas, identificadas por los proyectos individuales y grupos de soporte, se tratan a nivel de proyecto y de grupo de soporte, y están fuera del 
                                alcance del área de proceso Formación de la Organización. Para más información sobre cómo planificar los conocimientos y habilidades necesarios, consúltese el área de 
                                proceso Planificación del Proyecto. El programa de formación de la organización implica las siguientes actividades:<br>Identificar las necesidades de formación de la 
                                organización.<br>Obtener y proporcionar formación para tratar esas necesidades.<br>Establecer y mantener la capacidad de formación.<br>Establecer y mantener registros 
                                de formación.<br>Evaluar la eficacia de la formación.
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
                                <strong>Proceso:</strong> Planificar la gestión de los recursos humanos.<br>La Gestión de los Recursos Humanos del Proyecto incluye los procesos que organizan, 
                                gestionan y conducen al equipo del proyecto. El equipo del proyecto está compuesto por las personas a las que se han asignado roles y responsabilidades para completar 
                                el proyecto. Los miembros del equipo del proyecto pueden tener diferentes conjuntos de habilidades, pueden estar asignados a tiempo completo o a tiempo parcial y se 
                                pueden incorporar o retirar del equipo conforme avanza el proyecto. También se puede referir a los miembros del equipo del proyecto como personal del proyecto. Si 
                                bien se asignan roles y responsabilidades específicos a cada miembro del equipo del proyecto, la participación de todos los miembros en la toma de decisiones y en la 
                                planificación del proyecto es beneficiosa. La participación de los miembros del equipo en la planificación aporta su experiencia al proceso y fortalece su compromiso 
                                con el proyecto.<br><br><strong>Planificar la Gestión de los Recursos Humanos: </strong>El proceso de identificar y documentar los roles dentro de un proyecto, las 
                                responsabilidades, las habilidades requeridas y las relaciones de comunicación, así como de crear un plan para la gestión de personal.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="glyphicon glyphicon-plus"></i>Agregar</a>
                </div>
            </div>
        </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
            @slot('columns', [
            '#',
            'Persona',
            'Funcion',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_create" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Agregar Funcion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
 
                                    {!! Field::select('integrantes:',$integrantes,null,['name' => 'select_integrantes']) !!}
                                    
                                    {!! Field:: text('funcion',null,['label'=>'Funcion:', 'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Funcion que cumple.', 'icon' => 'fa fa-list-ol'] ) !!}

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
            <div aria-hidden="true" class="modal fade" id="modal_edit" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_edit', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Editar Funcion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('idFuncion')!!}
 
                                    {!! Field::select('integrantes:',$integrantes,null,['name' => 'select_edit']) !!}
                                    
                                    {!! Field:: text('funcion_edit',null,['label'=>'Funcion:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Funcion que cumple.', 'icon' => 'fa fa-list-ol'] ) !!}

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
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
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
        url = "{{ route('calidadpcs.procesosCalidad.tablaGestionRecursos')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'RecursoNombre',
                name: 'RecursoNombre'
            },
            {
                data: 'CPGR_Funcion',
                name: 'CPGR_Funcion'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-sm btn-success editar"  title="Editar esta funcion" ><i class="fa fa-pencil-square-o"></i></a> <a href="javascript:;" class="btn btn-sm btn-danger eliminar"  title="Eliminar esta funcion" ><i class="fa fa-trash-o"></i></a>',
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

        $(".create").on('click', function(e) {
            e.preventDefault();
            $('#modal_create').modal('toggle');
        });
        $(".pmd-select2").select2({
                width: '100%',
                placeholder: "Selecccionar",
        });

        var createModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.storeProceso6') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('FK_CPGR_Id_Equipo', $('select[name="select_integrantes"]').val());
                    formData.append('CPGR_Funcion', $('input:text[name="funcion"]').val());
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
                                $('#modal_create').modal('hide');
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
            select_integrantes: {required:true},
            funcion: { required: true, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false },
        };
        var formMessage = {
            funcion: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,formMessage,createModal());

        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso6_1') }}';
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

        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idFuncion"]').val(dataTable.PK_CPGR_Id_Gestion);
            $('select[name="select_edit"]').val(dataTable.FK_CPGR_Id_Equipo);
            $('select[name="select_edit"]').trigger('change');
            $("#funcion_edit").val(dataTable.CPGR_Funcion);
            $('#modal_edit').modal('toggle');
        });

        var EditModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateProceso6') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('idFuncion',  $('input:hidden[name="idFuncion"]').val());
                    formData.append('idEquipo', $('select[name="select_edit"]').val());
                    formData.append('Funcion', $('input:text[name="funcion_edit"]').val());

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
                                table.ajax.reload();
                                $('#modal_edit').modal('hide');
                                $('#form_edit')[0].reset(); //Limpia formulario
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

        var form_edit_modal = $('#form_edit');
        var rules_edit_modal = {
            select_edit:{ required: true},
            funcion_edit: { required: true, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false },
        };
        var message_edit_modal = {
            funcion_edit: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_edit_modal,rules_edit_modal,message_edit_modal,EditModal());

        table.on('click', '.eliminar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = "{{route('calidadpcs.procesosCalidad.deleteProceso6')}}"+"/"+ dataTable.PK_CPGR_Id_Gestion;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar esta funcion?",
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
                        swal("Cancelado", "No se eliminó ninguna funcion", "error");
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