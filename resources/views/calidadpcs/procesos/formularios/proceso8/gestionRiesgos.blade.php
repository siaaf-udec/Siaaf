<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Proceso: Gestión de riesgos del proyecto.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Enfoque en procesos de la organización.<br><strong>Propósito: </strong>El propósito de Enfoque 
                                en Procesos de la Organización (OPF) es planificar, implementar y desplegar las mejoras de proceso de la organización, basadas en una comprensión completa de las fortalezas 
                                y debilidades actuales de los procesos y de los activos de proceso de la organización.<br><strong>Notas introductorias: </strong>Los procesos de la organización incluyen todos 
                                los procesos utilizados por la organización y sus proyectos. Las mejoras candidatas a los procesos y a los activos de proceso de la organización se obtienen de diferentes 
                                fuentes, incluyendo la medición de procesos, las lecciones aprendidas en la implementación de procesos, los resultados de las evaluaciones de proceso, los resultados de las 
                                actividades de evaluación de productos y servicios, los resultados de las evaluaciones de satisfacción del cliente, los resultados de benchmarking frente a procesos de otras 
                                organizaciones, y las recomendaciones de otras iniciativas de mejora en la organización.<br><br>
                                
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Gestión De Riesgos.<br><strong>Propósito: </strong>El propósito de la Gestión de Riesgos (RSKM) es 
                                identificar problemas potenciales antes de que ocurran, para que las actividades de tratamiento de riesgos puedan planificarse e invocarse según sea necesario a lo largo de 
                                la vida del producto o del proyecto para mitigar los impactos adversos sobre la consecución de objetivos.<br><strong>Notas introductorias: </strong>La gestión de riesgos es un 
                                proceso continuo, orientado hacia el futuro que es una parte importante de la gestión de proyectos. La gestión de riesgos debería tratar las cuestiones que podrían poner en 
                                peligro el logro de los objetivos críticos. Una aproximación de gestión de riesgos continua anticipa y mitiga eficazmente los riesgos que puedan tener un impacto crítico sobre 
                                un proyecto. Una gestión de riesgos eficaz incluye la identificación temprana y dinámica de los riesgos a través de la colaboración e involucración de las partes interesadas 
                                relevantes, tal y como se describió en el plan de involucración de las partes interesadas tratado en el área de proceso Planificación del Proyecto. Se necesita un fuerte 
                                liderazgo entre todas las partes interesadas relevantes para establecer un entorno para la libre y abierta divulgación y discusión de los riesgos.
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
                                <strong>Proceso:</strong> Gestión de riesgos del proyecto.<br>La Gestión de los Riesgos del Proyecto incluye los procesos para llevar a cabo la planificación de la gestión 
                                de riesgos, así como la identificación, análisis, planificación de respuesta y control de los riesgos de un proyecto. Los objetivos de la gestión de los riesgos del proyecto 
                                consisten en aumentar la probabilidad y el impacto de los eventos positivos, y disminuir la probabilidad y el impacto de los eventos negativos en el proyecto.<br><br>
                                <strong>Planificar la Gestión de los Riesgos: </strong>El proceso de definir cómo realizar las actividades de gestión de riesgos de un proyecto.<br><strong>Identificar los 
                                Riesgos: </strong>El proceso de determinar los riesgos que pueden afectar al proyecto y documentar sus características.<br><strong>Realizar el Análisis Cualitativo de 
                                Riesgos: </strong> El proceso de priorizar riesgos para análisis o acción posterior, evaluando y combinando la probabilidad de ocurrencia e impacto de dichos riesgos.<br>
                                <strong>Realizar el Análisis Cuantitativo de Riesgos:</strong>El proceso de analizar numéricamente el efecto de los riesgos identificados sobre los objetivos generales del 
                                proyecto.<br><strong>Planificar la Respuesta a los Riesgos: </strong>El proceso de desarrollar opciones y acciones para mejorar las oportunidades y reducir las amenazas a 
                                los objetivos del proyecto.
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
            'Riesgo',
            'Caracteristicas',
            'Importancia',
            'Accion',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_create" role="dialog" tabindex="-1">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Agregar Riesgo</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                    {!! Field:: text('Riesgo',null,['label'=>'Riesgo:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el riesgo.', 'icon' => 'fa fa-warning '] ) !!}

                                    {!! Field:: text('Caracteristicas',null,['label'=>'Caracteristicas:', 'max' => '100', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite las caracteristicas del riesgo.', 'icon' => 'fa fa-list-alt'] ) !!}

                                    {!! Field::select('Importancia:',['1'=>'1 - Más bajo', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5 - Más alto' ],null,['name' => 'Importancia']) !!}
                                    
                                    {!! Field:: text('Accion',null,['label'=>'Accion:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite la accion.', 'icon' => 'fa fa-bolt'] ) !!}
                                    
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
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_edit', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Editar Riesgo</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('idRiesgo')!!}

                                    {!! Field:: text('Riesgo_Edit',null,['label'=>'Riesgo:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el riesgo.', 'icon' => 'fa fa-warning '] ) !!}

                                    {!! Field:: text('Caracteristicas_Edit',null,['label'=>'Caracteristicas:', 'max' => '100', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite las caracteristicas del riesgo.', 'icon' => 'fa fa-list-alt'] ) !!}

                                    {!! Field::select('Importancia:',['1'=>'1 - Más bajo', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5 - Más alto' ],null,['name' => 'Importancia_Edit']) !!}
                                    
                                    {!! Field:: text('Accion_Edit',null,['label'=>'Accion:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite la accion.', 'icon' => 'fa fa-bolt'] ) !!}
                                    
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
                        <a href="javascript:;" class="btn btn-success guardarProceso">
                            Continuar <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/calidadpcs/table-datatable.js') }}" type = "text/javascript" ></script>
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
        url = "{{ route('calidadpcs.procesosCalidad.tablaGestionRiesgos')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPGR_Riesgo',
                name: 'CPGR_Riesgo'
            },
            {
                data: 'CPGR_Caracteristicas',
                name: 'CPGR_Caracteristicas'
            },
            {
                data: 'CPGR_Importancia',
                name: 'CPGR_Importancia'
            },
            {
                data: 'CPGR_Accion',
                name: 'CPGR_Accion'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-sm btn-success editar"  title="Editar este Riesgo" ><i class="fa fa-pencil-square-o"></i></a> <a href="javascript:;" class="btn btn-sm btn-danger eliminar"  title="Eliminar este riesgo" ><i class="fa fa-trash-o"></i></a>',
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

        $(".pmd-select2").select2({
                width: '100%',
                placeholder: "Selecccionar",
            });

            $(".create").on('click', function(e) {
            e.preventDefault();
            $('#modal_create').modal('toggle');
             });

            
        var createModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.storeProceso8') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('Riesgo', $('input:text[name="Riesgo"]').val());
                    formData.append('Caracteristicas', $('input:text[name="Caracteristicas"]').val());
                    formData.append('Importancia', $('select[name="Importancia"]').val());
                    formData.append('Accion', $('input:text[name="Accion"]').val());
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
                                $('#form_permissions_update')[0].reset(); //Limpia 
                                $(".pmd-select2").select2({
                                    width: '100%',
                                    placeholder: "Selecccionar",
                                });
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
            Riesgo: { required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false},
            Caracteristicas: { required: true, minlength: 2, maxlength: 100, noSpecialCharacters:true, letters:false},
            Importancia: { required: true },
            Accion: { required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false},
        };
        var formMessage = {
            Riesgo: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Caracteristicas: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Accion: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,formMessage,createModal());
        
        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso8_1') }}';
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
            $('input:hidden[name="idRiesgo"]').val(dataTable.PK_CPGR_Id_Riesgo);
            $("#Riesgo_Edit").val(dataTable.CPGR_Riesgo);
            $("#Caracteristicas_Edit").val(dataTable.CPGR_Caracteristicas);
            $('select[name="Importancia_Edit"]').val(dataTable.CPGR_Importancia);
            $('select[name="Importancia_Edit"]').trigger('change');
            $("#Accion_Edit").val(dataTable.CPGR_Accion);
            $('#modal_edit').modal('toggle');
        });

        var EditModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateProceso8') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('idRiesgo',  $('input:hidden[name="idRiesgo"]').val());
                    formData.append('Riesgo', $('input:text[name="Riesgo_Edit"]').val());
                    formData.append('Caracteristica', $('input:text[name="Caracteristicas_Edit"]').val());
                    formData.append('Importancia', $('select[name="Importancia_Edit"]').val());
                    formData.append('Accion', $('input:text[name="Accion_Edit"]').val());

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
            Riesgo_Edit: { required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false },
            Caracteristicas_Edit: { required: true, minlength: 3, maxlength: 100, noSpecialCharacters:true, letters:false },
            Importancia_Edit: {required: true },
            Accion_Edit: { required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false },
        };
        var message_edit_modal = {
            Riesgo_Edit: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Caracteristicas_Edit: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            Accion_Edit: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_edit_modal,rules_edit_modal,message_edit_modal,EditModal());

        table.on('click', '.eliminar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = "{{route('calidadpcs.procesosCalidad.deleteProceso8')}}"+"/"+ dataTable.PK_CPGR_Id_Riesgo;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este riesgo?",
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
                        swal("Cancelado", "No se eliminó ningun riesgo", "error");
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