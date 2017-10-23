

 <!-- TABLAS -->
<!-- TABLAS DOCUMENTOS DEL CONVENIO -->

   @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'INFORMNACION DEL CONVENIO'])

    

<div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> DOCUMENTOS </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> PARTICIPANTES </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> EMPRESAS </a>
                                        </li>
                                       
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_1">
                                          <div class="actions">
                                            @permission(['Add_Convenio'])
                                                <a id="archivo1" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
                                            @endpermission
                                        </div>
             
 
                                          <div class="row">

                                          <div class="clearfix"> </div><br><br>
                                          <div class="col-md-12">
                                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Documentos'])

                                            @slot('columns', [
                                                '#' => ['style' => 'width:20px;'],
                                                'ID',
                                                'Entidad',
                                                'Acciones' => ['style' => 'width:160px;']
                                            ])
                                        @endcomponent
                                        </div>
                                        </div>
                                        </div>
              <!-- TABLAS  PARTICIPANTES -->                          
            <div class="tab-pane fade" id="tab_1_2">
                                        <div class="col-md-12">
                                             @permission(['Add_Convenio'])
                                            <div class="actions">
                                                <a id="archivo2" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
                                            </div>
                                            @endpermission
                                        </div>
                        
                                        <div class="row">

                                        <div class="clearfix"> </div><br><br>
                                         <div class="col-md-12">
                                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Paticipantes'])

                                             @slot('columns', [
                                             '#' => ['style' => 'width:20px;'],
                                             'Documentacion',
                                             'Nombres',
                                              'Apellidos',
                                             'Acciones' => ['style' => 'width:160px;']
                                            ])
                                        @endcomponent
                                        </div>
                                        </div>
              </div>
                                        <!-- TABLAS EMPRESAS PARTICIPANTES -->
                                        <div class="tab-pane fade" id="tab_1_3">
                                           
                                        <div class="col-md-12">
                                            @permission(['Add_Convenio'])
                                                            <div class="actions">
                                                                <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
                                                            </div>
                                             @endpermission
                                                        </div>

                                              <div class="row">

                                                <div class="clearfix"> </div><br><br>
                                                <div class="col-md-12">
                                                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Empresas_Paticipantes'])

                                                        @slot('columns', [
                                                            '#' => ['style' => 'width:20px;'],
                                                            'ID',
                                                            'Identificacion',
                                                            'Empresa',
                                                            'Acciones' => ['style' => 'width:160px;']
                                                        ])
                                                    @endcomponent
                                                </div>
                                            </div> 
                                            
                                        </div>
                                        
                                    </div>
    @endcomponent






 <!-- FIN TABLAS -->
