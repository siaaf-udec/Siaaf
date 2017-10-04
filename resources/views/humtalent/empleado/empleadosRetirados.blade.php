@extends('material.layouts.dashboard')

@push('styles')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Información personal retirado')

@section('page-title', 'Listado del personal retirado:')

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

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var table, url,columns;
        table = $('#lista-empleados');
        url = "{{ route('talento.humano.empleado.empleadosRetirados')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PRSN_Nombres', name: 'Nombres'},
            {data: 'PRSN_Apellidos', name: 'Apellidos'},
            {data: 'PK_PRSN_Cedula', name: 'Cedula'},
            {data: 'PRSN_Estado_Persona', name: 'Estado'},
            {data: 'PRSN_Correo', name: 'Email'},
            {data: 'PRSN_Rol', name: 'Rol'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-primary edit" ><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
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
            var route = '{{ route('talento.humano.empleado.destroy') }}'+'/'+dataTable.PK_PRSN_Cedula;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Esta seguro?",
                    text: "¿Esta seguro de eliminar el empleado seleccionado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
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
                    } else {
                        swal("Cancelado", "No se eliminó ningun empleado", "error");
                    }
                });

        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('talento.humano.empleado.editarRetirado') }}'+'/'+dataTable.PK_PRSN_Cedula;
            $(".content-ajax").load(route_edit);
        });
    });
</script>
@endpush