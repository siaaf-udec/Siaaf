       <!--MODAL CREAR COMENTARIO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-coment" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_create-coment', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Comentario</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: textArea('OBS_observacion',null,['label'=>'Comentario:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su comentario acerca esta actividad','icon'=>'fa fa-book']) !!}
                                    {!! Field:: date('OBS_Limit',null,['label'=>'Fecha limite:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Coloque acá la fecha esperada de revision','icon'=>'fa fa-book']) !!}
                             
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
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para subir Actividades del Mctr008'])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([$datos], ['id'=>'form_subir_actividad', 'url' => '/forms'])  !!}
       <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                               <br>
                               <br>
                        </div>
                        <div class="col-md-6">
                                {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'ESTADO DE LA ACTIVIDAD:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                       
                                {!! Field:: text('MCT_Actividad',$datos[0]['MCT_Actividad'],['label'=>'Actividad:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: textArea('MCT_Descripcion',$datos[0]['MCT_descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','maxlength'=>'200','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                               
                               </div>
                             
                        </div>
                        {!! Field:: text('CMMT_Commit',$datos['Commit'],['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}
                    <br><br>
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Financiacion'])
                    @slot('columns', [
                            'Tipo',
                            'Fuente',
                            'Valor Aportado',

    
                    ])
                    @endcomponent
                    <br><br>

                    

                    <h4> Observaciónes acerca de esta Actividad del Mct</h4>
                    <br><br>
                    @permission('DOCENTE_COMENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Observación
                        </a>@endpermission
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'ListaComentarios'])
                        @slot('columns', [
                            'Fecha de realización',
                            'Observación',
                            'Realizada por',
                            'Fecha esperdad de respuesta'
                            
                        ])
                    @endcomponent
                     <br>
                     <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('CANCEL_DOCENTE')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Regresar
                                </a>@endpermission
                                @if( $datos['Estado'] == "EN CALIFICACIÓN" )
                                @permission('APROBAR_ACTIVIDAD')<a href="javascript:;"
                                                               class="btn btn-warning yellow button-Avalar"><i
                                ></i>
                                    Aprobar Actividad
                                </a>
                                @endpermission
                                @endif

                                
                            </div>
                            
                        </div>
                        
                    </div>
                     {!! Form::close() !!}
                 </div>
        </div>

    @endcomponent
</div>

<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){


    id = 123400009 ;
    //id = 111111111 ;

    var table, url, columns;
        table = $('#ListaComentarios');
        url = '{{ route('DocenteGesap.Comentarios') }}'+'/'+'{{$datos[0]['PK_MCT_IdMctr008']}}'+'/'+'{{$datos['Anteproyecto']}}';
         
        columns = [
            {data: 'updated_at', name: 'updated_at'},
            {data: 'OBS_observacion', name: 'OBS_observacion'},
            {data: 'Usuario', name: 'Usuario'},
            {data: 'OBS_Limit', name: 'OBS_Limit'},
            
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();
     
            $('.gestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-create-coment').modal('toggle');
            });

            var CrearComentario = function () {
                return {
                    init: function () {
                        var route = '{{ route('DocenteGesap.ComentarioStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('OBS_observacion', $('#OBS_observacion').val());
                        formData.append('OBS_Limit', $('[name="OBS_Limit"]').val());
                  

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
                                    $('#modal-create-coment').modal('hide');
                                    $('#from_create-coment')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('DocenteGesap.VerActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('DocenteGesap.VerActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                }
                            }
                        });
                    }
                }
            };
            var form = $('#from_create-coment');
            var rules = {
                OBS_observacion: {required: true, minlength: 1, maxlength: 600},
                OBS_Limit:{required:true},
            };

            FormValidationMd.init(form, rules, false, CrearComentario());
           

        $('.button-Avalar').on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('DocenteGesap.Avalar') }}' +'/'+'{{$datos[0]['PK_MCT_IdMctr008']}}'+'/'+'{{$datos['Anteproyecto']}}';
            var type = 'GET';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro que desea Aprobar esta Actividad?",
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
                                                var route = '{{ route('DocenteGesap.VerActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                                $(".content-ajax").load(route);
                                               
                                            } else {
                                                table.ajax.reload();
                                                UIToastr.init(xhr, response.title, response.message);
                                                var route = '{{ route('DocenteGesap.VerActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                                $(".content-ajax").load(route);
                           
                                                }
                                        }
                        },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                     var route = '{{ route('DocenteGesap.VerActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                             
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se Aprobo la actividad", "error");
                    }
                });

        });
        var table1, url1, columns1;
        
        table1 = $('#Financiacion');
       
           
        url1 = '{{ route('DocenteGesap.Financiacion') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columns1 = [
            
            {data: 'MCT_Financiacion', name: 'MCT_Financiacion'},
            {data: 'MCT_Fuente', name: 'MCT_Fuente'},
            {data: 'MCT_Valor_Aportado', name: 'MCT_Valor_Aportado'},  
        ];
        dataTableServer.init(table1, url1, columns1);
        table1 = table1.DataTable();



        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            
            var route = '{{ route('DocenteGesap.VerActividades') }}' + '/' + '{{$datos['Anteproyecto']}}';;
            //location.href="{{route('DocenteGesap.index')}}";
            $(".content-ajax").load(route);
        });
   
    
})
</script>    
