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
             <!--MODAL CREAR Cronograma-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Cronograma" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create-Cronograma', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Actividad</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: Text('MCT_CRN_Actividad',null,['label'=>'Actividad:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui la actividad que va ha realizar','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_CRN_Semana_inicio',null,['label'=>'Inicio:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la semana en que va ha iniciar la actividad','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_CRN_Semana_fin',null,['label'=>'Fin :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la semana en la cual va ha terminar la actividad','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_CRN_Responsable',null,['label'=>'Responsable :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el responsable de dicha actividad','icon'=>'fa fa-book']) !!}
                                                    
                               
                               
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
            <!--MODAL CREAR Cronograma-->
            <!--MODAL EDITAR Cronograma-->
            <!-- Modal -->
            <div class="modal fade" id="modal-edit-Cronograma" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_edit-Cronograma', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Editar Actividad</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                            
                                   {!! Field:: Text('MCT_EDITAR_CRN_Actividad',null,['label'=>'Actividad:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui la actividad que va ha realizar','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_CRN_Semana_inicio',null,['label'=>'Inicio:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la semana en que va ha iniciar la actividad','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_CRN_Semana_fin',null,['label'=>'Fin :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la semana en la cual va ha terminar la actividad','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_CRN_Responsable',null,['label'=>'Responsable :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el responsable de dicha actividad','icon'=>'fa fa-book']) !!}
                                   
                               
                               
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
            <!--MODAL EDITAR Cronograma-->
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
                               
                               </div>
                             
                        </div>
                        {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'ESTADO DE LA ACTIVIDAD:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                       
                                {!! Field:: text('MCT_Actividad',$datos[0]['MCT_Actividad'],['label'=>'Actividad:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: textArea('MCT_Descripcion',$datos[0]['MCT_Descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                   
                        {!! Field:: text('CMMT_Commit',$datos['Commit'],['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','maxlength'=>'500','readonly','autocomplete'=>'off'],
                    
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}
                    @if($datos['Estado'] != "APROBADO" )
                                
                    @permission('GESAP_STUDENT_ADD_ACTIVIDAD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon person"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Cronograma
                        </a>@endpermission
                    @endif
                    <br><br>
                    @if($datos['Estado'] != "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Cronograma'])
                    @slot('columns', [
                            'Actividad',
                            'Fecha realización (numero semana)',
                            'Responsable de la Actividad',
                            'Acciones',
    
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] == "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'CronogramaF'])
                    @slot('columns', [
                            'Actividad',
                            'Fecha realización (numero semana)',
                            'Responsable de la Actividad',
                            
    
                    ])
                    @endcomponent
                    @endif

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('GESAP_STUDENT_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>@endpermission
                               
                            </div>
                            
                        </div>
                        
                    </div>
                    <h4> Observaciónes acerca de esta Actividad del Mct</h4>
                    <br><br>
                    @permission('GESAP_STUDENT_COMENT')<a href="javascript:;"
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
    
    $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecciónar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

    id = 123456189 ;

    var table, url, columns;
        table = $('#ListaComentarios');
        url = '{{ route('EstudianteGesap.Comentarios') }}'+'/'+'{{$datos[0]['PK_MCT_IdMctr008']}}'+'/'+'{{$datos['Anteproyecto']}}';
         
        columns = [
            {data: 'updated_at', name: 'updated_at'},
            {data: 'OBS_Observacion', name: 'OBS_Observacion'},
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
                        var route = '{{ route('EstudianteGesap.ComentarioStore') }}';
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
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
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

     
        var table1, url1, columns1;
        
        table1 = $('#Cronograma');
       
           
        url1 = '{{ route('EstudianteGesap.Cronograma') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columns1 = [
            
            {data: 'MCT_CRN_Actividad', name: 'MCT_CRN_Actividad'},
            {data: 'Semana', name: 'Semana'},
            {data: 'MCT_CRN_Responsable', name: 'MCT_CRN_Responsable'},
           
            {
                defaultContent: ' @permission('GESAP_STUDENT_DELETE')<a href="javascript:;" title="Eliminar" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission @permission('GESAP_STUDENT_UPDATE')<a href="javascript:;" title="Editar" class="btn btn-warning Editar" ><i class="icon-pencil"></i></a>@endpermission ' ,
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
        
        var table2, url2, columns2;
        
        table2 = $('#CronogramaF');
       
           
        url2 = '{{ route('EstudianteGesap.Cronograma') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columns2 = [
            
            {data: 'MCT_CRN_Actividad', name: 'MCT_CRN_Actividad'},
            {data: 'Semana', name: 'Semana'},
            {data: 'MCT_CRN_Responsable', name: 'MCT_CRN_Responsable'},
           
          
        ];
        dataTableServer.init(table2, url2, columns2);
        table2 = table2.DataTable();

        
        $('.person').on('click', function (e) {
            e.preventDefault();
            $('#modal-create-Cronograma').modal('toggle');
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
                 return this.optional(element) || /^[0-9]+$/i.test(value);
        });
        var CrearCronograma = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.CronogramaStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('MCT_CRN_Actividad', $('#MCT_CRN_Actividad').val());
                        formData.append('MCT_CRN_Semana_inicio', $('#MCT_CRN_Semana_inicio').val());
                        formData.append('MCT_CRN_Semana_fin', $('#MCT_CRN_Semana_fin').val());
                        formData.append('MCT_CRN_Responsable', $('#MCT_CRN_Responsable').val());
                        
            
///LA OTRA TABLA///
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('CMMT_Commit', 'Tabla Subida');
                        formData.append('FK_CHK_Checklist', 1);
                        formData.append('CMMT_Formato', 1);
            


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
                                    $('#modal-create-Cronograma').modal('hide');
                                    $('#form_create-Cronograma')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form1 = $('#form_create-Cronograma');
            var rules1 = {
                
                MCT_CRN_Actividad:{minlength: 1, maxlength: 190, required: true},
                MCT_CRN_Semana_inicio:{minlength: 1, maxlength: 190, required: true, number:true},
                MCT_CRN_Semana_fin:{minlength: 1, maxlength: 190, required: true,number:true},       
                MCT_CRN_Responsable:{minlength: 1, maxlength: 190, required: true},
           
            };


            FormValidationMd.init(form1, rules1, false, CrearCronograma()); 

            table1.on('click', '.Eliminar', function (e) {
            e.preventDefault();
            $tr1 = $(this).closest('tr');

            var dataTable1 = table1.row($tr1).data();
            var route1 = '{{ route('EstudianteGesap.CronogramaDelete') }}' + '/' + dataTable1.PK_Id_Cronograma;
            var type1 = 'DELETE';
            var async1 = async1 || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este Cronograma?",
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
                            url: route1,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type1,
                            contentType: false,
                            processData: false,
                            async: async1,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table1.ajax.reload();
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
                        swal("Cancelado", "No se eliminó ningun Cronograma", "error");
                    }
                });

        });
        var id_cronograma = 0 ;
        table1.on('click', '.Editar', function (e) {
            e.preventDefault();
            $('#modal-edit-Cronograma').modal('toggle');
            $tr1 = $(this).closest('tr');
            var dataTable1 = table1.row($tr1).data();
            id_cronograma = dataTable1.PK_Id_Cronograma;
            $('#MCT_EDITAR_CRN_Actividad').val(dataTable1.MCT_CRN_Actividad);
            $('#MCT_EDITAR_CRN_Semana_inicio').val(dataTable1.MCT_CRN_Semana_Inicio);
            $('#MCT_EDITAR_CRN_Semana_fin').val(dataTable1.MCT_CRN_Semana_Fin);
            $('#MCT_EDITAR_CRN_Responsable').val(dataTable1.MCT_CRN_Responsable);
        });

        var EditarCronograma = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.EditarCronograma') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();      
                        formData.append('PK_Id_Cronograma', id_cronograma);
                        formData.append('MCT_EDITAR_CRN_Actividad', $('#MCT_EDITAR_CRN_Actividad').val());
                        formData.append('MCT_EDITAR_CRN_Semana_inicio', $('#MCT_EDITAR_CRN_Semana_inicio').val());
                        formData.append('MCT_EDITAR_CRN_Semana_fin', $('#MCT_EDITAR_CRN_Semana_fin').val());
                        formData.append('MCT_EDITAR_CRN_Responsable', $('#MCT_EDITAR_CRN_Responsable').val());
                        

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
                                    $('#modal-edit-Cronograma').modal('hide');
                                    $('#form_edit-Cronograma')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form2 = $('#form_edit-Cronograma');
            var rules2 = {
                MCT_CRN_Actividad:{minlength: 1, maxlength: 190, required: true},
                MCT_CRN_Semana_inicio:{minlength: 1, maxlength: 190, required: true, number:true},
                MCT_CRN_Semana_fin:{minlength: 1, maxlength: 190, required: true,number:true},       
                MCT_CRN_Responsable:{minlength: 1, maxlength: 190, required: true},
           
             };


            FormValidationMd.init(form2, rules2, false, EditarCronograma()); 

        
        
      


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('EstudianteGesap.VerActividades') }}' + '/' + '{{$datos['Anteproyecto']}}';

            //location.href="{{route('EstudianteGesap.index')}}";
           $(".content-ajax").load(route);
        });
   
    
})
</script>    
