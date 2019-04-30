<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualizacion de las Actividades del LIBRO'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
               <!--MODAL CREAR COMENTARIO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-libro" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create-libro', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Actividad: LIBRO</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MCT_Actividad',null,['label'=>'Actividad:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite el nombre de la actividad que desea agregar al libro','icon'=>'fa fa-book']) !!}
                                    {!! Field:: textArea('MCT_Descripcion',null,['label'=>'Descripción : ','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Coloque la decripción de esa actividad','icon'=>'fa fa-book']) !!}
                             
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
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ( ['id'=>'form_mct_actividades', 'url' => '/forms'])  !!}

                <div class="form-body">
               
                    @permission('GESAP_ADMIN_ACT_LIBRO')<a href="javascript:;"
                                                       class="btn btn-simple btn-success btn-icon create"
                                                       title="Registar una Actividad">
                            <i class="fa fa-plus">
                            </i>Agregar Nuevo Elemento Al Libro
                        </a>@endpermission
                        @permission('GESAP_ADMIN_LIBRO_DATE')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon limit"
                                                       title="Fechas limite mct">
                            <i class="fa fa-plus">
                            </i>FECHAS LIMITE
                        </a>@endpermission
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaActividades'])
                        @slot('columns', [
                            'Actividad',
                            'Descripcion',
                            'Formato',
                            'Acciones',
                            
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
        table = $('#listaActividades');
        url = '{{ route('Proyecto.listaActividadesLibro') }}';
    
         
    
        columns = [
            {data: 'MCT_Actividad', name: 'MCT_Actividad'},
            {data: 'MCT_Descripcion', name: 'MCT_Descripcion'},
            {data: 'Formato', name: 'Formato'},
            
            
      
            {
                defaultContent: '@permission('GESAP_ADMIN_DELETE_ACTIVIDAD_LIBRO')<a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission' ,
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

        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('Proyecto.mctdestroyLibro') }}' + '/' + dataTable.PK_MCT_IdMctr008;
             var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar esta Actividad?",
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
                        swal("Cancelado", "No se eliminó la actividad", "error");
                    }
                });

        });
        


       
        $(".create").on('click', function (e) {
            e.preventDefault();
            $('#modal-create-libro').modal('toggle');
        });
        

        var crearante = function(){
           return{
               init : function (){
                    var formData = new FormData();
                    var route = '{{ route('Proyectos.createlibro') }}';
                    var async = async || false;
                    var type = 'POST';

                    formData.append('MCT_Actividad', $('#MCT_Actividad').val());
                    formData.append('MCT_Descripcion', $('#MCT_Descripcion').val());
                    formData.append('FK_Id_Formato', 3);
                    
                   
                   
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
                                    $('#modal-create-libro').modal('hide');
                                    $('#form_create-libro')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('Proyecto.Libro') }}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('Proyecto.Libro') }}';

                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });

               }
           }
       }
       var form = $('#form_create-libro');
        var formRules = {
            MCT_Actividad: {minlength: 1, maxlength: 100, required: true,},
            MCT_Descripcion: {minlength: 1, maxlength: 350, required: true,},
           
        };

      
        FormValidationMd.init(form, formRules, false, crearante());



        $(".limit").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Proyectos.LibroLimit') }}';
            $(".content-ajax").load(route);
        });  
        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Proyectos.indexajax') }}';
            location.href="{{route('Proyectos.indexajax')}}";
           // $(".content-ajax").load(route);
        });
    });
</script>

