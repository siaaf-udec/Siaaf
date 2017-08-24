@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Anteproyectos')


@section('page-title', 'Anteproyectos')

@section('page-description', 'Anteproyectos registrados')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Lista de Anteproyectos'])
    <div class="row">
        
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{{ route('min.create') }}">
                    <button id="sample_editable_1_new" class="btn green" style="margin-bottom:-8px;"> 
                        <i class="fa fa-plus"></i>
                    </button>
                </a> 
            </div>
        </div>
        <div class="clearfix"> </div><br><br>
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
                    'Estado',
                    'Min',
                    'Requerimientos',
                    'Director',
                    'Estudiante 1',
                    'Estudiante 2',
                    'Jurado 1',
                    'Jurado 2',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
@endsection



@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script>
jQuery(document).ready(function () {
    var table, url;
    table = $('#lista-anteproyecto');
    url = "{{ route('anteproyecto.list') }}";

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
           {data: 'PK_NPRY_idMinr008', "visible": false },
           {data: 'NPRY_Titulo', searchable: true},
           {data: 'NPRY_Keywords', searchable: true},
           {data: 'NPRY_Duracion',searchable: true},
           {data: 'NPRY_FechaR', className:'none',searchable: true},
           {data: 'NPRY_FechaL', className:'none',searchable: true},
           {data: 'NPRY_Estado',searchable: true},
           {data: 'RDCN_Min',className:'none',
           render: function (data, type, full, meta) {
               return '<a href="/gesap/download/'+data+'">DESCARGAR MIN</a>';}},
           {data: 'RDCN_Requerimientos',className:'none',searchable: true,
           render: function (data, type, full, meta) {
               return '<a href="/gesap/download/'+data+'">DESCARGAR REQUERIMIENTOS</a>';}},   
           {data: 'Director',className:'none',searchable: true},
           {data: 'estudiante1',className:'none',searchable: true},
           {data: 'estudiante2', className:'none',searchable: true},
           {data: 'Jurado1', className:'none',searchable: true},
           {data: 'Jurado2',className:'none',searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#myModal"><i class="icon-pencil"></i></a><a href="#" class="btn btn-simple btn-success btn-icon assign"><i class="icon-users"></i></a><form action="#" method="POST" style="display:initial;" id="delete-anteproyect"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{csrf_token()}}"><button type="submit" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></button></form>',

            
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
            window.location.href = '/gesap/min/'+O.PK_NPRY_idMinr008+'/edit';
        });
    });
    
    table.on('click', '.assign', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var O = table.row($tr).data();
	    $.ajax({
            type: "GET",
            url: '',
            dataType: "html",
        }).done(function (data) {
            window.location.href = '/gesap/anteproyecto/asignar/'+O.PK_NPRY_idMinr008;
        });
    });
    
     table.on('submit', '#delete-anteproyect', function (e) {
        e.preventDefault();
       $tr = $(this).closest('tr');
        var O = table.row($tr).data();
        $.ajax({
            url: '/gesap/min/'+O.PK_NPRY_idMinr008,
            type: $(this).attr("method"),
            data:$(this).serialize(),
            success: function(){
              table.ajax.reload();              
            }
          });
    });
   

    
});
</script>
@endpush