<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Adquirir, desarrollar y dirigir equipo del proyecto.</h4>
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
            'Tiempo trabajo',
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

                                    {!! Field:: text('horasTrabajo',null,['label'=>'Tiempo de trabajo:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Escribe el numero de horas trabajadas por dia', 'icon' => 'fa fa-list-ol'] ) !!}

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
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Ver los procesos de este Proyecto" ><i class="fa fa-share-square-o"></i></a>',
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
            $('input:hidden[name="idIntegrante"]').val(''+dataTable.PK_CE_Id_Equipo_Scrum+'');
            $("#Nombre").val(dataTable.CE_Nombre_Persona);
            $("#horasTrabajo").val(dataTable.CE_Horas_Trabajadas);
            $('#modal_create').modal('toggle');
        });

        var createModal = function () {
            return{
                init: function () {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso12') }}';
                    var type = 'POST';
                    var async = async || false;
                    
                    var formData = new FormData();
                    formData.append('idEquipoScrum', $('input:hidden[name="idIntegrante"]').val());
                    formData.append('tiempoTrabajo', $('input:text[name="horasTrabajo"]').val());
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