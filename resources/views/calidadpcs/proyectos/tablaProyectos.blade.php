@extends('material.layouts.dashboard')

@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css"/>

<!-- File Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

<!-- Modal Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>

<!-- Date Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('title', '| Proyectos Calidad')

@section('page-title', 'Proyectos de Calidad (PMBOK, CMMI & SCRUM):')

@section('content')
    @permission('ADMIN_CALIDADPCS')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Proyectos:'])
            <div class="row">
                <div class="col-md-12">

                    <div class="actions">
                        <a href="javascript:;"
                            class="btn btn-simple btn-success btn-icon create"
                            title="Crear un nuevo proyecto"><i class="glyphicon glyphicon-plus"></i>Agregar Proyecto</a>
                        <br>
                    </div>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
                        @slot('columns', [
                            '#',
                            'Nombre Proyecto',
                            'Fecha inicial',
                            'Fecha final',
                            '',
                            ''
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

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/main/scripts/table-datatable.js') }}" type = "text/javascript" ></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script type="text/javascript">

    
    jQuery(document).ready(function () {
        var fechaEmision = moment('2019/07/31');
        var fechaExpiracion = moment('2019/10/01');
        var diasDiferencia = fechaExpiracion.diff(fechaEmision, 'weeks');
        console.log(diasDiferencia);

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.proyectosCalidad.tablaProyectos')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CP_Nombre_Proyecto', name: 'CP_Nombre_Proyecto'},
            {data: 'CP_Fecha_Inicio', name: 'CP_Fecha_Inicio'},
            {data: 'CP_Fecha_Final', name: 'CP_Fecha_Final'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Ver los procesos de este Proyecto" ><i class="fa fa-list-ul"></i></a>',
                data: 'action',
                name: 'Etapas',
                title: 'Etapas',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            },
            {
                defaultContent: '<a href="javascript:;" title="Editar" class="btn btn-primary edit" ><i class="icon-pencil"></i></a><a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a> ',
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
        
        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.RegistrarProyecto') }}' + '/' + {{ Auth::user()->id }} ;
            $(".content-ajax").load(route);
        });

        table.on('click', '.verEtapas', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('calidadpcs.procesosCalidad.etapas') }}' + '/' + dataTable.PK_CP_Id_Proyecto;
            $(".content-ajax").load(route_edit);            
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('calidadpcs.proyectosCalidad.edit') }}' + '/' + dataTable.PK_CP_Id_Proyecto;
            $(".content-ajax").load(route_edit);
        });
                
    });
</script>
@endpush