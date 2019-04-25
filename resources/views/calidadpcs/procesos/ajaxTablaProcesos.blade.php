<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Procesos:'])
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaProcesos'])
                    @slot('columns', [
                        '#',
                        'Nombre Proceso',
                        'Etapa',
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
        table = $('#listaProcesos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaProcesos')}}";
        columns = [
            {data: 'PK_CP_Id_Proceso', name: 'PK_CP_Id_Proceso'},
            {data: 'CP_Nombre_Proceso', name: 'CP_Nombre_Proceso'},
            {data: 'Etapa', name: 'Etapa'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verFormulario"  title="Ver este formulario" ><i class="fa fa-th-list"></i></a>',
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
        
        table.on('click', '.verFormulario', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('calidadpcs.procesosCalidad.formularios') }}' + '/' + dataTable.PK_CP_Id_Proceso + '/' + {{$idProyecto}};
                if(dataTable.PK_CP_Id_Proceso <= {{$numProcesos}}){
                    
                        $.ajax({
                            success: function (response, xhr, request) {
                            console.log(response);
                            
                            if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('calidadpcs.procesosCalidad.index.ajax') }}' + '/' + {{$idProyecto}};
                                    $(".content-ajax").load(route);
                            }
                            else{
                                if (request.status === 200 && xhr === 'success') {
                                //$('#form_proyecto_create')[0].reset(); //Limpia formulario
                                //UIToastr.init(xhr, response.title, response.message);
                                //App.unblockUI('.portlet-form');
                                var route ='{{ route('calidadpcs.procesosCalidad.formularios') }}' + '/' + dataTable.PK_CP_Id_Proceso + '/' + {{$idProyecto}};
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

    });
</script>