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
                {!! Form::model ([$datos], ['id'=>'form_update_anteproyecto', 'url' => '/forms'])  !!}

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
                           
                            {!! Field:: text('FK_NPRY_Pre_Director',$datos['Director'],['label'=>'Director :', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-book'] ) !!}
                          
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
                               <!--  @permission('ADMIN_GESAP'){{ Form::submit('Asignar', ['class' => 'btn blue']) }}@endpermission
                                @permission('ADMIN_GESAP'){{ Form::submit('Re-Asignar', ['class' => 'btn yellow']) }}@endpermission
                               -->        </div>
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
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
    });
</script>

