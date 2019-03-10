<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualizacion de las Actividades del MCT'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ( ['id'=>'form_mct_actividades', 'url' => '/forms'])  !!}

                <div class="form-body">
               
                    @permission('GESAP_CREATE_ACT_MCT')<a href="javascript:;"
                                                       class="btn btn-simple btn-success btn-icon create"
                                                       title="Registar una Actividad">
                            <i class="fa fa-plus">
                            </i>Agregar Nuevo Elemento Al Mct
                        </a>@endpermission
                        @permission('GESAP_FECHAS_MCT')<a href="javascript:;"
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
                                @permission('CANCEL_GESAP')<a href="javascript:;"
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
        url = '{{ route('AnteproyectosGesap.listaActividades') }}';
    
         
    
        columns = [
            {data: 'MCT_Actividad', name: 'MCT_Actividad'},
            {data: 'MCT_descripcion', name: 'MCT_descripcion'},
            {data: 'Formato', name: 'Formato'},
            
            
      
            {
                defaultContent: '@permission('DELETE_ACTIVIDAD_MCT')<a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission' ,
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
            var route = '{{ route('Anteproyecto.mctdestroy') }}' + '/' + dataTable.PK_MCT_IdMctr008;
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
        


        $(".limit").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.MctLimit') }}';
            $(".content-ajax").load(route);
        });  
        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.MctCreate') }}';
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

