@extends('material.layouts.dashboard')

@push('styles')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Información personal nuevo')

@section('page-title', 'Listado del personal nuevo:')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Personal registrado:'])
            <div class="row">
                <div class="col-md-12">

                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                        @slot('columns', [
                            '#',
                            'Nombres',
                            'Apellidos',
                            'Cédula',
                            'Estado',
                            'Email',
                            'Rol ',
                            'Teléfono',
                            'Acciones'
                        ])
                    @endcomponent

                </div>

            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {

        var table, url,columns;
        table = $('#lista-empleados');
        url = "{{ route('talento.humano.tablaEmpleadosNuevos')}}";
    columns = [
        {data: 'DT_Row_Index'},
        {data: 'PRSN_Nombres', name: 'Nombres'},
        {data: 'PRSN_Apellidos', name: 'Apellidos'},
        {data: 'PK_PRSN_Cedula', name: 'Cédula'},
        {data: 'PRSN_Estado_Persona', name: 'Estado'},
        {data: 'PRSN_Correo', name: 'Correo Electronico'},
        {data: 'PRSN_Rol', name: 'Rol'},
        {data: 'PRSN_Telefono', name: 'Teléfono'},
        {
            defaultContent: '<a href="javascript:;" class="btn btn-primary new" ><i class="fa fa-list-ol"></i></a>',
            data:'action',
            name:'action',
            title:'Acciones',
            orderable: false,
            searchable: false,
            exportable: false,
            printable: false,
            className: 'text-center',
            render: null,
            serverSide: false,
            responsivePriority:2
        }
    ];
    dataTableServer.init(table, url, columns);
    table = table.DataTable();
    table.on('click', '.new', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();
        $.ajax({
        }).done(function(){
            window.location.href='{{ route('talento.humano.procesoInduccion') }}'+'/'+dataTable.PK_PRSN_Cedula;
        });
    });
    });
</script>
@endpush