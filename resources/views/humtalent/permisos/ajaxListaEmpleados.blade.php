
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Personal registrado:'])
            @permission('TAL_READ_EMP')
                <div class="row">
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                            @slot('columns', [
                                '#',
                                'Nombres',
                                'Apellidos',
                                'Cédula',
                                'Teléfono',
                                'Email',
                                'Rol ',
                                'Acciones'
                            ])
                        @endcomponent
                    </div>
                </div>
            @endpermission
        @endcomponent
    </div>


<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {

        var table, url,columns;
        table = $('#lista-empleados');
        url = "{{ route('talento.humano.tablaEmpleados')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PRSN_Nombres', name: 'Nombres'},
            {data: 'PRSN_Apellidos', name: 'Apellidos'},
            {data: 'PK_PRSN_Cedula', name: 'Cedula'},
            {data: 'PRSN_Telefono', name: 'Teléfono'},
            {data: 'PRSN_Correo', name: 'Correo Electronico'},
            {data: 'PRSN_Rol', name: 'Rol'},
            {
                defaultContent: '@permission("TAL_MODULE")<a href="javascript:;" class="btn btn-primary documents" ><i class="fa fa-book"></i></a>@endpermission @permission("TAL_GEN_REPORT")<a href="javascript:;" class="btn btn-success reports"  title="Reporte" ><i class="fa fa-table"></i></a>@endpermission',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.documents', function (e)
        {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route ='{{ route('talento.humano.permisos.tablaPermisos') }}'+'/'+dataTable.PK_PRSN_Cedula;
            $(".content-ajax").load(route);
        });

        table.on('click', '.reports', function (e)
        {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $.ajax({
            }).done(function(){
                window.open('{{ route('talento.humano.permisos.reporte') }}'+'/'+dataTable.PK_PRSN_Cedula, '_blank');
            });
        });
    });
</script>
