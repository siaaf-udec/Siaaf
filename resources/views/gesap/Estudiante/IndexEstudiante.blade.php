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
<!--MODAL CREAR SOLICITUD-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Solicitud" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create-Solicitud', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Crear Una Solicitud</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: textArea('Sol_Solicitud',null,['label'=>'Solicitud:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite la solicitud que desea hacer','icon'=>'fa fa-book']) !!}
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
            <!--MODAL CREAR SOLICITUD-->
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
    @permission('GESAP_STUDENT')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Gesap Anteproyectos: '])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                    
                    @permission('GESAP_STUDENT_SOLICITUD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Solicitudes
                    </a>@endpermission
                    @permission('GESAP_STUDENT_SOLICITUDES')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon mygestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Mis Solicitudes
                    </a>@endpermission
                    @permission('GESAP_STUDENT_BANCO_PROYECTOS')<a href="javascript:;"
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
                            'Duracion en meses',
                            'Estado',
                            'Fecha Radicación',
                            'Acciones'
                        ])
                    @endcomponent
                    <br><br>
                    <br><br>
                  
                    
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

        var tablecrono, urlcrono, columnscrono;
        tablecrono = $('#listaCronograma');
        urlcrono = '{{ route('EstudianteGesap.SeguimientoCrono')}}';
        columnscrono = [
            {data: 'semana', name: 'semana'},
            {data: 'NPRY_FCH_Radicacion', name: 'NPRY_FCH_Radicacion'},
        ];
        
      
        dataTableServer.init(tablecrono, urlcrono, columnscrono);
        tablecrono = tablecrono.DataTable();

        var tablesol, urlsol, columnssol;
        tablesol = $('#listaSolicitudes');
        urlsol = '{{ route('EstudianteGesap.VerSolicitud')}}'+ '/' + 123456789;
        columnssol = [
            {data: 'Sol_Solicitud', name: 'Sol_Solicitud'},
            {data: 'Sol_Estado', name: 'Sol_Estado'},
      
            {
                defaultContent: ' @permission('GESAP_STUDENT_DELETE')<a href="javascript:;" title="Eliminar Solicitud" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission',
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
        var route = '{{ route('EstudianteGesap.EliminarSolicitud') }}'+'/'+dataTable.Pk_Id_Solicitud;
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
        id = 123456789 ;
        url = '{{ route('EstudianteGesap.Desarrolladores')}}'+ '/' + id;
        columns = [
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Palabras', name: 'Palabras'},
            {data: 'Des', name: 'Des'},
            {data: 'Duracion', name: 'Duracion'},  
            {data: 'Estado', name: 'Estado'},
            {data: 'Fecha', name: 'Fecha'},
      
            {
                defaultContent: ' @permission('GESAP_STUDENT_FOLDER')<a href="javascript:;" title="Actividades" class="btn btn-warning Actividades" ><i class="icon-folder"></i></a>@endpermission @permission('GESAP_STUDENT_RADICAR')<a href="javascript:;" title="Radicar" class="btn btn-success Radicar" ><i class="icon-check"></i></a>@endpermission @permission('GESAP_STUDENT_RADICAR')<a href="javascript:;" title="Calificar" class="btn btn-warning Calificar" ><i class="icon-check"></i></a>@endpermission @permission('GESAP_STUDENT_VER_COMENTARIO_JURADO')<a href="javascript:;" title="Ver Comentarios de los Jurados" class="btn btn-success Ver" ><i class="icon-eye"></i></a>@endpermission' ,
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
            var route = '{{ route('EstudianteGesap.VerActividades') }}' + '/' + dataTable.Codigo;
            $(".content-ajax").load(route);

     //       $(".content-ajax").load(route_ver);
        });

        
        table.on('click', '.Ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.VerComentariosJuradoAnteproyecto') }}' + '/' + dataTable.Codigo;
            $(".content-ajax").load(route);

     //       $(".content-ajax").load(route_ver);
        });
        table.on('click', '.Radicar', function (e) {
      
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.RADICAR') }}'+'/'+dataTable.Codigo;
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

      table.on('click', '.Calificar', function (e) {
      
      e.preventDefault();
      $tr = $(this).closest('tr');
      var dataTable = table.row($tr).data();
      var route = '{{ route('EstudianteGesap.CALIFICAR') }}'+'/'+dataTable.Codigo;
      var type = 'GET';
      var async = async || false;
      swal({
              title: "¿Está seguro?",
              text: "¿Está seguro que desea enviar a revisión el anteproyecto?",
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
                  swal("Cancelado", "No se envio a revisión el anteproyecto", "error");
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
                defaultContent: ' @permission('GESAP_STUDENT_FOLDER')<a href="javascript:;" title="Actividades" class="btn btn-warning Actividades" ><i class="icon-folder"></i></a>@endpermission @permission('GESAP_STUDENT_RADICAR')<a href="javascript:;" title="Radicar" class="btn btn-success RadicarP" ><i class="icon-check"></i></a>@endpermission @permission('GESAP_STUDENT_VER_COMENTARIO_JURADO')<a href="javascript:;" title="Ver Comentarios de los Jurados" class="btn btn-success Ver" ><i class="icon-eye"></i></a>@endpermission' ,
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

        $('.gestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-create-Solicitud').modal('toggle');
        });

        var CrearSolicitud = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.SolicitudStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('Sol_Solicitud', $('#Sol_Solicitud').val());
                        formData.append('ID', 123456789);


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
                
            };


            FormValidationMd.init(form1, rules1, false, CrearSolicitud()); 

        $('.mygestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-ver-Solicitud').modal('toggle');
        });
           

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