<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'FILTRO DE EVALUACION POR FECHA'])
    <div class="col-md-12">
                    <div class="actions">
                        <a id="archivo3" href="documentoReporte/{{$id}}/{{$fechaPrimera}}/{{$fechaSegunda}}" class="btn btn-simple btn-success btn-icon create" title="imprimir" target="_blank"><i class="fa fa-plus"></i>IMPRIMIR</a>
                    </div>
         </div>
        <div class="row">
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Pasante'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Codigo Evaluacion',
                    'Nombre Evaluador',
                    'Apellido Evaluador',
                    'Convenio',
                    'Nota_Final',
                    'Acciones' => ['style' => 'width:px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
</div>

<script >
jQuery(document).ready(function () {
     App.unblockUI('.portlet-form');
    $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('alertaAjax.alertaAjax') }}';
            $(".content-ajax").load(route);
        });
    var table, url;
    table = $('#Listar_Pasante');
    url = "{{ route('listarReporte.listarReporte',[$id,$fechaPrimera,$fechaSegunda]) }}";
     columns = [
           {data: 'DT_Row_Index'},
           {data: 'PK_VLCN_Evaluacion', className:'none', "visible": true, name:"PK_VLCN_Evaluacion" },
           {data: 'evaluador.dato_usuario.name',className:'none', searchable: true, name:"evaluador.dato_usuario.name"},
           {data: 'evaluador.dato_usuario.lastname', className:'none',searchable: true, name:"evaluador.dato_usuario.lastname"},
           {data: 'convenios_evaluacion.CVNO_Nombre', searchable: true, name:"convenios_evaluacion.CVNO_Nombre"},
           {data: 'VLCN_Nota_Final', searchable: true, name:"VLCN_Nota_Final"},
           {data: 'action',
            name: 'action',
            title: 'Acciones',
            orderable: false,
            searchable: false,
            exportable: false,
            printable: false,
            className: 'text-center',
            render: null,
            serverSide: false,
            responsivePriority: 2,
            defaultContent: '<a href="#" title="ver preguntas" class="btn btn-simple btn-warning btn-icon editar"><i class="icon-pencil"> VER </i></a>'
           }
     ];
        dataTableServer.init(table, url, columns); 
      
       
    
    
   table = table.DataTable();
    table.on('click', '.editar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{route('listarPreguntaEvaluacion.listarPreguntaEvaluacion')}}/'+dataTable.PK_VLCN_Evaluacion;
     $(".content-ajax").load(route_edit);
        });
    
  });   
</script>
