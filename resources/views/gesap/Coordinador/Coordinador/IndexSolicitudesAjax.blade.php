@section('title', '| Información de los Anteproyectos')

@section('page-title', 'Solicitudes Universidad De Cundinamarca Extensión Facatativá:')

@section('content')
    @permission('GESAP_ADMIN')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Solicitudes registradas:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                 
                        <br>
                    </div>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaSolicitudes'])
                        @slot('columns', [
                            'Solicitud',
                            'Hecha por',
                            'Para el Proyecto o Ante',
                            'Estado',
                            'Accion'
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
        table = $('#listaSolicitudes');
      
        url = '{{ route('CoordinadorGesap.SolicitudesList')}}';
        columns = [
            {data: 'Sol_Solicitud', name: 'Sol_Solicitud'},
            {data: 'Usuario', name: 'Usuario'},
            {data: 'Proyecto', name: 'Proyecto'},
            {data: 'Sol_Estado', name: 'Sol_Estado'},
           
      
            {
                defaultContent: ' @permission('GESAP_ADMIN_VER_ANTE_DIRECTOR')<a href="javascript:;" title="Ver" class="btn btn-info Ver" ><i class="icon-eye"></i></a>@endpermission ' ,
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

        table.on('click', '.Ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_ver = '{{ route('CoordinadorGesap.VerProyectoSolicitud') }}' + '/' + dataTable.IdProyecto + '/' + dataTable.PK_Id_Solicitud;
            $(".content-ajax").load(route_ver);
        });



    });
</script>
@endpush