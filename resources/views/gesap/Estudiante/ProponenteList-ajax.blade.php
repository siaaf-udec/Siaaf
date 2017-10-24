<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Proyectos'])
        <div class="row">
        
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id',
                    'Titulo',
                    'Palabras Clave',
                    'Duracion',
                    'Fecha Radicacion',
                    'Fecha Limite',
                    'Min',
                    'Requerimientos',
                    'Director',
                    'Estudiante 1',
                    'Estudiante 2',
                    'Jurado 1',
                    'Jurado 2',
                    'Estado',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    
    @endcomponent
</div>

<script>
jQuery(document).ready(function () {
    var table, url;
    table = $('#lista-anteproyecto');
    url = "{{ route('anteproyecto.studentList') }}";

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
           {data: 'anteproyecto.PK_NPRY_IdMinr008', "visible": false },
           {data: 'anteproyecto.NPRY_Titulo', searchable: true},
           {data: 'anteproyecto.NPRY_Keywords', searchable: true},
           {data: 'anteproyecto.NPRY_Duracion',searchable: true},
           {data: 'anteproyecto.NPRY_FechaR', className:'none',searchable: true},
           {data: 'anteproyecto.NPRY_FechaL', className:'none',searchable: true},
           {data: 'anteproyecto.radicacion.RDCN_Min',className:'none',
                        render: function (data, type, full, meta) 
                        {
                            return '<a href="/gesap/download/'+data+'">DESCARGAR MIN</a>';
                        }
                    },
                    {data: 'anteproyecto.radicacion.RDCN_Requerimientos',className:'none',searchable: true,
                        render: function (data, type, full, meta) 
                        {
                            if(data=="NO FILE"){
                                return "NO FILE";    
                            }else{
                                return '<a href="/gesap/download/'+data+'">DESCARGAR REQUERIMIENTOS</a>';    
                            }  
                        }
                    }, 
           {data:  function (data, type, dataToSet) {
                        if(data.anteproyecto.director[0]!=null)
                            return data.anteproyecto.director[0].usuarios.name + " " + data.anteproyecto.director[0].usuarios.lastname;
                        else
                            return "No hay asignado"
                    },className:'none',searchable: true},

                    {data: function (data, type, dataToSet) {
                        if(data.anteproyecto.estudiante1[0]!=null)
                            return data.anteproyecto.estudiante1[0].usuarios.name + " " + data.anteproyecto.estudiante1[0].usuarios.lastname;
                        else
                            return "No hay asignado"
                    },className:'none',searchable: true},
                    {data: function (data, type, dataToSet) {
                        if(data.anteproyecto.estudiante2[0]!=null)
                        return data.anteproyecto.estudiante2[0].usuarios.name + " " + data.anteproyecto.estudiante2[0].usuarios.lastname;
                        else
                            return "No hay asignado"
                    }, className:'none',searchable: true},
                    {data: function (data, type, dataToSet) {
                        if(data.anteproyecto.jurado1[0]!=null)
                        return data.anteproyecto.jurado1[0].usuarios.name + " " + data.anteproyecto.jurado1[0].usuarios.lastname;
                        else
                            return "No hay asignado"
                    }, className:'none',searchable: true},
                    {data: function (data, type, dataToSet) {
                        if(data.anteproyecto.jurado2[0]!=null)
                        return data.anteproyecto.jurado2[0].usuarios.name + " " + data.anteproyecto.jurado2[0].usuarios.lastname;
                        else
                            return "No hay asignado"
                    },className:'none',searchable: true},
           {data: 'NPRY_Estado',searchable: true},
                      {data:'action',
             className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            responsivePriority:2,
            render: function ( data, type, full, meta ) {
                if(full.anteproyecto.proyecto!=null){
                    return '<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i></a><a href="#" class="btn btn-simple btn-success btn-icon create"><i class="icon-list"></i></a>';
                }else{
                    return '<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i></a>';
                }
                 },
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
table = table.DataTable();
    table.on('click', '.edit', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var O = table.row($tr).data();
	    $.ajax({
            type: "GET",
            url: '',
            dataType: "html",
        }).done(function (data) {
            route = '/gesap/show/'+O.anteproyecto.PK_NPRY_IdMinr008;
            $(".content-ajax").load(route);
        });
    });
    
    table.on('click', '.create', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var O = table.row($tr).data();
	    $.ajax({
            type: "GET",
            url: '',
            dataType: "html",
        }).done(function (data) {
            route = '/gesap/actividades/'+O.anteproyecto.PK_NPRY_IdMinr008;
            $(".content-ajax").load(route);
        });
    });
    
    
});
</script>