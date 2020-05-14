<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Tabla de procesos:'])
        
        <div class="row">
            <div class="col-md-12">
                <h3>Procesos de la {{$nomEtapa}}</h3><br>
            </div>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaProcesos'])
                    @slot('columns', [
                        '#',
                        'Nombre Proceso',
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
<script src = "{{ asset('assets/main/calidadpcs/table-datatable.js') }}" type = "text/javascript" ></script>
<script type="text/javascript">

    jQuery(document).ready(function () {
        
        var table, url, columns;
        table = $('#listaProcesos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaProcesos')}}"+ "/"+ {{$idEtapa}};
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CP_Nombre_Proceso', name: 'CP_Nombre_Proceso'},
            {
                defaultContent: false,
                data: 'action',
                name: 'Formulario',
                title: 'Formulario',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    if(row.PK_CP_Id_Proceso == {{$numProcesos}}){
                        return '<a href="javascript:;" class="btn btn-success verFormulario"  title="Ver este formulario"> <i class="fa fa-pencil-square-o"></i></a>';
                    }if(row.PK_CP_Id_Proceso < {{$numProcesos}}){
                       //return '<i class="fa fa-check"></i>';
                       return '<span class="label label-sm label-success">Realizado</span>';
                    }if(row.PK_CP_Id_Proceso > {{$numProcesos}}){
                        return '<span class="label label-sm label-warning">Pendiente</span>';
                    }
                },
                serverSide: false,
                responsivePriority: 2
            },
            {
                defaultContent: false,
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    if({{$numProcesos}} > 26){
                        return '<span class="label label-sm label-warning">Proyecto Finalizado</span>';
                    }else if(row.PK_CP_Id_Proceso < {{$numProcesos}}){
                       return '<a href="javascript:;" title="Editar" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>';
                    }else{
                        return '<span class="label label-sm label-warning">Pendiente</span>';
                    }
                },
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        
        table.on('click', '.verFormulario', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
                //route_edit = '{{ route('calidadpcs.procesosCalidad.formularios') }}' + '/' + dataTable.PK_CP_Id_Proceso + '/' + {{$idProyecto}};
                if(dataTable.PK_CP_Id_Proceso <= {{$numProcesos}}){
                    
                        $.ajax({
                            type: 'GET',
                            success: function (response, xhr, request) {
                                if (response.data == 422) {
                                        xhr = "warning"
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
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
                    UIToastr.init(xhr, "Lo sentimos", "Los procesos se deben llenar en orden, el proceso que debe realizar es el numero: "+{{$numProcesos}});
                }
            
        });

        table.on('click', '.edit', function (e) {
            var type = 'GET';
            var async = async || false;
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route ="{{ route('calidadpcs.procesosCalidad.editarFormularios') }}" + "/" + dataTable.PK_CP_Id_Proceso + "/" + {{$idProyecto}};

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data:false,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    if (response.data == 422) {
                                            xhr = "warning"
                                            UIToastr.init(xhr, response.title, response.message);
                                            App.unblockUI('.portlet-form');
                                            // var route = '{{ route('calidadpcs.procesosCalidad.indexAjaxProcesos') }}' + '/' + {{$idProyecto}};
                                            // $(".content-ajax").load(route);
                                    }
                                    else{
                                        
                                        //$('#form_proyecto_create')[0].reset(); //Limpia formulario
                                        //UIToastr.init(xhr, response.title, response.message);
                                        //App.unblockUI('.portlet-form');
                                        
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
                    
                
            
        });

    });
</script>