<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
        <div class="row">
            <div class="col-md-12">
            <h4 style="margin-top: 0px;">Proceso: Planificar la gestión de comunicaciones</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Análisis de decisiones y resolución. <br><strong>Propósito:</strong>El propósito del Análisis 
                                de Decisiones y Resolución (DAR) es analizar las posibles decisiones utilizando un proceso de evaluación formal que evalúa las alternativas identificadas, frente a unos 
                                criterios establecidos.<br><br><strong>Notas introductorias </strong><br>El área de proceso Análisis de Decisiones y Resolución implica establecer guías, para determinar 
                                qué cuestiones deberían estar sujetas a un proceso de evaluación formal y aplicar los procesos de evaluación formal a estas cuestiones. Un proceso de evaluación formal es 
                                un enfoque estructurado para evaluar soluciones alternativas frente a criterios establecidos con el fin de determinar una solución recomendada. Un proceso de evaluación 
                                formal implica las siguientes acciones:<br>Establecer los criterios para evaluar alternativas.<br>Identificar soluciones alternativas. y Seleccionar métodos para evaluar 
                                alternativas.<br>Evaluar soluciones alternativas utilizando los criterios y los métodos establecidos.<br>Seleccionar soluciones recomendadas a partir de las alternativas 
                                identificadas en base a los criterios de evaluación.
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
                                <strong>Proceso:</strong> Planificar la gestión de comunicaciones.<br>La Gestión de las Comunicaciones del Proyecto incluye los procesos requeridos para asegurar 
                                que la planificación, recopilación, creación, distribución, almacenamiento, recuperación, gestión, control, monitoreo y disposición final de la información del 
                                proyecto sean oportunos y adecuados. Los directores de proyecto emplean la mayor parte de su tiempo comunicándose con los miembros del equipo y otros interesados 
                                en el proyecto, tanto si son internos (en todos los niveles de la organización) como externos a la misma. Una comunicación eficaz crea un puente entre diferentes 
                                interesados que pueden tener diferentes antecedentes culturales y organizacionales, diferentes niveles de experiencia, y diferentes perspectivas e intereses, lo 
                                cual impacta o influye en la ejecución o resultado del proyecto.<br><br><strong>Planificar la Gestión de las Comunicaciones:</strong><br>El proceso de desarrollar
                                un enfoque y un plan adecuados para las comunicaciones del proyecto sobre la base de las necesidades y requisitos de información de los interesados y de los activos 
                                de la organización disponibles.
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
            'Interesado',
            'Lugar',
            'Fecha',
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
                            <h3>Agregar Reunion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
 
                                    {!! Field::select('Interesado:',['Equipo scrum'=>'Equipo scrum', 'Product owner'=>'Product owner', 'Stakeholder'=>'Stakeholder' ],null,['name' => 'Interesado' ,'required']) !!}
                                    
                                    {!! Field:: text('Lugar',null,['label'=>'Lugar:', 'max' => '50', 'required', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-map-marker'] ) !!}

                                    {!! Field::text(
                                        'date_time',
                                        ['label' => 'Fecha y hora:', 'class' => 'input-append date form_datetime','data-date'=>"21-02-2018T15:25Z", 'readonly', 'auto' => 'off'],
                                        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar']) !!}

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
                            <h3>Editar Reunion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    {!! Field:: hidden ('idReunion')!!}
                                    
                                    {!! Field::select('Interesado:',['Equipo scrum'=>'Equipo scrum', 'Product owner'=>'Product owner', 'Stakeholder'=>'Stakeholder' ],null,['name' => 'Interesado_edit','required']) !!}
                                    
                                    {!! Field:: text('Lugar_edit',null,['label'=>'Lugar:', 'max' => '50','required', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                        ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-map-marker'] ) !!}

                                    {!! Field::text(
                                        'date_time_edit',
                                        ['label' => 'Fecha y hora:','class' => 'input-append date form_datetime', 'data-date'=>"+0", 'required', 'auto' => 'off'],
                                        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar']) !!}

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
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

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
        url = "{{ route('calidadpcs.procesosCalidad.tablaGestionComunicacion')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPGC_Interesado',
                name: 'CPGC_Interesado'
            },
            {
                data: 'CPGC_Lugar',
                name: 'CPGC_Lugar'
            },
            {
                data: 'CPGC_Fecha',
                name: 'CPGC_Fecha'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-sm btn-success editar"  title="Editar esta reunion" ><i class="fa fa-pencil-square-o"></i></a> <a href="javascript:;" class="btn btn-sm btn-danger eliminar"  title="Eliminar esta reunion" ><i class="fa fa-trash-o"></i></a>',
                data: 'action',
                name: 'Etapas',
                title: 'Etapas',
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

        var mindate = new Date();
        $(".form_datetime").datetimepicker({
                language: 'es',
                autoclose: true,
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                format: "dd-mm-yyyy hh:ii",
                startDate: mindate,
            });

            

            $(".pmd-select2").select2({
                width: '100%',
                placeholder: "Selecccionar",
            });

            var createModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.storeProceso7') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('Interesado', $('select[name="Interesado"]').val());
                    formData.append('Lugar', $('input:text[name="Lugar"]').val());
                    formData.append('date_time', $('input:text[name="date_time"]').val());
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
                                table.ajax.reload();
                                $('#modal_create').modal('hide');
                                $('#form_permissions_update')[0].reset(); //Limpia formulario
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
            Interesado: {required: true },
            Lugar: { required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false},
            date_time: { required: true },
        };
        var formMessage = {
            Lugar: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,formMessage,createModal());

        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idReunion"]').val(dataTable.PK_CPGC_Id_Comunicacion);
            $('select[name="Interesado_edit"]').val(dataTable.CPGC_Interesado);
            $('select[name="Interesado_edit"]').trigger('change');
            $("#Lugar_edit").val(dataTable.CPGC_Lugar);
            $("#date_time_edit").val(dataTable.CPGC_Fecha);
            $('#modal_edit').modal('toggle');
        });

        var EditModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateProceso7') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('idReunion',  $('input:hidden[name="idReunion"]').val());
                    formData.append('interesado', $('select[name="Interesado_edit"]').val());
                    formData.append('lugar', $('input:text[name="Lugar_edit"]').val());
                    formData.append('fecha', $('input:text[name="date_time_edit"]').val());

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
            Interesado_edit: {required: true },
            date_time_edit: {required: true },
            Lugar_edit: { required: true, minlength: 3, maxlength: 50, noSpecialCharacters:true, letters:false },
        };
        var message_edit_modal = {
            Lugar_edit: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_edit_modal,rules_edit_modal,message_edit_modal,EditModal());

        table.on('click', '.eliminar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = "{{route('calidadpcs.procesosCalidad.deleteProceso7')}}"+"/"+ dataTable.PK_CPGC_Id_Comunicacion;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar esta reunion?",
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
                        swal("Cancelado", "No se eliminó ninguna reunion", "error");
                    }
                });
        });

        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso7_1') }}';
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
    });
</script> 