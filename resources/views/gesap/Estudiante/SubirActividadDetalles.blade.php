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
             <!--MODAL CREAR Persona-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-person" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_create-person', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir persona</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: Text('MCT_Detalles_Entidad',null,['label'=>'Entidad:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite la entidad del proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Primer_Apellido',null,['label'=>'Primer Apellido:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su primer Apellido','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Segundo_Apellido',null,['label'=>'Segundo Apellido:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su segundo Apellido','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Nombres',null,['label'=>'Nombre:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su nombre','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('MCT_Detalles_Genero',['Masculino'=>'Masculino', 'Femenino'=>'Femenino'],null,['label'=>'Genero: ']) !!}
                                   {!! Field:: date('MCT_Detalles_Fecha_Nacimiento',null,['label'=>'Fecha Nacimiento:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Coloque su fecha de nacimiento','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Pais',null,['label'=>'Pais:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite su pais de nacimiento','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Correo',null,['label'=>'Correo:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su correo','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('MCT_Detalles_Tipo_Doc',['Cédula de Ciudadania'=>'Cédula de Ciudadania', 'Registro civil de nacimiento'=>'Registro civil de nacimiento',
                                                                                     'Tarjeta de identidad'=>'Tarjeta de identidad','Cédula de Extranjeria'=>'Cédula de Extranjeria' ],null,['label'=>'Tipo Documento: ']) !!}
                                   {!! Field:: Text('MCT_Detalles_Numero',null,['label'=>'Número:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite Numero de Identificación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Funcion',null,['label'=>'Función del proyecto:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite la función que ejerce en el proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Horas_Semanales',null,['label'=>'Dedicación horas semanales:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite la cantidad de horas semanales aplicadas al proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Numero_meses',null,['label'=>'Número de meses:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite el numero de meses que tarda en el proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_Detalles_Tipo_vinculacion',null,['label'=>'Tipo vinculación del proyecto:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite su tipó de vinculación','icon'=>'fa fa-book']) !!}
                               
                               
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
            <!--MODAL CREAR persona-->
            <!--MODAL EDITAR Persona-->
            <!-- Modal -->
            <div class="modal fade" id="modal-edit-person" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_edit-person', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Editar persona</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Entidad',null,['label'=>'Entidad:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite la entidad del proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Primer_Apellido',null,['label'=>'Primer Apellido:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su primer Apellido','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Segundo_Apellido',null,['label'=>'Segundo Apellido:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su segundo Apellido','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Nombres',null,['label'=>'Nombre:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su nombre','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('MCT_EDITAR_Detalles_Genero',['Masculino'=>'Masculino', 'Femenino'=>'Femenino'],null,['label'=>'Genero: ']) !!}
                                   {!! Field:: date('MCT_EDITAR_Detalles_Fecha_Nacimiento',null,['label'=>'Fecha Nacimiento:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Coloque su fecha de nacimiento','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Pais',null,['label'=>'Pais:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite su pais de nacimiento','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Correo',null,['label'=>'Correo:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su correo','icon'=>'fa fa-book']) !!}
                                   {!! Field::select('MCT_EDITAR_Detalles_Tipo_Doc',['Cédula de Ciudadania'=>'Cédula de Ciudadania', 'Registro civil de nacimiento'=>'Registro civil de nacimiento',
                                                                                     'Tarjeta de identidad'=>'Tarjeta de identidad','Cédula de Extranjeria'=>'Cédula de Extranjeria' ],null,['label'=>'Tipo Documento: ']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Numero',null,['label'=>'Número:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite Numero de Identificación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Funcion',null,['label'=>'Función del proyecto:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite la función que ejerce en el proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Horas_Semanales',null,['label'=>'Dedicación horas semanales:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite la cantidad de horas semanales aplicadas al proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Numero_meses',null,['label'=>'Número de meses:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite el numero de meses que tarda en el proyecto','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('MCT_EDITAR_Detalles_Tipo_vinculacion',null,['label'=>'Tipo vinculación del proyecto:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite su tipó de vinculación','icon'=>'fa fa-book']) !!}
                               
                               
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
            <!--MODAL EDITAR persona-->
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


                                {!! Field:: text('MCT_Descripcion',$datos[0]['MCT_descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','maxlength'=>'500','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                               
                               </div>
                             
                        </div>
                        {!! Field:: text('CMMT_Commit',$datos['Commit'],['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','maxlength'=>'500','readonly','autocomplete'=>'off'],
                    
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}
                    @if($datos['Estado'] != "APROBADO" )
                                
                    @permission('ADD_ACTIVIDAD_STUDENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon person"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Persona
                        </a>@endpermission
                    @endif
                    <br><br>
                    @if($datos['Estado'] != "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'DetallesPerson'])
                    @slot('columns', [
                            'Entidad',
                            'Primer Apellido',
                            'Segundo Apellido',
                            'Nombres',
                            'Genero',
                            'Fecha Nacimiento',
                            'Pais',
                            'Correo Electrónico',
                            'Tipo Identificación',
                            'Numero',
                            'Función del proyecto',
                            'Dedicación horas semanales',
                            'Número de meses',
                            'Tipo de vinculación del proyecto',
                            'Acciónes',
    
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] == "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'DetallesPersonF'])
                    @slot('columns', [
                            'Entidad',
                            'Primer Apellido',
                            'Segundo Apellido',
                            'Nombres',
                            'Genero',
                            'Fecha Nacimiento',
                            'Pais',
                            'Correo Electrónico',
                            'Tipo Identificación',
                            'Numero',
                            'Función del proyecto',
                            'Dedicación horas semanales',
                            'Número de meses',
                            'Tipo de vinculación del proyecto',
                          
    
                    ])
                    @endcomponent
                    @endif
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('CANCEL_STUDENT')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>@endpermission
                               
                            </div>
                            
                        </div>
                        
                    </div>
                    <h4> Observaciónes acerca de esta Actividad del Mct</h4>
                    <br><br>
                    @permission('STUDENT_COMENT')<a href="javascript:;"
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
        
        table1 = $('#DetallesPerson');
       
           
        url1 = '{{ route('EstudianteGesap.DetallesPersona') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columns1 = [
            
            {data: 'MCT_Detalles_Entidad', name: 'MCT_Detalles_Entidad'},
            {data: 'MCT_Detalles_Primer_Apellido', name: 'MCT_Detalles_Primer_Apellido'},
            {data: 'MCT_Detalles_Segundo_Apellido', name: 'MCT_Detalles_Segundo_Apellido'},            
            {data: 'MCT_Detalles_Nombres', name: 'MCT_Detalles_Nombres'},
            {data: 'MCT_Detalles_Genero', name: 'MCT_Detalles_Genero'},
            {data: 'MCT_Detalles_Fecha_Nacimiento', name: 'MCT_Detalles_Fecha_Nacimiento'},
            {data: 'MCT_Detalles_Pais', name: 'MCT_Detalles_Pais'},            
            {data: 'MCT_Detalles_Correo', name: 'MCT_Detalles_Correo'},
            {data: 'MCT_Detalles_Tipo_Doc', name: 'MCT_Detalles_Tipo_Doc'},
            {data: 'MCT_Detalles_Numero', name: 'MCT_Detalles_Numero'},
            {data: 'MCT_Detalles_Funcion', name: 'MCT_Detalles_Funcion'},            
            {data: 'MCT_Detalles_Horas_Semanales', name: 'MCT_Detalles_Horas_Semanales'},
            {data: 'MCT_Detalles_Numero_meses', name: 'MCT_Detalles_Numero_meses'},
            {data: 'MCT_Detalles_Tipo_vinculacion', name: 'MCT_Detalles_Tipo_vinculacion'},
           
            {
                defaultContent: ' @permission('DELETE_STUDENT')<a href="javascript:;" title="Eliminar" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission @permission('UPDATE_STUDENT')<a href="javascript:;" title="Editar" class="btn btn-warning Editar" ><i class="icon-pencil"></i></a>@endpermission ' ,
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
        
        table2 = $('#DetallesPersonF');
       
           
        url2 = '{{ route('EstudianteGesap.DetallesPersona') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columns2 = [
            
            {data: 'MCT_Detalles_Entidad', name: 'MCT_Detalles_Entidad'},
            {data: 'MCT_Detalles_Primer_Apellido', name: 'MCT_Detalles_Primer_Apellido'},
            {data: 'MCT_Detalles_Segundo_Apellido', name: 'MCT_Detalles_Segundo_Apellido'},            
            {data: 'MCT_Detalles_Nombres', name: 'MCT_Detalles_Nombres'},
            {data: 'MCT_Detalles_Genero', name: 'MCT_Detalles_Genero'},
            {data: 'MCT_Detalles_Fecha_Nacimiento', name: 'MCT_Detalles_Fecha_Nacimiento'},
            {data: 'MCT_Detalles_Pais', name: 'MCT_Detalles_Pais'},            
            {data: 'MCT_Detalles_Correo', name: 'MCT_Detalles_Correo'},
            {data: 'MCT_Detalles_Tipo_Doc', name: 'MCT_Detalles_Tipo_Doc'},
            {data: 'MCT_Detalles_Numero', name: 'MCT_Detalles_Numero'},
            {data: 'MCT_Detalles_Funcion', name: 'MCT_Detalles_Funcion'},            
            {data: 'MCT_Detalles_Horas_Semanales', name: 'MCT_Detalles_Horas_Semanales'},
            {data: 'MCT_Detalles_Numero_meses', name: 'MCT_Detalles_Numero_meses'},
            {data: 'MCT_Detalles_Tipo_vinculacion', name: 'MCT_Detalles_Tipo_vinculacion'},
           
           
        ];
        dataTableServer.init(table2, url2, columns2);
        table2 = table2.DataTable();

        
        $('.person').on('click', function (e) {
            e.preventDefault();
            $('#modal-create-person').modal('toggle');
        });
        var CrearPersona = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.PersonaDatos') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('MCT_Detalles_Entidad', $('#MCT_Detalles_Entidad').val());
                        formData.append('MCT_Detalles_Primer_Apellido', $('#MCT_Detalles_Primer_Apellido').val());
                        formData.append('MCT_Detalles_Segundo_Apellido', $('#MCT_Detalles_Segundo_Apellido').val());
                        formData.append('MCT_Detalles_Nombres', $('#MCT_Detalles_Nombres').val());
                        formData.append('MCT_Detalles_Genero', $('select[name="MCT_Detalles_Genero"]').val());
                        formData.append('MCT_Detalles_Fecha_Nacimiento', $('[name="MCT_Detalles_Fecha_Nacimiento"]').val());
                        formData.append('MCT_Detalles_Pais', $('#MCT_Detalles_Pais').val());
                        formData.append('MCT_Detalles_Correo', $('#MCT_Detalles_Correo').val());
                        formData.append('MCT_Detalles_Tipo_Doc', $('#MCT_Detalles_Tipo_Doc').val());
                        formData.append('MCT_Detalles_Numero', $('#MCT_Detalles_Numero').val());
                        formData.append('MCT_Detalles_Funcion', $('#MCT_Detalles_Funcion').val());
                        formData.append('MCT_Detalles_Horas_Semanales', $('#MCT_Detalles_Horas_Semanales').val());
                        formData.append('MCT_Detalles_Numero_meses',$('#MCT_Detalles_Numero_meses').val());
                        formData.append('MCT_Detalles_Tipo_vinculacion', $('#MCT_Detalles_Tipo_vinculacion').val());
            
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
                                    $('#modal-create-person').modal('hide');
                                    $('#from_create-person')[0].reset(); //Limpia formulario
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
            var form1 = $('#from_create-person');
            var rules1 = {
                
            MCT_Detalles_Entidad:{minlength: 1, maxlength: 30, required: true},
            MCT_Detalles_Primer_Apellido:{minlength: 1, maxlength: 20, required: true},
            MCT_Detalles_Segundo_Apellido:{minlength: 1, maxlength: 20, required: true},
            MCT_Detalles_Nombres:{minlength: 1, maxlength: 40, required: true},
            MCT_Detalles_Genero:{required: true},
            MCT_Detalles_Fecha_Nacimiento:{required: true},
            MCT_Detalles_Pais:{minlength: 1, maxlength: 20, required: true},
            MCT_Detalles_Correo:{minlength: 1, maxlength: 40, required: true, email:true},
            MCT_Detalles_Tipo_Doc:{required: true},
            MCT_Detalles_Numero:{minlength: 1, maxlength: 20, required: true, number: true,},
            MCT_Detalles_Funcion:{minlength: 1, maxlength: 30, required: true},
            MCT_Detalles_Horas_Semanales:{minlength: 1, maxlength: 2, required: true, number: true,},
            MCT_Detalles_Numero_meses:{minlength: 1, maxlength: 2, required: true, number: true,},
            MCT_Detalles_Tipo_vinculacion:{minlength: 1, maxlength: 25, required: true},
         
              
            };

            FormValidationMd.init(form1, rules1, false, CrearPersona()); 

            table1.on('click', '.Eliminar', function (e) {
            e.preventDefault();
            $tr1 = $(this).closest('tr');

            var dataTable1 = table1.row($tr1).data();
            var route1 = '{{ route('EstudianteGesap.PersonaDatosdelete') }}' + '/' + dataTable1.PK_Id_Dpersona;
            var type1 = 'DELETE';
            var async1 = async1 || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar esta persona?",
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
                        swal("Cancelado", "No se eliminó ninguna persona", "error");
                    }
                });

        });
        var id_persona = 0;
        table1.on('click', '.Editar', function (e) {
            e.preventDefault();
            $('#modal-edit-person').modal('toggle');
            $tr1 = $(this).closest('tr');
            var dataTable1 = table1.row($tr1).data();
            id_persona = dataTable1.PK_Id_Dpersona;
            $('#MCT_EDITAR_Detalles_Entidad').val(dataTable1.MCT_Detalles_Entidad);
            $('#MCT_EDITAR_Detalles_Primer_Apellido').val(dataTable1.MCT_Detalles_Primer_Apellido);
            $('#MCT_EDITAR_Detalles_Segundo_Apellido').val(dataTable1.MCT_Detalles_Segundo_Apellido);
            $('#MCT_EDITAR_Detalles_Nombres').val(dataTable1.MCT_Detalles_Nombres);
            $('#MCT_EDITAR_Detalles_Genero').val(dataTable1.MCT_Detalles_Genero);
            $('#MCT_EDITAR_Detalles_Fecha_Nacimiento').val(dataTable1.MCT_Detalles_Fecha_Nacimiento);
            $('#MCT_EDITAR_Detalles_Pais').val(dataTable1.MCT_Detalles_Pais);
            $('#MCT_EDITAR_Detalles_Correo').val(dataTable1.MCT_Detalles_Correo);
            $('#MCT_EDITAR_Detalles_Tipo_Doc').val(dataTable1.MCT_Detalles_Tipo_Doc);
            $('#MCT_EDITAR_Detalles_Numero').val(dataTable1.MCT_Detalles_Numero);
            $('#MCT_EDITAR_Detalles_Funcion').val(dataTable1.MCT_Detalles_Funcion);
            $('#MCT_EDITAR_Detalles_Horas_Semanales').val(dataTable1.MCT_Detalles_Horas_Semanales);
            $('#MCT_EDITAR_Detalles_Numero_meses').val(dataTable1.MCT_Detalles_Numero_meses);
            $('#MCT_EDITAR_Detalles_Tipo_vinculacion').val(dataTable1.MCT_Detalles_Tipo_vinculacion);
        });

        var EditaPersona = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.EditarPersonaDatos') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('PK_Id_EDITAR_Dpersona', id_persona);
                        formData.append('MCT_EDITAR_Detalles_Entidad', $('#MCT_EDITAR_Detalles_Entidad').val());
                        formData.append('MCT_EDITAR_Detalles_Primer_Apellido', $('#MCT_EDITAR_Detalles_Primer_Apellido').val());
                        formData.append('MCT_EDITAR_Detalles_Segundo_Apellido', $('#MCT_EDITAR_Detalles_Segundo_Apellido').val());
                        formData.append('MCT_EDITAR_Detalles_Nombres', $('#MCT_EDITAR_Detalles_Nombres').val());
                        formData.append('MCT_EDITAR_Detalles_Genero', $('select[name="MCT_EDITAR_Detalles_Genero"]').val());
                        formData.append('MCT_EDITAR_Detalles_Fecha_Nacimiento', $('[name="MCT_EDITAR_Detalles_Fecha_Nacimiento"]').val());
                        formData.append('MCT_EDITAR_Detalles_Pais', $('#MCT_EDITAR_Detalles_Pais').val());
                        formData.append('MCT_EDITAR_Detalles_Correo', $('#MCT_EDITAR_Detalles_Correo').val());
                        formData.append('MCT_EDITAR_Detalles_Tipo_Doc', $('#MCT_EDITAR_Detalles_Tipo_Doc').val());
                        formData.append('MCT_EDITAR_Detalles_Numero', $('#MCT_EDITAR_Detalles_Numero').val());
                        formData.append('MCT_EDITAR_Detalles_Funcion', $('#MCT_EDITAR_Detalles_Funcion').val());
                        formData.append('MCT_EDITAR_Detalles_Horas_Semanales', $('#MCT_EDITAR_Detalles_Horas_Semanales').val());
                        formData.append('MCT_EDITAR_Detalles_Numero_meses',$('#MCT_EDITAR_Detalles_Numero_meses').val());
                        formData.append('MCT_EDITAR_Detalles_Tipo_vinculacion', $('#MCT_EDITAR_Detalles_Tipo_vinculacion').val());         


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
                                    $('#modal-edit-person').modal('hide');
                                    $('#form_edit-person')[0].reset(); //Limpia formulario
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
            var form2 = $('#form_edit-person');
            var rules2 = {
            PK_Id_EDITAR_Dperson: {minlength: 1, maxlength: 10, required: true, number: true,},//opcional
            MCT_EDITAR_Detalles_Entidad:{minlength: 1, maxlength: 30, required: true},
            MCT_EDITAR_Detalles_Primer_Apellido:{minlength: 1, maxlength: 20, required: true},
            MCT_EDITAR_Detalles_Segundo_Apellido:{minlength: 1, maxlength: 20, required: true},
            MCT_EDITAR_Detalles_Nombres:{minlength: 1, maxlength: 40, required: true},
            MCT_EDITAR_Detalles_Genero:{required: true},
            MCT_EDITAR_Detalles_Fecha_Nacimiento:{required: true},
            MCT_EDITAR_Detalles_Pais:{minlength: 1, maxlength: 20, required: true},
            MCT_EDITAR_Detalles_Correo:{minlength: 1, maxlength: 40, required: true, email:true},
            MCT_EDITAR_Detalles_Tipo_Doc:{required: true},
            MCT_EDITAR_Detalles_Numero:{minlength: 1, maxlength: 20, required: true, number: true,},
            MCT_EDITAR_Detalles_Funcion:{minlength: 1, maxlength: 30, required: true},
            MCT_EDITAR_Detalles_Horas_Semanales:{minlength: 1, maxlength: 3, required: true, number: true,},
            MCT_EDITAR_Detalles_Numero_meses:{minlength: 1, maxlength: 2, required: true, number: true,},
            MCT_EDITAR_Detalles_Tipo_vinculacion:{minlength: 1, maxlength: 25, required: true},
            };

            FormValidationMd.init(form2, rules2, false, EditaPersona()); 

        
        
      


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('EstudianteGesap.VerActividades') }}' + '/' + '{{$datos['Anteproyecto']}}';

            //location.href="{{route('EstudianteGesap.index')}}";
           $(".content-ajax").load(route);
        });
   
    
})
</script>    
