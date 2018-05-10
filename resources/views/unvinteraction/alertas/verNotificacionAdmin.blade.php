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
                    'fecha de creacion',
                    'fecha de visualizacion',
                    'Usuario', 
                    'Apellido', 
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


@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
    App.unblockUI('.portlet-form');
    var table, url, columns;
        table = $('#Listar_Notificaciones');
        url = "{{ route('listarNotificacionesAdmin.listarNotificacionesAdmin') }}";
        columns = [
               {data: 'DT_Row_Index'},
               {data: 'PK_NTFC_Notificacion', className:'none',"visible": true, name:"PK_NTFC_Notificacion" },
               {data: 'NTFC_Titulo', searchable: true,name:"NTFC_Titulo" },
               {data: 'NTFC_Bandera', searchable: true,name:"NTFC_Bandera" },
               {data: 'created_at', searchable: true,name:"created_at" },
               {data: 'NTFC_Fecha_Vista', searchable: true,name:"NTFC_Fecha_Vista" },
               {data: 'usuario.dato_usuario.name', searchable: true,name:"usuario.dato_usuario.name"},
                {data: 'usuario.dato_usuario.lastname', searchable: true,name:"usuario.dato_usuario.lastname",className:'none'},
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