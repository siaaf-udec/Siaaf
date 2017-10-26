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
    var table, url;
    table = $('#lista-observaciones');
    var id =    $('input[name="id"]').val();
    url = '{{ route("anteproyecto.observationsList",":id") }}';
    url = url.replace(':id',id);
    table.DataTable({
       lengthMenu: [
           [5, 10, 25, 50, -1],
           [5, 10, 25, 50, "Todo"]
       ],
       responsive: true,
       colReorder: true,
       processing: true,
       serverSide: true,
       ajax: url,
       searching: true,
       language: {
           "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
           "sLengthMenu": "Mostrar _MENU_ registros",
           "sZeroRecords": "No se encontraron resultados",
           "sEmptyTable": "Ningún dato disponible en esta tabla",
           "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
           "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
           "sInfoPostFix": "",
           "sSearch": "Buscar:",
           "sUrl": "",
           "sInfoThousands": ",",
           "sLoadingRecords": "Cargando...",
           "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
           },
           "oAria": {
               "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
           }
       },
        
    columns:[
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
       ],
       buttons: [
           { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
           { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
           { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
           { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
           { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
           { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
           {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
               }
           }

       ],
       pageLength: 10,
       dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });

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