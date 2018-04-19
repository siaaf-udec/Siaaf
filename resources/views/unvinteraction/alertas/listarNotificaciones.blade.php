@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Lista de Notificaciones')


@section('page-title', 'Lista de Notificaciones')

@section('page-description', 'Notificaciones')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR NOTIFICACIONES'])

<br><br>
    <div class="row">
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Notificaciones'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'ID',
                    'Titulo',
                    'Visto',       
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
 

@endsection



@push('plugins')
<!-- Datatables Plugins -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script>
jQuery(document).ready(function () {
    var table, url, columns;
        table = $('#Listar_Notificaciones');
        url = "{{ route('listarAlerta.listarAlerta') }}";
        columns = [
               {data: 'DT_Row_Index'},
               {data: 'PK_NTFC_Notificacion', className:'none',"visible": true, name:"PK_NTFC_Notificacion" },
               {data: 'NTFC_Titulo', searchable: true,name:"NTFC_Titulo" },
               {data: 'NTFC_Bandera', searchable: true,name:"NTFC_Bandera" },
               {data:'action',searchable: false,
                name:'action',
                title:'Acciones',
                orderable: false,
                exportable: false,
                printable: false,
                defaultContent: '<a href="#" id="editar" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon ver"><i class="icon-eye"></i></a>'
           }
        ];
    dataTableServer.init(table, url, columns);
    table = table.DataTable();
    table.on('click', '.ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('verAlerta.verAlerta')}}/'+dataTable.PK_NTFC_Notificacion;

            $(".content-ajax").load(route_edit);
        });
   
      
});
</script>
@endpush