@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Información de los Eventos')

@section('page-title', 'Listado de eventos registrados :')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Eventos registrados:'])


            <div class="row">
                <div class="col-md-12">

                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-eventos'])
                        @slot('columns', [
                            '#',
                            'llave',
                            'Evento',
                            'Fecha',
                            'Hora',
                            'Acciones'
                        ])
                    @endcomponent

                </div>

            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            var table, url,columns;
            table = $('#lista-eventos');
            url = "{{ route('talento.humano.tablaEventos')}}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'PK_EVNT_IdEvento', "visible": false },
                {data: 'EVNT_Descripcion', name: 'Evento'},
                {data: 'EVNT_Fecha', name: 'Fecha'},
                {data: 'EVNT_Hora', name: 'Hora'},
                {
                    defaultContent: '<a href="javascript:;" class="btn btn-primary edit" ><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a><a href="javascript:;" class="btn btn-simple btn-success btn-icon asistent"><i class="icon-users"></i></a>',
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
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ route('talento.humano.evento.destroy') }}'+'/'+dataTable.PK_EVNT_IdEvento;
                var type = 'DELETE';
                var async = async || false;
                $.ajax({
                    url: route,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    cache: false,
                    type: type,
                    contentType: false,
                    processData: false,
                    async: async,
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            table.ajax.reload();
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 &&  xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    }
                });
            });
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                $.ajax({
                }).done(function(){
                    window.location.href='{{ route('talento.humano.evento.edit') }}'+'/'+dataTable.PK_EVNT_IdEvento;
                });
            });
            table.on('click', '.asistent', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                $.ajax({
                }).done(function(){
                    window.location.href='{{ route('talento.humano.evento.asistentes') }}'+'/'+dataTable.PK_EVNT_IdEvento;
                });
            });
        });
    </script>
@endpush