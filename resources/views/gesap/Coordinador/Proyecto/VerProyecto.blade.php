<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Anteproyecto De Grado Seccional Facatativa'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$datos], ['id'=>'form_update_proyecto', 'url' => '/forms'])  !!}

                <div class="form-body">
                    <div class="row">
                       
              
                            {!! Field:: textArea('NPRY_Titulo',$datos['Titulo'],['label'=>'TITULO:','readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                            {!! Field:: textArea('NPRY_Keywords',$datos['Palabras'],['label'=>'PALABRAS CLAVE:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: textArea('NPRY_Descripcion',$datos['Descripcion'],['label'=>'DESCRIPCION:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Duracion',$datos['Duracion'],['label'=>'DURACION EN MESES:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field:: text('FK_NPRY_Estado',$datos['Estado'],['label'=>'ESTADO:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                            {!! Field:: text('NPRY_FCH_Radicacion',$datos['Fecha'],['label'=>'FECHA RADIACIÓN:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                            
                            {!! Field::select('FK_NPRY_Director', null,['name' => 'Select_Director','label'=>'Director:']) !!}
                          
                                                             <br><br>
                           <h4> DESARROLLADORES :</h4>
                                <br><br>
          
                    </div>
                   
                        
                      
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listadesarrolladores'])
                        @slot('columns', [
                            'Codigo',
                            'Nombre',
                            'Apellido'
                          
                        ])
                        @endcomponent
                        
                        <br><br>
                        
                        <br><br>
                        <h4> JURADOS ASIGNADOS </h4>
                   
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listajurados'])
                        @slot('columns', [
                            'Codigo',
                            'Nombre',
                            'Apellido'
                        ])
                        @endcomponent
                        
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('GESAP_ADMIN_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>
                                @endpermission
                                @permission('GESAP_ADMIN'){{ Form::submit('Cambiar Director', ['class' => 'btn blue']) }}@endpermission
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



</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {

        var $widget_select_Director = $('select[name="Select_Director"]');
        var valorSelected = <?php echo $datos['FK_NPRY_Director']; ?>

        var route_Director = '{{ route('AnteproyectoGesap.listarpredirector') }}';
        $.get(route_Director, function (response, status) {
        $(response.data).each(function (key, value) {
            $widget_select_Director.append(new Option(value.User_Nombre1, value.PK_User_Codigo ));
        });
            $widget_select_Director.val([]);
            $('#FK_NPRY_Director').val(valorSelected);
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

        var table1, url1, columns1;
        table1 = $('#listadesarrolladores');
        id='{{  $datos['id_proyecto'] }}';
        
        url1 = '{{ route('AnteproyectosGesap.Desarrolladoreslist') }}'+ '/' + id;
    
         
    
        columns1 = [
            {data: 'CodigoJ', name: 'CodigoJ'},
            {data: 'NombreJ', name: 'NombreJ'},
            {data: 'ApellidoJ', name: 'ApellidoJ'},
            
            
      
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
                                    
                                    var route = '{{ route('AnteproyectoGesap.VerAnteproyecto') }}' + '/' + id;
                                    $(".content-ajax").load(route);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    var route = '{{ route('AnteproyectoGesap.VerAnteproyecto') }}' + '/' + id;
                                    $(".content-ajax").load(route);
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
        id='{{  $datos['id_proyecto'] }}';
       
        
        url = '{{ route('AnteproyectosGesap.JuradosList') }}'+ '/' + id;
    
         
    
        columns = [
            {data: 'Codigo', name: 'Codigo'},
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Apellido', name: 'Apellido'},
            
            
      
        ];
        
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        
        table.on('click', '.removej', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('AnteproyectoGesap.EliminarJurados') }}' + '/' + dataTable.Codigo;
          var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este anteproyecto?",
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
                        swal("Cancelado", "No se eliminó ningun anteproyecto", "error");
                    }
                });

        });
        var updateDirector = function(){
        
        return{
            init : function (){
                 var formData = new FormData();
                 var route = '{{ route('Proyecto.updateProy') }}';
                 var async = async || false;
                 
                 formData.append('FK_NPRY_Director', $('select[name="Select_Director"]').val());
                 
                  formData.append('FK_NPRY_IdMctr008', '{{$datos['FK_NPRY_IdMctr008']}}');
                
                 $.ajax({
                      url: route,
                     type: 'POST',
                     data: formData,
                     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                     cache: false,
                     contentType: false,
                     processData: false,
                     async: async || false,
                     success: function (response, xhr, request) {
                         console.log(response);
                         if (request.status === 200 && xhr === 'success') {
                             $('#form_update_proyecto')[0].reset(); //Limpia formulario
                             UIToastr.init(xhr, response.title, response.message);
                             App.unblockUI('.portlet-form');
                             var route = '{{ route('Proyectos.indexajax') }}';
                             location.href="{{route('Proyectos.index')}}";
                             
                         }
                     },
                     error: function (response, xhr, request) {
                         if (request.status === 422 && xhr === 'error') {
                             UIToastr.init(xhr, response.title, response.message);
                         }
                     }
                 })
     
   

            }
        }
    }
    var form = $('#form_update_proyecto');


     FormValidationMd.init(form, false, false, updateDirector());
        

    $(".desarrollador").on('click', function (e) {
        e.preventDefault();
        var route = '{{ route('AnteproyectosGesap.AsignarDesarrollador') }}'+ '/' + id;
        $(".content-ajax").load(route);

    });

    $(".juez").on('click', function (e) {
        e.preventDefault();
        var route = '{{ route('AnteproyectosGesap.AsignarJurados') }}'+ '/' + '{{  $datos[0]['PK_NPRY_IdMctr008']  }}';
        $(".content-ajax").load(route);

    });

     
    $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Proyectos.indexajax') }}';
            location.href="{{route('Proyectos.index')}}";
            //$(".content-ajax").load(route);
        });
    });
</script>

