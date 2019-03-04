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

@section('title', '| Información de Gesap')

@section('page-title', ' Universidad De Cundinamarca Extensión Facatativá:')

@section('content')
    @permission('ADMIN_GESAP')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Gesap: '])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                    
                    @permission('GESAP_SOLICITUD_STUDENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Solicitudes
                    </a>@endpermission
                    @permission('GESAP_SOLICITUD_STUDENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon Banco"
                                                       title="Banco De Proyectos">
                            <i class="fa fa-plus">
                            </i>Banco De proyetos
                    </a>@endpermission
                       
                        
                        <br>
                    </div>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                <h4>Anteproyecto De Grado </h4>
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
                    <br><br>
                    <br><br>
                    <h4>Proyecto De Grado </h4>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listaProyecto'])
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
        id = 123456789 ;
        url = '{{ route('EstudianteGesap.Desarrolladores')}}'+ '/' + id;
        columns = [
            {data: 'NPRY_Titulo', name: 'NPRY_Titulo'},
            {data: 'NPRY_Keywords', name: 'NPRY_Keywords'},
            {data: 'NPRY_Descripcion', name: 'NPRY_Descripcion'},
            {data: 'NPRY_Duracion', name: 'NPRY_Duracion'},
           
            {data: 'Estado', name: 'Estado'},
            {data: 'NPRY_FCH_Radicacion', name: 'NPRY_FCH_Radicacion'},
      
            {
                defaultContent: ' @permission('VER_ACTIVIDAD')<a href="javascript:;" title="Actividades" class="btn btn-warning Actividades" ><i class="icon-folder"></i></a>@endpermission @permission('RADICAR_ANTE')<a href="javascript:;" title="Radicar" class="btn btn-success Radicar" ><i class="icon-pencil"></i></a>@endpermission @permission('VER_ACTIVIDAD')<a href="javascript:;" title="Ver Comentarios de los Jurados" class="btn btn-success Ver" ><i class="icon-eye"></i></a>@endpermission' ,
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

        table.on('click', '.Actividades', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.VerActividades') }}' + '/' + dataTable.PK_NPRY_IdMctr008;
            $(".content-ajax").load(route);

     //       $(".content-ajax").load(route_ver);
        });

        
        table.on('click', '.Ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.VerComentariosJuradoAnteproyecto') }}' + '/' + dataTable.PK_NPRY_IdMctr008;
            $(".content-ajax").load(route);

     //       $(".content-ajax").load(route_ver);
        });
        table.on('click', '.Radicar', function (e) {
      
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.RADICAR') }}'+'/'+dataTable.PK_NPRY_IdMctr008;
            var type = 'GET';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro que desea radicar el anteproyecto?",
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
                        swal("Cancelado", "No se radico el anteproyecto", "error");
                    }
                });

        });
        var tablep, urlp, columnsp;
        tablep = $('#listaProyecto');
        idp = 123456189 ;
        urlp = '{{ route('EstudianteGesap.ListaProyecto')}}'+ '/' + id;
        columnsp = [
            {data: 'NPRY_Titulo', name: 'NPRY_Titulo'},
            {data: 'NPRY_Keywords', name: 'NPRY_Keywords'},
            {data: 'NPRY_Descripcion', name: 'NPRY_Descripcion'},
            {data: 'NPRY_Duracion', name: 'NPRY_Duracion'},
            {data: 'Estado', name: 'Estado'},
            {data: 'Fecha', name: 'Fecha'},
      
            {
                defaultContent: ' @permission('VER_ACTIVIDAD')<a href="javascript:;" title="Actividades" class="btn btn-warning Actividades" ><i class="icon-folder"></i></a>@endpermission @permission('RADICAR_ANTE')<a href="javascript:;" title="Radicar" class="btn btn-success RadicarP" ><i class="icon-pencil"></i></a>@endpermission @permission('VER_ACTIVIDAD')<a href="javascript:;" title="Ver Comentarios de los Jurados" class="btn btn-success Ver" ><i class="icon-eye"></i></a>@endpermission' ,
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
        
      tablep.on('click', '.RadicarP', function (e) {
      
      e.preventDefault();
      $tr = $(this).closest('tr');
      var dataTable = tablep.row($tr).data();
      var route = '{{ route('EstudianteGesap.RADICARPROYECTO') }}'+'/'+dataTable.PK_NPRY_IdMctr008;
      var type = 'GET';
      var async = async || false;
      swal({
              title: "¿Está seguro?",
              text: "¿Está seguro que desea radicar el Proyecto?",
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
                  swal("Cancelado", "No se radico el Proyecto", "error");
              }
          });

  });
      
        dataTableServer.init(tablep, urlp, columnsp);
        tablep = tablep.DataTable();

        $('.Banco').on('click', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ route('EstudianteGesap.BancoDeProyectos') }}';
                $(".content-ajax").load(route);
        });

        tablep.on('click', '.Actividades', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.VerActividadesProyecto') }}' + '/' + dataTable.PK_NPRY_IdMctr008;
            $(".content-ajax").load(route);

     //       $(".content-ajax").load(route_ver);
        });
        tablep.on('click', '.Ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.VerComentariosJuradoProyecto') }}' + '/' + dataTable.PK_NPRY_IdMctr008;
            $(".content-ajax").load(route);

     //       $(".content-ajax").load(route_ver);
        });

    });
</script>
@endpush