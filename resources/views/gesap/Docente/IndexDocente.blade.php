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

@section('title', '| Información de los Anteproyectos')

@section('page-title', 'Anteproyectos Universidad De Cundinamarca Extensión Facatativá:')
 

@section('content')
    @permission('DOCENTE_GESAP')
     <!--MODAL CREAR COMENTARIO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-solicitud" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_create-solicitud', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Comentario</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: textArea('Sol_Solicitud',null,['label'=>'Comentario:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su comentario para realizar la solicitud','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('FK_NPRY_IdMctr008', null,['name' => 'Select_Solicitud','label'=>'Proyecto o Anteproyecto al cual desea hacer la solicitud: ']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--MODAL CREAR COMENTARIO-->
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Anteproyectos Asignados:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('DOCENTE_SOLICITUD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon Solicitud"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Solicitudes
                        </a>@endpermission
                       
                        <!-- @permission('DOCENTE_REPORT_USER')<a href="javascript:;"
                                                       class="btn btn-simple btn-success btn-icon reports"
                                                       title="Reporte"><i class="glyphicon glyphicon-list-alt"></i>Reporte
                            de Anteproyectos</a>@endpermission
                        <br> -->
                    </div>

                </div>
            </div>
            <br>
            <div class="row">
            <h3>Anteproyectos Asignados</h3>

                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaAnteproyecto'])
                        @slot('columns', [
                            'Titulo',
                            'Palabras clave',
                            'Descripción',
                            'Duracion',
                            'Estado',
                            'Fecha Radicación',
                            'Acciones'
                        ])
                    @endcomponent
                </div>
                <br><br>
            <h3>Anteproyectos Asignados como Jurado</h3>
    
    <br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaAnteproyectojurado'])
                    @slot('columns', [
                        'Titulo',
                        'Descripción',
                        'Duracion',
                        'Fecha Radicación',
                        'Director',
                        'Acciones'
                    ])
                @endcomponent
            </div>
    <h3>Proyectos Asignados</h3>
    
    <br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaProyectos'])
                    @slot('columns', [
                        'Titulo',
                        'Descripción',
                        'Duracion',
                        'Fecha Radicación',
                        'Director',
                        'Estado',
                        'Acciones'
                    ])
                @endcomponent
            </div>
    <h3>Proyectos Asigandos como Jurado</h3>
    
    <br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaProyetoJurado'])
                    @slot('columns', [
                        'Titulo',
                        'Descripción',
                        'Duracion',
                        'Fecha Radicación',
                        'Director',
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
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

    @endpush
    @push('functions')
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/main/scripts/table-datatable.js') }}" type = "text/javascript" ></script>
    <script type="text/javascript">
jQuery(document).ready(function () {

        var table, url, columns;
        table = $('#listaAnteproyecto');
        id = 123400009 ;
        url = '{{ route('DocenteGesap.Anteproyectolist')}}'+ '/' + id;
        columns = [
            {data: 'NPRY_Titulo', name: 'NPRY_Titulo'},
            {data: 'NPRY_Keywords', name: 'NPRY_Keywords'},
            {data: 'NPRY_Descripcion', name: 'NPRY_Descripcion'},
            {data: 'NPRY_Duracion', name: 'NPRY_Duracion'},
           
            {data: 'Estado', name: 'Estado'},
            {data: 'NPRY_FCH_Radicacion', name: 'NPRY_FCH_Radicacion'},
      
            {
                defaultContent: ' @permission('VER_ANTE_DIRECTOR')<a href="javascript:;" title="Ver" class="btn btn-info Ver" ><i class="icon-eye"></i></a>@endpermission ' ,
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
                route_ver = '{{ route('DocenteGesap.VerAnteproyecto') }}' + '/' + dataTable.PK_NPRY_IdMctr008;
            $(".content-ajax").load(route_ver);
        });

        var table1, url1, columns1;
        table1 = $('#listaAnteproyectojurado');
        idj = 111100009;//variable de sesion
        url1 = '{{ route('DocenteGesap.AnteproyectoListJurado')}}'+ '/' + idj;
        columns1 = [
            
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Descripcion', name: 'Descripcion'},
            {data: 'Duracion', name: 'Duracion'},
            {data: 'Fecha_Radicacion', name: 'Fecha_Radicacion'},        
            {data: 'Director', name: 'Director'},
           
            {
                defaultContent: ' @permission('VER_ANTE_JURADO')<a href="javascript:;" title="Ver" class="btn btn-success VerJ" ><i class="icon-eye"></i></a>@endpermission @permission('CALIFICAR_JURADO')<a href="javascript:;" title="Calificar" class="btn btn-warning Calificar" ><i class="icon-pencil"></i></a>@endpermission ' ,
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
        
        dataTableServer.init(table1, url1, columns1);
        table1 = table1.DataTable();

        var tablep, urlp, columnsp;
        tablep = $('#listaProyectos');
        idp = 123400009;//variable de sesion
        urlp = '{{ route('DocenteGesap.ProyectosList')}}'+ '/' + idp;
        columnsp = [
            
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Descripcion', name: 'Descripcion'},
            {data: 'Duracion', name: 'Duracion'},
            {data: 'Fecha_Radicacion', name: 'Fecha_Radicacion'},        
            {data: 'Director', name: 'Director'},
            {data: 'Estado', name: 'Estado'},
           
            {
                defaultContent: ' @permission('VER_PRO_DIRECTOR')<a href="javascript:;" title="Ver" class="btn btn-info VerP" ><i class="icon-eye"></i></a>@endpermission ' ,
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
        
        dataTableServer.init(tablep, urlp, columnsp);
        tablep = tablep.DataTable();
        
        var tablepr, urlpr, columnspr;
        tablepr = $('#listaProyetoJurado');
        idpr = 111100009;//variable de sesion
        urlpr = '{{ route('DocenteGesap.ProyectosListRadicados')}}'+ '/' + idpr;
        columnspr = [
            
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Descripcion', name: 'Descripcion'},
            {data: 'Duracion', name: 'Duracion'},
            {data: 'Fecha_Radicacion', name: 'Fecha_Radicacion'},        
            {data: 'Director', name: 'Director'},
            {
                defaultContent: ' @permission('VER_PRO_JURADO')<a href="javascript:;" title="Ver" class="btn btn-success VerPJ" ><i class="icon-eye"></i></a>@endpermission @permission('ANTE_JURADO')<a href="javascript:;" title="Calificar" class="btn btn-warning Calificar" ><i class="icon-pencil"></i></a>@endpermission ' ,
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
        
        dataTableServer.init(tablepr, urlpr, columnspr);
        tablepr = tablepr.DataTable();
        
        tablepr.on('click', '.VerPJ', function (e) {
           
           e.preventDefault();
           $tr = $(this).closest('tr');
           var dataTable = tablepr.row($tr).data(),
               route_verP = '{{ route('DocenteGesap.VerActividadesProyectoJurado') }}' + '/' + dataTable.Codigo;
           $(".content-ajax").load(route_verP);
       });

       tablepr.on('click', '.Calificar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = tablepr.row($tr).data(),
                route_ver = '{{ route('DocenteGesap.CalificarProyectoJurado') }}' + '/' + dataTable.Codigo;
            $(".content-ajax").load(route_ver);
        });


        tablep.on('click', '.VerP', function (e) {
           
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = tablep.row($tr).data(),
                route_verP = '{{ route('DocenteGesap.VerActividadesProyecto') }}' + '/' + dataTable.Codigo;
            $(".content-ajax").load(route_verP);
        });

        table1.on('click', '.VerJ', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table1.row($tr).data(),
                route_ver = '{{ route('DocenteGesap.VerAnteproyectoJurado') }}' + '/' + dataTable.Codigo;
            $(".content-ajax").load(route_ver);
        });
        table1.on('click', '.Calificar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table1.row($tr).data(),
                route_ver = '{{ route('DocenteGesap.CalificarJurado') }}' + '/' + dataTable.Codigo;
            $(".content-ajax").load(route_ver);
        });

        $('.Solicitud').on('click', function (e) {
                e.preventDefault();
                $('#modal-create-solicitud').modal('toggle');
        });
    

    });
</script>
@endpush