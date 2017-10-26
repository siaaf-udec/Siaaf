@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Utoastr Styles -->
	<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Dashboard')

@section('page-title', 'Anteproyectos/Proyectos como Director')


@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Director'])
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])
                        @slot('columns', [
                            '#' => ['style' => 'width:20px;'],
                            'id',
                            'Tipo',        
                            'Titulo',
                            'Palabras Clave',
                            'Duracion',
                            'Fecha Radicacion',
                            'Fecha Limite',
                            'Min',
                            'Requerimientos',
                            'Director',
                            'Estudiante 1',
                            'Estudiante 2',
                            'Jurado 1',
                            'Jurado 2',
                            'Estado',
                            'Acciones' => ['style' => 'width:160px;']
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>    
@endsection

@push('plugins')
    <!-- Datatables Plugins -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
	<!-- Validation Plugins -->
    <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <!-- Utoastr Plugins -->
	<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
	<!-- dropzone Plugins -->
	<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script> 
@endpush

@push('functions')
	<!--Local Scripts-->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            var table, url;
            table = $('#lista-anteproyecto');
            url = "{{ route('anteproyecto.directorList') }}";

            table.DataTable({
                lengthMenu: [
                   [5, 10, 25, 50, -1],
                   [5, 10, 25, 50, "Todo"]
                ],
                responsive: true,
                colReorder: true,
                processing: true,
                serverSide: true,
                ajax: url,
                searching: true,
                language: {
                   "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
                   "sLengthMenu": "Mostrar _MENU_ registros",
                   "sZeroRecords": "No se encontraron resultados",
                   "sEmptyTable": "Ningún dato disponible en esta tabla",
                   "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                   "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                   "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                   "sInfoPostFix": "",
                   "sSearch": "Buscar:",
                   "sUrl": "",
                   "sInfoThousands": ",",
                   "sLoadingRecords": "Cargando...",
                   "oPaginate": {
                       "sFirst": "Primero",
                       "sLast": "Último",
                       "sNext": "Siguiente",
                       "sPrevious": "Anterior"
                   },
                   "oAria": {
                       "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                       "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                   }
               },
                columns: [
                   {data: 'DT_Row_Index'},
                   {data: 'anteproyecto.PK_NPRY_IdMinr008', "visible": false },
                   {data: function (data, type, dataToSet) {
                       if(data.anteproyecto.proyecto!=null){
                           return "PROYECTO"
                       }else{
                           return "ANTEPROYECTO"
                       }
                   },searchable: true},
                   {data: 'NPRY_Titulo', searchable: true},
                   {data: 'anteproyecto.NPRY_Keywords', className:'none', searchable: true},
                   {data: 'anteproyecto.NPRY_Duracion',searchable: true},
                   {data: 'anteproyecto.NPRY_FechaR', className:'none',searchable: true},
                   {data: 'anteproyecto.NPRY_FechaL', className:'none',searchable: true},
                   {data: 'anteproyecto.radicacion.RDCN_Min',className:'none',
                        render: function (data, type, full, meta) {
                            return '<a href="{{ route('download.documento') }}/'+data+'">DESCARGAR MIN</a>';
                        }
                   },
                   {data: 'anteproyecto.radicacion.RDCN_Requerimientos',className:'none',searchable: true,
                        render: function (data, type, full, meta) {
                            if(data=="NO FILE"){
                                return "NO APLICA";    
                            }else{
                                return '<a href="{{ route('download.documento') }}/'+data+'">DESCARGAR REQUERIMIENTOS</a>';    
                            }  
                        }
                   }, 
                   {data:  function (data, type, dataToSet) {
                       if(data.anteproyecto.director[0]!=null){
                           return data.anteproyecto.director[0].usuarios.name + " " + data.anteproyecto.director[0].usuarios.lastname;
                        }else{
                            return "SIN ASIGNAR";
                        }
                   },className:'none',searchable: true},
                   {data: function (data, type, dataToSet) {
                       if(data.anteproyecto.estudiante1[0]!=null){
                           return data.anteproyecto.estudiante1[0].usuarios.name + " " + data.anteproyecto.estudiante1[0].usuarios.lastname;
                        }else{
                           return "SIN ASIGNAR"
                        }
                   },className:'none',searchable: true},
                   {data: function (data, type, dataToSet) {
                       if(data.anteproyecto.estudiante2[0]!=null){
                            return data.anteproyecto.estudiante2[0].usuarios.name + " " + data.anteproyecto.estudiante2[0].usuarios.lastname;
                       }else{
                           return "SIN ASIGNAR"
                       }
                   }, className:'none',searchable: true},
                   {data: function (data, type, dataToSet) {
                       if(data.anteproyecto.jurado1[0]!=null){
                           return data.anteproyecto.jurado1[0].usuarios.name + " " + data.anteproyecto.jurado1[0].usuarios.lastname;
                       }else{
                           return "SIN ASIGNAR"
                       }
                   }, className:'none',searchable: true},
                   {data: function (data, type, dataToSet) {
                       if(data.anteproyecto.jurado2[0]!=null){
                           return data.anteproyecto.jurado2[0].usuarios.name + " " + data.anteproyecto.jurado2[0].usuarios.lastname;
                       }else{
                           return "SIN ASIGNAR"
                       }
                   },className:'none',searchable: true},
                    
                   {data: 'NPRY_Estado',searchable: true},
                    
                   {data:'action',
                    className:'',
                    searchable: false,
                    name:'action',
                    title:'Acciones',
                    orderable: false,
                    exportable: false,
                    printable: false,
                    responsivePriority:2,
                    render: function ( data, type, full, meta ) {
                        if(full.anteproyecto.NPRY_Estado=="APROBADO"){
                            if(full.anteproyecto.proyecto==null){
                                return '@permission("See_Observations_Gesap")<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i></a>@endpermission @permission("Aproved_Project_Gesap")<a href="#" class="btn btn-simple btn-success btn-icon" id="proyecto"><i class="icon-check"></i></a>@endpermission';
                            }else{
                                if (full.anteproyecto.proyecto.PRYT_Estado=="TERMINADO") {
                                     return '<center>@permission("See_Observations_Gesap")<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i></a>@endpermission @permission("See_Activity_Gesap")<a href="#" class="btn btn-simple btn-success btn-icon " id="actividades"><i class="icon-list"></i></a>@endpermission</center>';
                                 } else {
                                    return '@permission("See_Observations_Gesap")<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i></a>@endpermission @permission("See_Activity_Gesap")<a href="#" class="btn btn-simple btn-success btn-icon " id="actividades"><i class="icon-list"></i></a>@endpermission @permission("Close_Project_Gesap")<a href="#" class="btn btn-simple btn-success btn-icon delete "  id="close"><i class="icon-lock"></i></a>@endpermission';
                                 } 
                                
                            }
                        }else{
                            return '@permission("See_Observations_Gesap")<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-eye"></i>Ver Observaciones</a>@endpermission';
                        }
                     }, 
                   }
               ],
                buttons: [
               { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
               { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
               { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
               { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
               { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
               { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
               {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
                   action: function ( e, dt, node, config ) {
                       dt.ajax.reload();
                   }
               }

           ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            });
            
            table = table.DataTable();
            
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
                $.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
                    route = '{{ route('evaluar.show') }}'+'/'+O.anteproyecto.PK_NPRY_IdMinr008;
                    $(".content-ajax").load(route);
                });
            });
    
            table.on('click', '#proyecto', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
				route = '{{ route('proyecto.aprobado') }}'+'/'+O.anteproyecto.PK_NPRY_IdMinr008;
                var type = 'GET';
                var async = async || false;
                swal({
                    title: "¿Esta seguro?",
                    text: "Esta aprobando la continuacion del anteproyecto a un proyecto",
                    type: "info",
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
                                    if (request.status === 422 &&  xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                            swal.close();
                        } else {
                            swal("Cancelado", "No se eliminó ningun proyecto", "error");
                        }
                    }
                );
    });
            
            table.on('click', '#close', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
				route = '{{ route('proyecto.cerrar') }}'+'/'+O.anteproyecto.PK_NPRY_IdMinr008;
                var type = 'GET';
                var async = async || false;
                swal({
                    title: "¿Esta seguro?",
                    text: "Esta cerrando el proyecto,No se podra crear o modificar datos ni documentos",
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
                                    if (request.status === 422 &&  xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                            swal.close();
                        } else {
                            swal("Cancelado", "No se cerró ningun proyecto", "error");
                        }
                    }
                );
    });
    
    table.on('click', '#actividades', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
                $.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
                    route = '{{ route('proyecto.actividades') }}'+'/'+O.anteproyecto.PK_NPRY_IdMinr008;
                    $(".content-ajax").load(route);
                });
            });
            
            
            table.on('click','.boton_mas_info',function(){
 
                if($(this).parent().find('.texto-ocultado').css('display') == 'none'){
                    $(this).parent().find('.texto-ocultado').css('display','inline');
                    $(this).parent().find('.puntos').html(' ');
                    $(this).text('Ver menos');
                } else {
                    $(this).parent().find('.texto-ocultado').css('display','none');
                    $(this).parent().find('.puntos').html('...');
                    $(this).html('Ver más');
                };
            });            
            
        });
</script>
@endpush