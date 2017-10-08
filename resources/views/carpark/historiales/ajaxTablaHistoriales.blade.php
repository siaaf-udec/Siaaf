<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Historiales del parqueadero:'])
        <br>            
        <div class="row">
            <div class="col-md-12">
                <div class="actions">                    
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon reports"  title="Reporte" ><i class="glyphicon glyphicon-list-alt"></i>Reporte Historico</a><br>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaHistoriales'])
                    @slot('columns', [
                        '#',
                        'Nombre Usuario',
                        'Código Usuario',
                        'Placa',                            
                        'Código Motocicleta'
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
        table = $('#listaHistoriales');
        url = "{{ route('parqueadero.dependenciasCarpark.tablaHistoriales')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CI_NombresUser', name: 'Nombre Usuario'},   
            {data: 'CI_CodigoUser', name: 'Código Usuario'},   
            {data: 'CI_Placa', name: 'Placa'},   
            {data: 'CI_CodigoMoto', name: 'PK_CI_IdIngreso'}            
        ];
        dataTableServer.init(table, url, columns);            
        
        $( ".reports" ).on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            $.ajax({
            }).done(function(){
                window.open('{{ route('parqueadero.reportesCarpark.ReporteHistorico') }}', '_blank');
            });
        });
        
    });
</script>