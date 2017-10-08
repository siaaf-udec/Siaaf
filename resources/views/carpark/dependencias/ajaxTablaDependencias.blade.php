<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Dependencias Registradas:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Registar nueva dependencia">
                            <i class="fa fa-plus">
                            </i>Nueva
                        </a>
                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon reports"  title="Reporte" ><i class="glyphicon glyphicon-list-alt"></i>Reporte de Dependencias</a><br>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaDependencias'])
                        @slot('columns', [
                            '#',
                            'Dependencia',                            
                            'Acciones'
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        var table, url,columns;
        table = $('#listaDependencias');
        url = "{{ route('parqueadero.dependenciasCarpark.tablaDependencias')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CD_Dependencia', name: 'Dependencia'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>',
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
        
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                routeEditAjax='{{ route('parqueadero.dependenciasCarpark.edit') }}'+'/'+dataTable.PK_CD_IdDependencia;
            $(".content-ajax").load(routeEditAjax);
        });        

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.dependenciasCarpark.create') }}';
            $(".content-ajax").load(route);
        });

        $( ".reports" ).on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $.ajax({
            }).done(function(){
                window.open('{{ route('parqueadero.reportesCarpark.reporteDependencia') }}', '_blank');
            });
        });
    });
</script>