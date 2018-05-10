@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTA PREGUNTAS REALIZADAS '])
<br><br>
    <div class="row">
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Pasante'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Enunciado',
                    'Nota',
                    
                ])
            @endcomponent
        </div>
    </div>

    @endcomponent
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
     App.unblockUI('.portlet-form');
    var table, url, columns;
        table = $('#Listar_Pasante');
        url = "{{ route('listarPreguntaIndividual.listarPreguntaIndividual',[$id]) }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'pregunta_pregunta.PRGT_Enunciado', "visible": true, name:"pregunta_pregunta.PRGT_Enunciado" },
            {data: 'VCPT_Puntuacion', searchable: true,name:"VCPT_Puntuacion"},
        ];
        dataTableServer.init(table, url, columns);
});
</script>
