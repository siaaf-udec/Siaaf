<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de desarrolladores de Anteproyecto de grado'])

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

                         
                      
          
                    </div>
                    <br><br>
                    <br><br>
                  
                        @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'listadesarrolladoreslist'])
                        @slot('columns', [
                            'Cedula',
                            'Codigo',
                            'Nombre',
                            'Apellido',
                            'Correo',
                            'Asignar'
                        ])
                    @endcomponent
          
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('ADMIN_GESAP')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>
                                @endpermission
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
    
   
        var table, url, columns;
        id = '{{  $datos[0]['PK_NPRY_IdMctr008']  }}';
        table = $('#listadesarrolladoreslist');
        url = '{{ route('AnteproyectosGesap.AsignarDesarrolladoreslist') }}';
    
         
    
        columns = [
            // {data: 'PK_User_Codigo', name: 'PK_User_Codigo'},
            // {data: 'User_Cedula', name: 'User_Cedula'},
            // {data: 'User_Nombre1', name: 'User_Nombre1'},
            // {data: 'User_Apellido1', name: 'User_Apellido1'},
            // {data: 'User_Correo', name: 'User_Correo'},
            
            {data: 'Cedula', name: 'Cedula'},
            {data: 'Codigo', name: 'Codigo'},
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Apellido', name: 'Apellido'},
            {data: 'Correo', name: 'Correo'},
            
            
      
             {
                defaultContent: '@permission('ADD_DEVELOPER')<a href="javascript:;" title="Asignar" class="btn btn-simple btn-warning btn-icon crear"><i class="icon-plus"></i></a>@endpermission' ,
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
   
    
    
    table.on('click', '.crear', function (e) {
                    var route = '{{ route('AnteproyectosGesap.desarrolladorStore') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    
                    e.preventDefault();
                    $tr = $(this).closest('tr');
                    var dataTable = table.row($tr).data();

                    
                    
                    formData.append('FK_NPRY_IdMctr008', '{{  $datos[0]['PK_NPRY_IdMctr008']  }}' );
                    formData.append('PK_User_Codigo', dataTable.Cedula);
                    
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
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                if (response.data == 422) {
                                    xhr = "warning"
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('AnteproyectosGesap.AsignarDesarrollador') }}'+ '/' + id;
                                   // location.href="{{route('AnteproyectosGesap.AsignarDesarrollador')}}"+ '/' + id;
                                    $(".content-ajax").load(route);;
                                } else {
                                   // $('#form_usuario_create')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('AnteproyectosGesap.AsignarDesarrollador') }}'+ '/' + id;
                                    //location.href="{{route('AnteproyectosGesap.AsignarDesarrollador')}}"+ '/' + id;
                                    $(".content-ajax").load(route);
                                    }
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
    });
    $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectoGesap.VerAnteproyecto') }}' + '/' + id;
           // location.href="{{route('AnteproyectosGesap.index')}}";
            $(".content-ajax").load(route);
        });
    
});
</script>
