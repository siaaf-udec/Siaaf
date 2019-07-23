<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Cronograma:'])
        <br>
        
        <div class="actions">
                        <a href="javascript:;"
                            class="btn btn-simple btn-success btn-icon create"
                            title="Crear una actividad"><i class="glyphicon glyphicon-plus"></i>Agregar Actividad</a>
                        <br><br>
        </div>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaActividades'])
                    @slot('columns', [
                        '#',
                        'Nombre Actividad',
                        'Fecha Inicio',
                        'Fecha Final',
                        'Recursos',
                        '',
                        ''
                    ])
                @endcomponent
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {
        
        var table, url, columns;
        table = $('#listaActividades');
        url = "{{ route('calidadpcs.procesosCalidad.tablaCronograma')}}"+ "/"+ {{$idProyecto}};
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CPC_Nombre_Actividad', name: 'CPC_Nombre_Actividad'},
            {data: 'CPC_Fecha_Inicio', name: 'CPC_Fecha_Inicio'},
            {data: 'CPC_Fecha_Final', name: 'CPC_Fecha_Final'},
            {data: 'CPC_Recursos', name: 'CPC_Recursos'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verFormulario"  title="Ver este formulario"> <i class="fa fa-th-list"></i></a>',
                data: 'action',
                name: 'Formulario',
                title: 'Formulario',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            },
            {
                defaultContent: '<a href="javascript:;" title="Editar" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>',
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
        

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.procesosCalidad.registrarActividad') }}' + '/'+{{$idProceso}}+'/' + {{ $idProyecto }} ;
            $(".content-ajax").load(route);
        });

        /*
        table.on('click', '.verFormulario', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
                //route_edit = '{{ route('calidadpcs.procesosCalidad.formularios') }}' + '/' + dataTable.PK_CP_Id_Proceso;
                if(dataTable.PK_CP_Id_Proceso <= ){
                    
                        $.ajax({
                            type: 'GET',
                            success: function (response, xhr, request) {
                                console.log(response);
                                if (response.data == 422) {
                                        xhr = "warning"
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                        //var route = '{{ route('calidadpcs.procesosCalidad.index.ajax') }}';
                                        //$(".content-ajax").load(route);
                                }
                                else{
                                    if (request.status === 200 && xhr === 'success') {
                                    //$('#form_proyecto_create')[0].reset(); //Limpia formulario
                                    //UIToastr.init(xhr, response.title, response.message);
                                    //App.unblockUI('.portlet-form');
                                    var route ='{{ route('calidadpcs.procesosCalidad.formularios') }}' + '/' + dataTable.PK_CP_Id_Proceso;
                                    $(".content-ajax").load(route);
                                    }
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    
                    //$(".content-ajax").load(route_edit);
                }else{
                    xhr = "warning"
                    UIToastr.init(xhr, "Lo sentimos", "Los procesos se deben llenar en orden.");
                    //alert("No se puede Ejecutar este proceso");
                }
            
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
                //route_edit = '{{ route('calidadpcs.procesosCalidad.formularios') }}' + '/' + dataTable.PK_CP_Id_Proceso ;
                if(dataTable.PK_CP_Id_Proceso <= ){
                    
                        $.ajax({
                            type: 'GET',
                            success: function (response, xhr, request) {
                                console.log(response);
                                if (response.data == 422) {
                                        xhr = "warning"
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                        //var route = '{{ route('calidadpcs.procesosCalidad.index.ajax') }}';
                                        //$(".content-ajax").load(route);
                                }
                                else{
                                    if (request.status === 200 && xhr === 'success') {
                                    //$('#form_proyecto_create')[0].reset(); //Limpia formulario
                                    //UIToastr.init(xhr, response.title, response.message);
                                    //App.unblockUI('.portlet-form');
                                    var route ='{{ route('calidadpcs.procesosCalidad.editarFormularios') }}' + '/' + dataTable.PK_CP_Id_Proceso ;
                                    $(".content-ajax").load(route);
                                    }
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    
                    //$(".content-ajax").load(route_edit);
                }else{
                    xhr = "warning"
                    UIToastr.init(xhr, "Lo sentimos", "Los procesos se deben llenar en orden.");
                    //alert("No se puede Ejecutar este proceso");
                }
            
        });
    */
    });
</script>