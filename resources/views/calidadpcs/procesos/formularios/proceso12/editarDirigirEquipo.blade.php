<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Adquirir, desarrollar y dirigir equipo del proyecto.</h4>
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
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Enfoque en procesos de la organización.<br><strong>Propósito: </strong>El propósito de
                                Enfoque en Procesos de la Organización (OPF) es planificar, implementar y desplegar las mejoras de proceso de la organización, basadas en una comprensión completa de 
                                las fortalezas y debilidades actuales de los procesos y de los activos de proceso de la organización.<br><strong>Notas introductorias: </strong>Los procesos de la 
                                organización incluyen todos los procesos utilizados por la organización y sus proyectos. Las mejoras candidatas a los procesos y a los activos de proceso de la organización 
                                se obtienen de diferentes fuentes, incluyendo la medición de procesos, las lecciones aprendidas en la implementación de procesos, los resultados de las evaluaciones 
                                de proceso, los resultados de las actividades de evaluación de productos y servicios, los resultados de las evaluaciones de satisfacción del cliente, los resultados 
                                de benchmarking frente a procesos de otras organizaciones, y las recomendaciones de otras iniciativas de mejora en la organización.<br>Desplegar los activos de proceso 
                                de la organización e incorporar las experiencias.<br>Desplegar los activos de proceso de la organización.<br>Desplegar los procesos estándar.<br>Monitorizar la implementación.
                                <br>Incorporar las experiencias en los activos de proceso de la organización.
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
                                <strong>Proceso:</strong> Adquirir, desarrollar y dirigir equipo del proyecto.<br><br><strong>Adquirir el Equipo del Proyecto: </strong> proceso de confirmar la disponibilidad 
                                de los recursos humanos y conseguir el equipo necesario para completar las actividades del proyecto.<br><strong>Desarrollar el Equipo del Proyecto: </strong>El proceso de mejorar 
                                las competencias, la interacción entre los miembros del equipo y el ambiente general del equipo para lograr un mejor desempeño del proyecto.<br><strong>Dirigir el Equipo del 
                                Proyecto: </strong>El proceso de realizar el seguimiento del desempeño de los miembros del equipo, proporcionar retroalimentación, resolver problemas y gestionar cambios a fin 
                                de optimizar el desempeño del proyecto.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
            @slot('columns', [
            '#',
            'Equipo',
            'Horas diarias trabajadas',
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
                        {!! Form::open(['id' => 'form_create', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Editar tiempo de trabajo</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
 
                                    {!! Field:: hidden ('idIntegrante') !!} 

                                    {!! Field:: text('Nombre',null,['label'=>'Nombre:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Funcion que cumple.', 'icon' => 'fa fa-user'] ) !!}

                                    {!! Field::select('Tiempo de trabajo diario:',['1' => '1 hora', '2' => '2 horas', '3' => '3 horas', '4' => '4 horas', '5' => '5 horas', '6' => '6 horas'
                                        , '7' => '7 horas', '8' => '8 horas', '9' => '9 horas', '10' => '10 horas', '11' => '11 horas', '12' => '12 horas'],null,
                                        ['name'=> 'horasTrabajo']) !!}

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
<script src = "{{ asset('assets/main/calidadpcs/table-datatable.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
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
        url = "{{ route('calidadpcs.procesosCalidad.tablaEquipo')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CE_Nombre_Persona',
                name: 'CE_Nombre_Persona'
            },
            {
                defaultContent: ' ',
                data: 'CE_Horas_Trabajadas',
                name: 'CE_Horas_Trabajadas',
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success editar"  title="Ver los procesos de este Proyecto" ><i class="fa fa-share-square-o"></i></a>',
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

        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idIntegrante"]').val(''+dataTable.PK_CE_Id_Equipo_Scrum+'');
            $("#Nombre").val(dataTable.CE_Nombre_Persona);
            $('select[name="horasTrabajo"]').val(dataTable.CE_Horas_Trabajadas);
            $('select[name="horasTrabajo"]').trigger('change');
            $('#modal_create').modal('toggle');
        });

        $(".pmd-select2").select2({
            width: '100%',
            placeholder: "Selecccionar",
        });

        var createModal = function () {
            return{
                init: function () {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso12') }}';
                    var type = 'POST';
                    var async = async || false;
                    
                    var formData = new FormData();
                    formData.append('idEquipoScrum', $('input:hidden[name="idIntegrante"]').val());
                    formData.append('tiempoTrabajo', $('select[name="horasTrabajo"]').val() );
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
                                $('#form_create')[0].reset(); //Limpia formulario
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

        var form_create_modal_1 = $('#form_create');
        var rules_create_modal_1 = {
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_1,rules_create_modal_1,false,createModal());

        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso12_1') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('Id_Proyecto', {{$idProyecto}});
                    formData.append('Id_Proceso', {{$idProceso}});
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