

<div class="col-md-12">
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Lista De Anteproyectos:'])
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    @permission('ADD_USER_GESAP')<a href="javascript:;"
                                                      class="btn btn-simple btn-success btn-icon create"
                                                      title="Registar nuevo usuario">
                        <i class="fa fa-plus">
                        </i>Nuevo
                    </a>@endpermission
                    @permission('REPORT_GESAP')<a href="javascript:;"
                                                      class="btn btn-simple btn-success btn-icon reports"
                                                      title="Reporte"><i class="glyphicon glyphicon-list-alt"></i>Reporte
                        Anteproyecto</a>@endpermission
                    <br>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyectos'])
                        @slot('columns', [
                      
                        'Id',
                        'Titulo',
                        'Palabras Clave',
                        'Duracion',
                        'Fecha Inicio',
                        'Fecha Fin',
                        'Estado'
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

        var table, url, columns;
        table = $('#lista-anteproyectos');
        url = "{{ route('anteproyectos.List')}}";
        columns = [
                {data: 'PK_NPRY_IdMctr008', name: 'PK_NPRY_IdMctr008'},
                {data: 'NPRY_Titulo', name: 'NPRY_Titulo'},
                {data: 'NPRY_Keywords', name: 'NPRY_Keywords'},
                {data: 'NPRY_Duracion', name: 'NPRY_Duracion'},
                {data: 'NPRY_FechaR', name: 'NPRY_FechaR'},
                {data: 'NPRY_FechaL', name: 'NPRY_FechaL'},
                {data: 'NPRY_Estado', name: 'NPRY_Estado'},
         );
    }
</script>
