<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapas:'])
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaEtapas'])
                    @slot('columns', [
                        '#',
                        'Nombre Etapa',
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
        table = $('#listaEtapas');
        url = "{{ route('calidadpcs.procesosCalidad.tablaEtapas')}}";
        columns = [
            {data: 'PK_CE_Id_Etapa', name: 'PK_CE_Id_Etapa'},
            {data: 'CE_Etapa', name: 'CE_Etapa'},
            {
                defaultContent: false,
                data: 'action',
                name: 'Progreso',
                title: 'Progreso',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    if(row.PK_CE_Id_Etapa == 1){
                        return '<div class="progress progress-striped active" style="height: 20px;text-indent: inherit; background-color:#BEBDBC;margin-top: 10px;margin-bottom: 10px;">\
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'+{{$porcentajes[0]}}+'" aria-valuemin="0" aria-valuemax="100" style="width:'+{{$porcentajes[0]}}+'%">\
                                        '+{{$porcentajes[0]}}+'% Completado\
                                    </div>\
                                </div> ';
                    }if(row.PK_CE_Id_Etapa == 2){
                       return  '<div class="progress progress-striped active" style="height: 20px;text-indent: inherit; background-color:#BEBDBC;margin-top: 10px;margin-bottom: 10px;">\
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'+{{$porcentajes[1]}}+'" aria-valuemin="0" aria-valuemax="100" style="width:'+{{$porcentajes[1]}}+'%">\
                                        '+{{$porcentajes[1]}}+'% Completado\
                                    </div>\
                                </div> ';
                    }if(row.PK_CE_Id_Etapa == 3){
                        return  '<div class="progress progress-striped active" style="height: 20px;text-indent: inherit; background-color:#BEBDBC;margin-top: 10px;margin-bottom: 10px;">\
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'+{{$porcentajes[2]}}+'" aria-valuemin="0" aria-valuemax="100" style="width:'+{{$porcentajes[2]}}+'%">\
                                        '+{{$porcentajes[2]}}+'% Completado\
                                    </div>\
                                </div> ';
                    }if(row.PK_CE_Id_Etapa == 4){
                        return  '<div class="progress progress-striped active" style="height: 20px;text-indent: inherit; background-color:#BEBDBC;margin-top: 10px;margin-bottom: 10px;">\
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'+{{$porcentajes[3]}}+'" aria-valuemin="0" aria-valuemax="100" style="width:'+{{$porcentajes[3]}}+'%">\
                                        '+{{$porcentajes[3]}}+'% Completado\
                                    </div>\
                                </div> ';
                    }if(row.PK_CE_Id_Etapa == 5){
                        return  '<div class="progress progress-striped active" style="height: 20px;text-indent: inherit; background-color:#BEBDBC;margin-top: 10px;margin-bottom: 10px;">\
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'+{{$porcentajes[4]}}+'" aria-valuemin="0" aria-valuemax="100" style="width:'+{{$porcentajes[4]}}+'%">\
                                        '+{{$porcentajes[4]}}+'% Completado\
                                    </div>\
                                </div> ';
                    }
                },
                serverSide: false,
                responsivePriority: 2
            },
            {
                //defaultContent: '<a href="javascript:;" class="btn btn-success verProcesos"  title="Ver los procesos de esta etapa"> <i class="fa fa-pencil-square-o"></i></a>',
                defaultContent: false,
                data: 'action',
                name: 'Procesos',
                title: 'Procesos',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    if(row.PK_CE_Id_Etapa <= {{$conteoEtapa}}){
                        return '<a href="javascript:;" class="btn btn-success verProcesos"  title="Ver los procesos de esta etapa"> <i class="fa fa-pencil-square-o"></i></a>';
                    }if(row.PK_CE_Id_Etapa > {{$conteoEtapa}}){
                        return '<span class="label label-sm label-warning">Pendiente</span>';
                    }/*if(row.PK_CE_Id_Etapa > {{$numProcesos}}){
                        return '<button type="button" class="btn btn-warning btn-sm" disabled>Pendiente</button>';
                    }*/
                },
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        
        table.on('click', '.verProcesos', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
                route_edit = '{{ route('calidadpcs.procesosCalidad.index.ajax') }}' + '/' + dataTable.PK_CE_Id_Etapa + '/' + {{$idProyecto}};
                $(".content-ajax").load(route_edit);
            
        });
    });
</script>