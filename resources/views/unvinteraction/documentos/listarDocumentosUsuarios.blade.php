@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'DOCUMENTOS USUARIOS'])
<div class="row">
    <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Documentos'])
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'ID',
                    'Nombre',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
    </div>
</div>

@endcomponent
{{--
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
--}}
 <script>
jQuery(document).ready(function () {
    var id;
    var table, url, columns;
        table = $('#Listar_Documento');
        url = "{{ route('listarDocumentoUsuario.listarDocumentoUsuario',[$id]) }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_DCET_Documentacion_Extra', "visible": true, name:"documento",className:'none' },
           {data: 'DCET_Nombre',searchable: true},
           {   data:"PK_DCET_Documentacion_Extra",
               name:'action',
               title:'Acciones',
               orderable: false,
               searchable: false,
               exportable: false,
               printable: false,
               className: '',   
               render: function ( data, type, full, meta ) {
                   return '<a href="{{ route('documentoDescargaUsuario.documentoDescargaUsuario') }}/'+data+'" target="_blank" class="btn btn-simple "><i class="fa fa-cloud-download"></i></a>';
                },
                responsivePriority:2
                
               
           }
        ];
     dataTableServer.init(table, url, columns);
    table = $('#Listar_Documentos');
    url = "{{ route('listarDocumentoUsuario.listarDocumentoUsuario',[$id]) }}";
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
           {data: 'PK_DCET_Documentacion_Extra', "visible": true, name:"documento",className:'none' },
           {data: 'DCET_Nombre',searchable: true},
           {   data:"PK_DCET_Documentacion_Extra",
               name:'action',
               title:'Acciones',
               orderable: false,
               searchable: false,
               exportable: false,
               printable: false,
               className: '',   
               render: function ( data, type, full, meta ) {
                 return '<a href="/siaaf/public/index.php/interaccion-universitaria/descargaUsuario/'+data+'" target="_blank" class="btn btn-simple "><i class="fa fa-cloud-download"></i></a>';
                },
                responsivePriority:2
                
               
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
    
});
</script>
