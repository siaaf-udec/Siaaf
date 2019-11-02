<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
    <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Gestión del tiempo del proyecto.</h4>
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
                                    <strong>Nivel de madurez:</strong> 2. <br><br><strong>Meta especifica:</strong> Planificación del proyecto. <br><br><strong>Propósito:</strong> El propósito 
                                    de la Planificación del Proyecto (PP) es establecer y mantener planes que definan las actividades del proyecto.<br><br><strong>Notas introductorias: </strong>
                                    Una de las claves para gestionar eficazmente un proyecto es la planificación del proyecto. El área de proceso Planificación del Proyecto implica las siguientes 
                                    actividades:<br><br>Desarrollar el plan de proyecto.<br>Interactuar de forma apropiada con las partes interesadas relevantes.<br>Obtener el compromiso con el 
                                    plan.<br>Mantener el plan.
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
                                    <strong>Proceso:</strong> Gestión del tiempo del proyecto.<br><br>La Gestión del Tiempo del Proyecto incluye los procesos requeridos para gestionar la terminación en
                                    plazo del proyecto. <br><br><strong>Planificar la Gestión del Cronograma: </strong>Proceso por medio del cual se establecen las políticas, los procedimientos y la 
                                    documentación para planificar, desarrollar, gestionar, ejecutar y controlar el cronograma del proyecto.<br><br><strong>Definir las Actividades: </strong>Proceso de 
                                    identificar y documentar las acciones específicas que se deben realizar para generar los entregables del proyecto. <br><br><strong>Secuenciar las Actividades: </strong>
                                    Proceso de identificar y documentar las relaciones existentes entre las actividades del proyecto.<br><br><strong>Estimar los Recursos de las Actividades: </strong>
                                    Proceso de estimar el tipo y las cantidades de materiales, recursos humanos, equipos o suministros requeridos para ejecutar cada una de las actividades.<br><br>
                                    <strong>Estimar la Duración de las Actividades: </strong>Proceso de estimar la cantidad de períodos de trabajo necesarios para finalizar las actividades individuales 
                                    con los recursos estimados.<br><br><strong>Desarrollar el Cronograma: </strong> Proceso de analizar secuencias de actividades, duraciones, requisitos de recursos y 
                                    restricciones del cronograma para crear el modelo de programación del proyecto.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            
        </div>
        <br>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaActividades'])
            @slot('columns', [
            '#',
            'Nombre Sprint',
            'Requerimientos',
            'Recurso',
            'Duracion en semanas',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="note note-success">
                <h4 class="block">Tener en cuenta!</h4>
                <p>Para poder avanzar no pueden haber semanas disponibles.</p>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">
                   <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                    {{ Form::submit('Continuar', ['class' => 'btn blue button-cancel']) }}
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_edit" role="dialog" tabindex="-1" >
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_edit', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Editar sprint</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('idSprint')!!}

                                    {!! Field:: text('Nombre_Sprint_Editar',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-tag'] ) !!}
                                   
                                    <div class="form-group form-md-line-input" style="padding-top: 0px;">
                                        <div class="input-icon">
                                            <select id="lista_requerimientos_editar" name="lista_requerimientos_editar" class="selectpicker form-control" multiple data-size="5" title="Seleccione por lo menos un requerimiento" data-width="100%" style="padding-left: 0px;">
                                                @foreach($requerimientos as $key => $name)
                                                <option value="{{$key}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="lista_requerimientos_editar" class="control-label">Requerimientos:</label>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input" style="padding-top: 0px;">
                                        <div class="input-icon">
                                            <label for="lista_integrantes_editar" class="control-label">Integrantes:</label>
                                            <select id="lista_integrantes_editar" name="lista_integrantes_editar" class="selectpicker form-control" multiple data-size="5" title="Seleccione por lo menos un responsable" data-width="100%">
                                                @foreach($integrantes as $key => $name)
                                                <option value="{{$key}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {!! Field:: text('Numero_Semanas_Editar',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'], 
                                        ['help' => 'Digite el numero de semanas.']) !!}
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
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/calidadpcs/table-datatable.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var semDiferencia;
    var subtotal;
    var aux;
    var fechaEmision = moment('{{$infoProyecto[0]['CP_Fecha_Inicio']}}');
    var fechaExpiracion = moment('{{$infoProyecto[0]['CP_Fecha_Final']}}');
    semDiferencia = fechaExpiracion.diff(fechaEmision, 'weeks');

    var actualizarSemanas = function() {
        aux = 0;
        aux = semDiferencia;
        subtotal = 0;
        url = "{{route('calidadpcs.procesosCalidad.tablaCronograma')}}" + "/" + {{$idProyecto}};
        $.get(url, function(data) {
            $.each(data.data, function(index, value) {
                subtotal += parseInt(value.CPC_Duracion);
            });
            aux = (aux - subtotal);
            var createProyecto = function() {
            return {
                init: function() {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso3') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('FK_CPP_Id_Proyecto', $('input:hidden[name="FK_CPP_Id_Proyecto"]').val());
                    formData.append('CPC_Nombre_Sprint', $('input:text[name="CPC_Nombre_Sprint"]').val());
                    formData.append('CPC_Requerimiento', $('#lista_requerimientos').val());
                    formData.append('CPC_Recurso', $('#lista_integrantes').val());
                    formData.append('CPC_Duracion', $('input:text[name="numero_semanas"]').val());

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
                            if (response.data == 422) {
                                xhr = "warning"
                                UIToastr.init(xhr, response.title, response.message);
                            } else {
                                if (request.status === 200 && xhr === 'success') {
                                    
                                    var route ='{{ route('calidadpcs.procesosCalidad.formularios') }}' + '/3/' + {{$idProyecto}};
                                    $(".content-ajax").load(route);
                                    $('#modal-create-permission').modal('hide');
                                    $('#from_permissions_update')[0].reset(); //Limpia formulario
                                    $('.selectpicker').selectpicker('deselectAll');
                                    UIToastr.init(xhr, response.title, response.message);
                                }
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
        var form = $('#from_permissions_update');
        var formRules = {
            CPC_Nombre_Sprint: {
                required: true,
                minlength: 2,
                maxlength: 50,
            },
            numero_semanas: {
                required: true,
                min: 1,
                max: aux,
            },
            lista_requerimientos: {
                required: true,
            },
            lista_integrantes: {
                required: true,
            },
        };
        var formMessage = {

        };
        $("#num").text(aux);
        
        // console.log(formRules.numero_semanas.max);
        FormValidationMd.init(form, formRules, formMessage, createProyecto());
        });
    }
    jQuery(document).ready(function() {

        $('.selectpicker').selectpicker();
        actualizarSemanas();
        var table, url, columns;
        table = $('#listaActividades');
        url = "{{route('calidadpcs.procesosCalidad.tablaCronograma')}}" + "/" + {{$idProyecto}};
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
                data: 'CPC_Duracion',
                name: 'CPC_Duracion'
            },

            {
                defaultContent: '<a href="javascript:;" title="Editar" id="myb" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>',
                data: 'action',
                name: 'action',
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
            $('#modal-create-permission').modal('toggle');
        });

        $(".fin_proceso").on('click', function(e) {
            e.preventDefault();
            if(aux == 0){
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso3_1') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('FK_CPP_Id_Proyecto', $('input:hidden[name="FK_CPP_Id_Proyecto"]').val());
                    formData.append('FK_CPP_Id_Proceso', $('input:hidden[name="FK_CPP_Id_Proceso"]').val());
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
            }else{
                UIToastr.init('warning', "Acción no permitida", "Para poder pasar este proceso, no debe tener semanas disponibles");
            }
        });

        table.on('click', '.edit', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idSprint"]').val(dataTable.PK_CPC_Id_Sprint);
            $("#Nombre_Sprint_Editar").val(dataTable.CPC_Nombre_Sprint);
            $("#Numero_Semanas_Editar").val(dataTable.CPC_Duracion);
            var requerimientos = dataTable.CPC_Requerimiento.split(",");
             $('#lista_requerimientos_editar').selectpicker('val', requerimientos);
             var integrantes = dataTable.CPC_Recurso.split(",");
             $('#lista_integrantes_editar').selectpicker('val', integrantes);
             $('#modal_edit').modal('toggle');
        });

        var EditModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateProceso3') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                                        
                    formData.append('idSprint', $('input:hidden[name="idSprint"]').val());
                    formData.append('CPC_Nombre_Sprint', $('input:text[name="Nombre_Sprint_Editar"]').val());
                    formData.append('CPC_Requerimiento', $('#lista_requerimientos_editar').val());
                    formData.append('CPC_Recurso', $('#lista_integrantes_editar').val());

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
                                $('#from_edit')[0].reset(); //Limpia formulario
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
        var form_edit_modal = $('#from_edit');
        var rules_edit_modal = {
            Nombre_Sprint_Editar: {
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialCharacters:true,
            },
            lista_requerimientos_editar: {
                required: true,
            },
            lista_integrantes_editar: {
                required: true,
            },
        };
        var message_edit_modal = {
            Nombre_Sprint_Editar: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_edit_modal,rules_edit_modal,message_edit_modal,EditModal());

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });
       
    });
  
</script>