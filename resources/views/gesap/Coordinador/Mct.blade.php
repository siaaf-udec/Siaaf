<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del Anteproyecto'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ( ['id'=>'form_update_anteproyecto', 'url' => '/forms'])  !!}

                <div class="form-body">
               
                    @permission('GESAP_CREATE_USER')<a href="javascript:;"
                                                       class="btn btn-simple btn-success btn-icon create"
                                                       title="Registar un nuevo anteproyecto">
                            <i class="fa fa-plus">
                            </i>Agregar Nuevo Elemento Al Mct
                        </a>@endpermission
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaActividades'])
                        @slot('columns', [
                            'Actividad',
                            'Descripcion',
                            'Acciones'
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
        
        var table, url, columns;
        table = $('#listaActividades');
        url = '{{ route('AnteproyectosGesap.listaActividades') }}';
    
         
    
        columns = [
            {data: 'MCT_Actividad', name: 'MCT_Actividad'},
            {data: 'MCT_Descripcion', name: 'MCT_Descripcion'},
            
            
      
            {
                defaultContent: '@permission('DELETE_DESARROLLADOR')<a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission' ,
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

        


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
    });
</script>

