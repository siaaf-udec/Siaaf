<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de cierre:'])
    <h4 style="margin-top: 0px;">Editar proceso: Cerrar el proyecto y las adquisiciones.</h4>
    <br>
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
                        <a href="javascript:;" class="btn btn-success button-cancel">
                            Continuar <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
<br>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                   <a href="javascript:;" class="btn btn-lg red finProyecto">
                   <i class="fa fa-power-off"></i> Finalizar Proyecto 
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
       
        $(".finProyecto").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.finalizarProyecto') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('id_Proyecto', {{$idProyecto}});
                    formData.append('id_Proceso', {{$idProceso}});
                    swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de finalizar el proyecto?. No podra editar ningun formulario",
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
                } else {
                        swal("Cancelado", "No se finalizo el proyecto", "error");
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