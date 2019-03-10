@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet"
      type="text/css"/>
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>

<!-- File Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

<!-- Modal Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>

<!-- Date Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('title', '| Información de los Proyectos')

@section('page-title', 'Proyectos Universidad De Cundinamarca Extensión Facatativá:')

@section('content')
    @permission('ADMIN_GESAP')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Anteproyectos registrados:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                    @permission('GESAP_ADMIN_MCT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Gestionar Libro
                        </a>@endpermission
                        @permission('GESAP_REPORT_USER')<a href="javascript:;"
                                                       class="btn btn-simple btn-success btn-icon reports"
                                                       title="Reporte"><i class="glyphicon glyphicon-list-alt"></i>Reporte
                            de Proyectos</a>
                            @endpermission
                        <br>
                    </div>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaAnteproyecto'])
                        @slot('columns', [
                            'Titulo',
                            'Palabras clave',
                            'Descripción',
                            'Duracion',
                            'Director',
                            'Estado',
                            'Fecha Radicación',
                            'Acciones'
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>
    @endpermission
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/main/scripts/table-datatable.js') }}" type = "text/javascript" ></script>
    <script type="text/javascript">

    jQuery(document).ready(function () {

        var table, url, columns;
        table = $('#listaAnteproyecto');
        url = "{{ route('Proyectos.List')}}";
        columns = [
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Palabras', name: 'Palabras'},
            {data: 'Descripcion', name: 'Descripcion'},
            {data: 'Duracion', name: 'Duracion'},
            {data: 'Director', name: 'Director'},
            {data: 'Estado', name: 'Estado'},
            {data: 'Fecha', name: 'Fecha'},
      
            {
                defaultContent: '@permission('REPORT_GESAP')<a href="javascript:;" class="btn btn-warning reporte"  title="Reporte" ><i class="fa fa-table"></i></a>@endpermission @permission('VER_ANTE')<a href="javascript:;" title="Ver" class="btn btn-primary Ver" ><i class="icon-eye"></i></a>@endpermission @permission('DELETE_ANTE')<a href="javascript:;" title="Cancelar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission' ,
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
 
        
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('Proyecto.Cancelar') }}' + '/' + dataTable.PK_Id_Proyecto;
            var type = 'GET';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro que desea CANCELAR este Proyecto?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
                                        console.log(response);
                                        if (request.status === 200 && xhr === 'success') {
                                            if (response.data == 422) {
                                                xhr = "warning"
                                                UIToastr.init(xhr, response.title, response.message);
                                                App.unblockUI('.portlet-form');
                                               
                                               
                                            } else {
                                                table.ajax.reload();
                                                UIToastr.init(xhr, response.title, response.message);
                                              
                           
                                                }
                                        }
                        },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se CANCELO ningun Proyecto", "error");
                    }
                });

        });
        table.on('click', '.Ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_ver = '{{ route('Proyectos.VerProyecto') }}' + '/' + dataTable.PK_Id_Proyecto;
            $(".content-ajax").load(route_ver);
        });
        $(".gestionar").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Proyecto.Libro') }}';
            $(".content-ajax").load(route);
        });
        

    });
</script>
@endpush