<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-commenting-o', 'title' => 'Observaciones'])
    @permission('Student_List_Gesap')
    @slot('actions', [
            'link_back-estudiante' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
            ],
        ])
    @endpermission
    @permission('Director_List_Gesap')
    @slot('actions', [
            'link_back-director' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
            ],
        ])
    @endpermission
    
        <div class="row">
            <div class="col-md-6">
                    {!! Field::hidden('id', $id) !!}
            </div>
            <div class="clearfix"> </div><br>
            <br>
            <br>
            <br>
            <div class="col-md-12">
                
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-observaciones'])
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id',
                    'Observacion',
                    'Jurado',
                    'Respuesta Min',
                    'Respuesta Requerimientos'
                    ])
            @endcomponent
            </div>
        </div>
    @endcomponent
       </div>


<script>
jQuery(document).ready(function () {
    var table, url,columns;
    table = $('#lista-observaciones');
    var id =    $('input[name="id"]').val();
    url = '{{ route("anteproyecto.observationsList",":id") }}';
    url = url.replace(':id',id);
    	columns=[
           {data: 'DT_Row_Index'},
           {data: 'PK_BVCS_IdObservacion', "visible": false },
           {data: 'BVCS_Observacion', className:'none', searchable: true},
           {data:  function (data, type, dataToSet) {
             console.log(data);
               if(data.encargado!=null)
                    return data.encargado.usuarios.name + " " + data.encargado.usuarios.lastname;
                else
                    return "SIN ASIGNAR"
            },searchable: true}, 
           {data: 'respuesta.RPST_RMin',
                render: function (data, type, full, meta) {
                    if(data!=null){
                        if(data=="NO FILE"){
                            return "NO APLICA";    
                        }
                        return '<a href="{{ route('download.documento') }}/'+data+'">DESCARGAR MIN</a>';
                    }
                    return "NO APLICA";
                }
            },
            {data: 'respuesta.RPST_Requerimientos',
                render: function (data, type, full, meta) {
                    if(data!=null){
                        if(data=="NO FILE"){
                            return "NO APLICA";    
                        }
                            return '<a href="{{ route('download.documento') }}/'+data+'">DESCARGAR REQUERIMIENTOS</a>';    
                    }
                    return "NO APLICA";
            }
            }
       ];
	
	dataTableServer.init(table, url, columns);

    $('#link_back-director').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('anteproyecto.index.directorList.ajax') }}';
            $(".content-ajax").load(route);
        });    
    
    
    $('#link_back-estudiante').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('anteproyecto.index.studentList.ajax') }}';
            $(".content-ajax").load(route);
        });    
    
    
});
</script>