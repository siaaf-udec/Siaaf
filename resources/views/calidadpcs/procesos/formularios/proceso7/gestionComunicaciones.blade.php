
<!-- 
    CAMBIAR A: 

    tabla de reuniones: 

    select de reunirse con quien: equipo, dueño del producto (product owner), interesados (stakeholder)







-->




<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Proyectos:'])
        <div class="row">
        <div class="col-md-12">
        <h3>Planificar la gestión de comunicaciones</h3>
        </div>
    </div>
    <br>
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
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<!-- <script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></scripts> -->

<script type="text/javascript">
    jQuery(document).ready(function() {

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
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Ver los procesos de este Proyecto" ><i class="fa fa-list-ul"></i></a>',
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
        // dataTableServer.init(table, url, columns);
        // table = table.DataTable();

        // $(".create").on('click', function(e) {
        //     e.preventDefault();
        //     var route = '{{ route('calidadpcs.proyectosCalidad.RegistrarProyecto') }}' + '/' +{{Auth::user()->id}};
        //     $(".content-ajax").load(route);
        // });

        // table.on('click', '.verEtapas', function(e) {
        //     e.preventDefault();
        //     $tr = $(this).closest('tr');
        //     var dataTable = table.row($tr).data(),
        //         route_edit = '{{ route('calidadpcs.procesosCalidad.etapas')}}'+'/'+dataTable.PK_CP_Id_Proyecto;
        //     $(".content-ajax").load(route_edit);
        // });

        // table.on('click', '.edit', function(e) {
        //     e.preventDefault();
        //     $tr = $(this).closest('tr');
        //     var dataTable = table.row($tr).data(),
        //         route_edit = '{{ route('calidadpcs.proyectosCalidad.edit')}}'+'/'+ dataTable.PK_CP_Id_Proyecto;
        //     $(".content-ajax").load(route_edit);
        // });

    });
</script> 