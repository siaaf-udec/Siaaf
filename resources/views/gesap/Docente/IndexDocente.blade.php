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
    @permission('GESAP_DOCENTE')
     <!--MODAL CREAR CALIFICAR-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-decision" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create-decision', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Dar Aval Al Anteproyecto</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: textArea('AVAL_Coment',null,['label'=>'Comentario:','class'=> 'form-control', 'autofocus','maxlength'=>'1000','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su comentario para realizar la solicitud','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('AVAL_Des',['1'=>'AVALADO', '2'=>'SIN AVALAR'],null,['label'=>'DECISIÓN: ']) !!}
                            
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
            <!--MODAL CREAR CALIFICAR-->
     <!--MODAL CREAR COMENTARIO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Solicitud" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create-Solicitud', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Crear Solicitud</h1>
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
              <!--VER SOLICITUDES-->
            <!-- Modal -->
            <div class="modal fade" id="modal-ver-Solicitud" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_ver-Solicitud', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Ver Mis Solicitudes</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaSolicitudes'])
                        @slot('columns', [
                            'Solicitud',
                            'Estado',
                            'Acciones'
                        ])
                    @endcomponent   
                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--FIN VER SOLICITUDES-->

    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Anteproyectos Asignados:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('GESAP_DOCENTE_SOLICITUD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon Solicitud"
                                                       title="Solicitud">
                            <i class="fa fa-plus">
                            </i>Solicitudes
                        </a>@endpermission
                        @permission('GESAP_DOCENTE_MY_SOLICITUD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon MySolicitud"
                                                       title="Mis Solicitudes">
                            <i class="fa fa-plus">
                            </i>Mis Solicitudes
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
            <h3>Anteproyectos Asignados Como Director</h3>

                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaAnteproyecto'])
                        @slot('columns', [
                            'Titulo',
                            'Palabras clave',
                            'Descripción',
                            'Duracion en meses',
                            'Estado',
                            'Fecha Radicación',
                            'Desarrolladores',
                            'Acciones'
                        ])
                    @endcomponent
                </div>
                <br><br>
            <h3>Anteproyectos Asignados Como Jurado</h3>
    
    <br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaAnteproyectojurado'])
                    @slot('columns', [
                        'Titulo',
                        'Descripción',
                        'Duracion en meses',
                        'Fecha Radicación',
                        'Director',
                        'Estado',
                        'Desarrolladores',
                        'Acciones'
                    ])
                @endcomponent
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

    $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecciónar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        var $Widget_Select_Solicitud = $('select[name="Select_Solicitud"]');

        var route_Solicitud = '{{ route('DocenteGesap.WidgetProyecto') }}';
        $.get(route_Solicitud, function (response, status) {
        $(response.data).each(function (key, value) {
            $Widget_Select_Solicitud.append(new Option(value.NPRY_Titulo, value.PK_NPRY_IdMctr008 ));
        });
        $Widget_Select_Solicitud.val([]);
        $('#FK_NPRY_IdMctr008').val();
        });

        
        var CrearSolicitud = function () {
                return {
                    init: function () {
                        var route = '{{ route('DocenteGesap.SolicitudStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('Sol_Solicitud', $('#Sol_Solicitud').val());
                        formData.append('ID', 123456789);
                        formData.append('FK_NPRY_IdMctr008', $('select[name="Select_Solicitud"]').val());
                       


                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-create-Solicitud').modal('hide');
                                    $('#form_create-Solicitud')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                   
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                   
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form1 = $('#form_create-Solicitud');
            var rules1 = {
                
                Sol_Solicitud:{maxlength: 1000, required: true},
                Select_Solicitud:{required: true},
                
            };


            FormValidationMd.init(form1, rules1, false, CrearSolicitud()); 


        var tablesol, urlsol, columnssol;
        tablesol = $('#listaSolicitudes');
        urlsol = '{{ route('DocenteGesap.VerSolicitud')}}';
        columnssol = [
            {data: 'Sol_Solicitud', name: 'Sol_Solicitud'},
            {data: 'Sol_Estado', name: 'Sol_Estado'},
      
            {
                defaultContent: ' @permission('GESAP_DOCENTE_DELETE_SOL')<a href="javascript:;" title="Eliminar Solicitud" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission ',
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
        
      
        dataTableServer.init(tablesol, urlsol, columnssol);
        tablesol = tablesol.DataTable();

        

      tablesol.on('click', '.Eliminar', function (e) {
        
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = tablesol.row($tr).data();
        var route = '{{ route('DocenteGesap.EliminarSolicitud') }}'+'/'+dataTable.PK_Id_Solicitud;
        var type = 'DELETE';
        var async = async || false;
        swal({
                title: "¿Está seguro?",
                text: "¿Está seguro que desea Eliminar esta solicitud?",
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
                    swal("Cancelado", "No se elimino la solicitud", "error");
                }
            });

  });


            

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
            {data: 'Desarrolladores', name: 'Desarrolladores'},
      
            {
                defaultContent: ' @permission('GESAP_DOCENTE_VER_ANTE_DIRECTOR')<a href="javascript:;" title="Ver Actividades" class="btn btn-info Ver" ><i class="icon-eye"></i></a>@endpermission @permission('GESAP_DOCENTE_VER_ANTE_DIRECTOR')<a href="javascript:;" title="Calificar" class="btn btn-success Calificar" ><i class="icon-check"></i></a>@endpermission' ,
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
        var id_anteproyecto = 0 ;
        table.on('click', '.Calificar', function (e) {
            e.preventDefault();
            $('#modal-create-decision').modal('toggle');
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            id_anteproyecto = dataTable.PK_NPRY_IdMctr008;
            
        });
        var TomarDesicion = function () {
                return {
                    init: function () {
                        var route = '{{ route('DocenteGesap.CalificarAnte') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();      
                        formData.append('PK_Anteproyecto', id_anteproyecto);
                        formData.append('AVAL_Coment', $('#AVAL_Coment').val());
                        formData.append('AVAL_Des', $('#AVAL_Des').val());
                        

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-create-decision').modal('hide');
                                    $('#form_create-decision')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form2 = $('#form_create-decision');
            var rules2 = {
                AVAL_Coment:{minlength: 1, maxlength: 1000, required: true},
                AVAL_Des:{required: true},
           
             };


            FormValidationMd.init(form2, rules2, false, TomarDesicion()); 

        
        
      

     
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
            {data: 'Estado' ,name: 'Estado'},
            {data: 'Desarrolladores' ,name: 'Desarrolladores'},
           
            {
                defaultContent: ' @permission('GESAP_DOCENTE_VER_ANTE_JURADO')<a href="javascript:;" title="Ver Actividades" class="btn btn-success VerJ" ><i class="icon-eye"></i></a>@endpermission @permission('GESAP_DOCENTE_CALIFICAR_JURADO')<a href="javascript:;" title="Calificar" class="btn btn-warning Calificar" ><i class="icon-pencil"></i></a>@endpermission ' ,
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
        urlp = '{{ route('DocenteGesap.ProyectosList')}}'+ '/' + idp;//ver proyectos Director
        columnsp = [
            
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Descripcion', name: 'Descripcion'},
            {data: 'Duracion', name: 'Duracion'},
            {data: 'Fecha_Radicacion', name: 'Fecha_Radicacion'},        
            {data: 'Director', name: 'Director'},
            {data: 'Estado', name: 'Estado'},
           
            {
                defaultContent: ' @permission('GESAP_DOCENTE_VER_PRO_DIRECTOR')<a href="javascript:;" title="Ver Actividades" class="btn btn-info VerP" ><i class="icon-eye"></i></a>@endpermission ' ,
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
        urlpr = '{{ route('DocenteGesap.ProyectosListRadicados')}}'+ '/' + idpr;//ver proyectos Jurado
        columnspr = [
            
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Descripcion', name: 'Descripcion'},
            {data: 'Duracion', name: 'Duracion'},
            {data: 'Fecha_Radicacion', name: 'Fecha_Radicacion'},        
            {data: 'Director', name: 'Director'},
            {
                defaultContent: ' @permission('GESAP_DOCENTE_VER_PRO_JURADO')<a href="javascript:;" title="Ver Actividades" class="btn btn-success VerPJ" ><i class="icon-eye"></i></a>@endpermission @permission('GESAP_DOCENTE_CALIFICAR_JURADO')<a href="javascript:;" title="Calificar" class="btn btn-warning Calificar" ><i class="icon-pencil"></i></a>@endpermission ' ,
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
                $('#modal-create-Solicitud').modal('toggle');
        });
        $('.MySolicitud').on('click', function (e) {
                e.preventDefault();
                $('#modal-ver-Solicitud').modal('toggle');
        });
    

    });
</script>
@endpush