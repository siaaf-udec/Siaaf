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
                       
                  
                        {!! Field:: text('NPRY_Titulo',$datos[0]['NPRY_Titulo'],['label'=>'TITULO:','readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                            {!! Field:: text('NPRY_Keywords',$datos[0]['NPRY_Keywords'],['label'=>'PALABRAS CLAVE:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Descripcion',$datos[0]['NPRY_Descripcion'],['label'=>'DESCRIPCION:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Duracion',$datos[0]['NPRY_Duracion'],['label'=>'DURACION:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field:: text('FK_NPRY_Estado',$datos['Estado'],['label'=>'ESTADO:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                            {!! Field:: text('NPRY_FCH_Radicacion',$datos[0]['NPRY_FCH_Radicacion'],['label'=>'FECHA RADIACIÓN:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                                 
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
          
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('CANCEL_DOCENTE')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>
                                @endpermission
                                @if($datos['Estado'] == "EN ESPERA" )
                                @permission('ASIGNAR_DESARROLLADORES')<a href="javascript:;"
                                                               class="btn btn-warning yellow button-asignar"><i
                                ></i>
                                    Asignar
                                </a>
                                @endpermission
                                @endif
                                @if($datos['Estado'] != "EN ESPERA" )
                                @permission('VER_ACTIVIDADES')<a href="javascript:;"
                                                               class="btn btn-warning yellow button-Actividades"><i
                                ></i>
                                    Ver Actividades
                                </a>
                                @endpermission
                                @endif
                               
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
        
 //alert('aishiajsia');


    var table, url, columns;
        table = $('#listadesarrolladores');
        id='{{  $datos[0]['PK_NPRY_IdMctr008']  }}';
        
        url = '{{ route('DocenteGesap.Desarrolladores') }}'+ '/' + id;
    
         
    
        columns = [
            {data: 'Codigo', name: 'Codigo'},
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Apellido', name: 'Apellido'},
            
        ];
        
        dataTableServer.init(table, url, columns);
        table = table.DataTable();


     
    $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('DocenteGesap.index.ajax') }}';
            location.href="{{route('DocenteGesap.index')}}";
            //$(".content-ajax").load(route);
        });

    $('.button-asignar').on('click', function (e) {
                 
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('DocenteGesap.Asignar') }}'+ '/' + id;
           var type = 'GET';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro que desa Asignar este Anteproyecto?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Seguro",
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
                                    var route = '{{ route('DocenteGesap.VerAnteproyecto') }}' + '/' + '{{$datos[0]['PK_NPRY_IdMctr008']}}';
                                    $(".content-ajax").load(route);
                             
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    var route = '{{ route('DocenteGesap.VerAnteproyecto') }}' + '/' + '{{$datos[0]['PK_NPRY_IdMctr008']}}';
           
                                    $(".content-ajax").load(route);
                             
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se Asigno el Anteproyecto", "error");
                    }
                });

    });

         $('.button-Actividades').on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('DocenteGesap.VerActividades') }}' + '/' + '{{$datos[0]['PK_NPRY_IdMctr008']}}';
            $(".content-ajax").load(route);

     //       $(".content-ajax").load(route_ver);
        });
    });
</script>