<!-- MODALS -->
<!-- AGREGAR DOCUMENTO-->
<div class="col-md-12">
                    <!-- Modal -->
                    <div class="modal fade" id="documento" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header modal-header-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> SUBIR ARCHIVO</h1>
                                </div>
                                <div class="modal-body">
                                                                      
                                    {!! Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url'=>'/form']) !!}
                                    
                                    
                                    <h3 class="sbold">Arrastra o da click aquí para cargar archivos</h3>
                                    {!! Form::close() !!}
                                    <br>
                                    {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                    
                                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

<!-- AGREGAR PARTICIPANTE -->
<div class="col-md-12">
                    <!-- Modal -->
                    <div class="modal fade" id="participante" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                  
                                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Participante']) !!}
                                        <div class="form-wizard">
                                <div class="modal-header modal-header-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR PARTICIPANTE</h1>
                                </div>
                                <div class="modal-body">
                                    {!! Field:: text('identity_no',null,['label'=>'Documento','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el nunemero de cedula.','icon'=>'fa fa-credit-card']) !!}
                                   
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
                                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

<!-- AGREGAR EMPRESA PARTICIPANTE -->
    <div class="col-md-12">
                    <!-- Modal -->
                    <div class="modal fade" id="empresa" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Empresas']) !!}
                                <div class="form-wizard">
                                <div class="modal-header modal-header-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR EMPRESA</h1>
                                </div>
                                <div class="modal-body">
                                    
                                    
                                    {!! Field:: text('FK_TBL_Empresa',null,['label'=>'Codigo de la empresa','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el nunemero de identificacion de la empresa.','icon'=>'fa fa-credit-card']) !!}
                                   
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
                                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>


<!-- FIN MODALS -->




<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script> 

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script> 
<script src="{{ asset('assets/main/scripts/dropzone.js') }}" type="text/javascript"></script> 

<script type="text/javascript">

    jQuery(document).ready(function() {
     
        var x = function () {
          return {
              init: function () {
                    alert('Seguro que desea subir este archivo');
                   // $('#documento').modal('hide');
                    //$('#Listar_Documentos').ajax.reload();;
              }
          };
        };
        var route = '{{route('Subir_Documento_Convenio.Subir_Documento_Convenio',[$id])}}';
        var formatfile = 'image/*,.jpeg,.pdf,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.PDF';
        var numfile = 1;
        
       $("#my-dropzone").dropzone(FormDropzone.init(route, formatfile, numfile, x(), name));

      
    
     
   
    var table, url,id;
   
    table = $('#Listar_Documentos');
    url = "{{ route('Listar_Documentos_Convenios.Listar_Documentos_Convenios',[$id]) }}";
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
       columns:[
           {data: 'DT_Row_Index'},
           {data: 'PK_Documentacion', "visible": true, name:"documento",className:'none' },
           {data: 'Entidad', searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<?php if (\Entrust::can(['Des_Doc_Con'])) : ?><a href="#" target="_blank" class="btn btn-simple btn-whrite btn-icon descargar" title="Descargar Documento"><i class="fa fa-cloud-download"> DESCARGAR</i></a><?php endif; // Entrust::can ?>'

            
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
    
    $("#archivo1").on('click', function (e) {
            e.preventDefault();
            $('#documento').modal('toggle');
        });
    
    table = table.DataTable();
    table.on('click', '.descargar', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var O = table.row($tr).data();
	    $.ajax({
            type: "GET",
            url: '',
            dataType: "html",
        }).done(function (data) {
            window.location.href = '/siaaf/public/index.php/interaccion-universitaria/Descarga/'+O.PK_Documentacion+'/<?php
echo $id;
?>';
        });
    });
        
});
    </script>  
<script type="text/javascript">

    jQuery(document).ready(function() {
    var table, url,id;
    table = $('#Listar_Paticipantes');
    url = "{{ route('Listar_Participantes_Convenios.Listar_Participantes_Convenios',[$id]) }}";
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
       columns:[
           {data: 'DT_Row_Index'},
           {data: 'FK_TBL_Usuarios',className:'none', "visible": true, name:"participante" },
           {data: 'name', searchable: true},
           {data: 'lastname', searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<?php if (\Entrust::can(['Eva_Empresa'])) : ?><a href="#" target="_blank" class="btn btn-simple btn-warning btn-icon evaluar1" title="Evaluar Usuario"><i class="icon-pencil"> EVALUAR </i></a><?php endif; // Entrust::can ?><?php if (\Entrust::can(['Eva_Empresa'])) : ?><a href="#" class="btn btn-simple btn-success btn-icon doc1"><i class="icon-notebook"></i></a><?php endif; // Entrust::can ?><?php if (\Entrust::can(['Ver_Eva'])) : ?><a href="#" target="_blank" class="btn btn-simple btn-warning btn-icon ver1" title="Ver Evaluacion"><i class="icon-pencil"> VER </i></a><?php endif; // Entrust::can ?>'

            
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
   
  
    table.on('click', '.evaluar1', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/Realizar_Evaluacion/'+dataTable.FK_TBL_Usuarios+'/<?php
echo $id;
?>';

            $(".content-ajax").load(route_edit);
        });
  table.on('click', '.doc1', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/Documentos_Usuarios/'+dataTable.FK_TBL_Usuarios;

            $(".content-ajax").load(route_edit);
        });
     
    table.on('click', '.ver1', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/Listar_Evaluacion_Empresa/'+dataTable.FK_TBL_Usuarios;

            $(".content-ajax").load(route_edit);
        });
   
    $("#archivo2").on('click', function (e) {
            e.preventDefault();
            $('#participante').modal('toggle');
        });
            $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
        
            };
        
          
    var form=$('#form-Participante');
    var wizard =  $('#form_wizard_1');
            
    var agregarParticipante = function () {
            return{
                init: function () {
                    var route = '{{ route('Participante_Convenio.Participante_Convenio',[$id]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('identity_no', $('#identity_no').val());
                   
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        
                     
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        $('#participante').modal('hide');
                        table.ajax.reload();
                        UIToastr.init(xhr , response.title , response.message  );
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'success') {
                        UIToastr.init(xhr, response.title, response.message);
                    }
                }
                    });
                }
            }
        };    
    
    var messages = {};
        
    FormValidationMd.init( form, rules, messages , agregarParticipante());
   
});
    </script>  
<script type="text/javascript">

    jQuery(document).ready(function() {
    var table, url,id;
   
    table = $('#Listar_Empresas_Paticipantes');
    url = "{{ route('Listar_Empresas_Participantes_Convenios.Listar_Empresas_Participantes_Convenios',[$id]) }}";
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
       columns:[
           {data: 'DT_Row_Index'},
           {data: 'PK_Empresas_Participantes', className:'none',"visible": true, name:"participante" },
           {data: 'PK_Empresa', searchable: true},
           {data: 'Nombre_Empresa', searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<?php if (\Entrust::can(['Eva_Pasante'])) : ?><a href="#" target="_blank" class="btn btn-simple btn-warning btn-icon evaluar2" title="Evaluar Empresa"><i class="icon-pencil"> EVALUAR </i></a><?php endif; // Entrust::can ?><?php if (\Entrust::can(['Ver_Eva'])) : ?><a href="#" target="_blank" class="btn btn-simple btn-warning btn-icon ver2" title="Ver Evaluacion"><i class="icon-pencil"> VER </i></a><?php endif; // Entrust::can ?>'

            
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
     table.on('click', '.evaluar2', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/Realizar_Evaluacion_Empresa/'+dataTable.PK_Empresa+'/<?php
echo $id;
?>';

            $(".content-ajax").load(route_edit);
        });
    
      table.on('click', '.ver2', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/Listar_Evaluacion_Empresa/'+dataTable.PK_Empresa;

            $(".content-ajax").load(route_edit);
        });
   
    $("#archivo3").on('click', function (e) {
            e.preventDefault();
            $('#empresa').modal('toggle');
        });
        
    $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
        
            };  
    var form=$('#form-Empresas');
     var wizard =  $('#form_wizard_1');
    var agregarEmpresa = function () {
            return{
                init: function () {
                    var route = '{{ route('Empresa_Convenio.Empresa_Convenio',[$id]) }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('FK_TBL_Empresa', $('#FK_TBL_Empresa').val());
                   
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        
                     
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        $('#empresa').modal('hide');
                        table.ajax.reload();
                        UIToastr.init(xhr , response.title , response.message  );
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'success') {
                        UIToastr.init(xhr, response.title, response.message);
                    }
                }
                    });
                }
            }
        };    
    
    var messages = {};
        
    FormValidationMd.init( form, rules, messages , agregarEmpresa());
    
   
});
</script>
