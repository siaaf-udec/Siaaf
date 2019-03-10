<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del Anteproyecto'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
         <!-- Modal -->
         <div class="modal fade" id="modal-ver-fechas" tabindex="-1" role="dialog" aria-hidden="true">
                
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'form_ver-fechas', 'url' => '/forms']) !!}

                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-plus"></i> Crear Una Solicitud</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                              {!! Field::select('Fecha1', null,['name' => 'Select_Fecha1','label'=>'Fecha Radicacion AnteProyecto: ']) !!}

                              {!! Field::select('Fecha2', null,['name' => 'Select_Fecha2','label'=>'Fecha Radicación Proyecto: ']) !!}
                         
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
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$datos], ['id'=>'form_update_anteproyecto', 'url' => '/forms'])  !!}

                <div class="form-body">
                    <div class="row">

                            {!! Field:: text('Solicitud',$datos['Solicitud'],['label'=>'Solicitud:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}
                             {!! Field:: text('Solicitud_usuario',$datos['Solicitud_usuario'],['label'=>'La Hace:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}
                       
                            {!! Field:: text('NPRY_Titulo',$datos['Proyecto'],['label'=>'TITULO:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                            {!! Field:: text('NPRY_Titulo',$datos['FechaAnteproyecto'],['label'=>'FECHA ANTEPROYECTO:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}
                            {!! Field:: text('NPRY_Titulo',$datos['FechaProyecto'],['label'=>'FECHA PROYECTO:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}
          
                    
          
                            {!! Field::select('FK_NPRY_Pre_Director', null,['name' => 'SelectPre_Director','label'=>'Pre Director:']) !!}
                            @permission('GESAP_ADMIN_MCT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Fechas 
                        </a>@endpermission
                                <h4>Desarrolladores<h4>
                                <br><br>
                         @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listadesarrolladores'])
                        @slot('columns', [
                            'Codigo',
                            'Nombre',
                            'Apellido',
                            'Acciones'
                        ])
                        @endcomponent
                        <h4>Jurados<h4>
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listajurados'])
                        @slot('columns', [
                            'Codigo',
                            'Nombre',
                            'Apellido'                        ])
                        @endcomponent
                        
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                             
                          
                              
                                @permission('CANCEL_GESAP')<a href="javascript:;"
                                                               class="btn btn-outline blue button-cerrar"><i
                                            class="fa fa-angle-right"></i>
                                    Cerrar Solicitud
                                </a>@endpermission
                              
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endcomponent


<!-- Modal Update Foto -->
   
    <div class="modal-footer">

{!! Form::close() !!}
</div>

    <!-- Fin Modal Update Foto -->


</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        
   
   
        var $widget_select_Pre_Director = $('select[name="SelectPre_Director"]');
        var valorSelectedPre = <?php echo $datos['IdDirector']; ?>

        var route_Pre_Director = '{{ route('AnteproyectoGesap.listarpredirector') }}';
        $.get(route_Pre_Director, function (response, status) {
        $(response.data).each(function (key, value) {
            $widget_select_Pre_Director.append(new Option(value.User_Nombre1, value.PK_User_Codigo ));
        });
            $widget_select_Pre_Director.val([]);
            $('#FK_NPRY_Pre_Director').val(valorSelectedPre);
        });

        var $widget_select_Fecha = $('select[name="Select_Fecha1"]');
        var valorfecha1 = <?php echo $datos['FechaAnteproyecto']; ?>

        var route_Fecha = '{{ route('AnteproyectoGesap.FechasRadicacion') }}';
        $.get(route_Fecha, function (response, status) {
        $(response.data).each(function (key, value) {
            $widget_select_Fecha.append(new Option(value.FCH_Radicacion, value.FCH_Radicacion ));
        });
        $widget_select_Fecha.val([]);
        $('#Fecha1').val();
        });

        var $widget_select_Fecha2 = $('select[name="Select_Fecha2"]');
        var valorFecha2 = <?php echo $datos['FechaProyecto']; ?>

        var route_Fecha2 = '{{ route('AnteproyectoGesap.FechasRadicacion') }}';
        $.get(route_Fecha2, function (response, status) {
        $(response.data).each(function (key, value) {
            $widget_select_Fecha2.append(new Option(value.FCH_Radicacion, value.FCH_Radicacion ));
        });
        $widget_select_Fecha2.val([]);
        $('#Fecha2').val();
        });

        
        $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });

        
            var editarFechas = function () {
                return {
                    init: function () {
                        var route = '{{ route('CoordinadorGesap.editarfechas') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('Fecha1', $('#Fecha1').val());
                        formData.append('Fecha2', $('#Fecha2').val());
                        formData.append('proyecto', '{{  $datos['IdProyecto']  }}' );
                        
                  

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
                                    $('#modal-ver-fechas').modal('hide');
                                    $('#form_ver-fechas')[0].reset(); //Limpia formulario
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
            var form = $('#form_ver-fechas');
          
            FormValidationMd.init(form, false, false, editarFechas());
           

        var table1, url1, columns1;
        table1 = $('#listadesarrolladores');
        id='{{  $datos['IdProyecto']  }}';
        
        url1 = '{{ route('AnteproyectosGesap.Desarrolladoreslist') }}'+ '/' + id;
    
         
    
        columns1 = [
            {data: 'CodigoJ', name: 'CodigoJ'},
            {data: 'NombreJ', name: 'NombreJ'},
            {data: 'ApellidoJ', name: 'ApellidoJ'},
            
            
      
            {
                defaultContent: '@permission('DELETE_DEVELOPER')<a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission' ,
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

        table1.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table1.row($tr).data();
            var route = '{{ route('Desarrollador.destroy') }}' + '/' + dataTable.CodigoJ;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este desarrollador?",
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
                                if (request.status === 200 && xhr === 'success') {
                                    table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                    
                                
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó desarrollador", "error");
                    }
                });

        });


        var table, url, columns;
        table = $('#listajurados');
        id='{{   $datos['IdProyecto']   }}';
        
        url = '{{ route('AnteproyectosGesap.JuradosList') }}'+ '/' + id;
    
         
    
        columns = [
            {data: 'Codigo', name: 'Codigo'},
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Apellido', name: 'Apellido'},
            
        ];
        
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        $('.gestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-ver-fechas').modal('toggle');
        });
           
                
        ids='{{   $datos['IDSolicitud']   }}';  
   
        $('.button-cerrar').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('CoordinadorGesap.indexSolicitudes.Ajax') }}'+'/'+ids;

            location.href="{{route('CoordinadorGesap.indexSolicitudes')}}";
            //$(".content-ajax").load(route);
        });



    });
</script>
