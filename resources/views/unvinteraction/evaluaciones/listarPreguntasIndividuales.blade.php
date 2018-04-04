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
<script>
jQuery(document).ready(function () {
    var table, url, columns;
        table = $('#Listar_Pasante');
        url = "{{ route('listarPreguntaIndividual.listarPreguntaIndividual',[$id]) }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'pregunta_pregunta.PRGT_Enunciado', "visible": true, name:"documento" },
            {data: 'VCPT_Puntuacion', searchable: true},
        ];
        dataTableServer.init(table, url, columns);
});
</script>
