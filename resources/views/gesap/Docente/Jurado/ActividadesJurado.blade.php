<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de  Actividades del MCT'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$Anteproyecto], ['id'=>'form_mct_actividades', 'url' => '/forms'])  !!}
            
                @permission('VER_REQ_DOCENTE')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon Requerimientos"
                                                       title="Requerimientos">
                            <i class="fa fa-plus">
                            </i>Requerimientos
                        </a>@endpermission    
                <div class="form-body">
               
               
                   
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaActividades'])
                        @slot('columns', [
                            '# jurado',
                            'Actividad',
                            'Descripcion',
                            'Acciones'
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
        url = '{{ route('DocenteGesap.VerActividadesList') }}';
    
        idp='{{  $Anteproyecto[0]  }}';
    
        columns = [
            {data: 'PK_MCT_IdMctr008', name: 'PK_MCT_IdMctr008'},
            {data: 'MCT_Actividad', name: 'MCT_Actividad'},
            {data: 'MCT_descripcion', name: 'MCT_descripcion'},
            
            
      
            {
                defaultContent: '@permission('VER_ACT_DOCENTE')<a href="javascript:;" title="Subir Actividad" class="btn btn-simple btn-warning btn-icon Actividad"><i class="icon-eye"></i></a>@endpermission' ,
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

        table.on('click', '.Actividad', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('DocenteGesap.VerActividadJurado') }}' + '/' + dataTable.PK_MCT_IdMctr008 + '/'+ idp;
            //location.href="{{route('AnteproyectosGesap.index')}}";
            $(".content-ajax").load(route);

        });
        
        $('.Requerimientos').on('click', function (e) {
            e.preventDefault();
           
            var route =  '{{ route('DocenteGesap.VerRequerimientosJurado') }}' + '/' + idp;
            //location.href="{{route('DocenteGesap.index')}}";
            $(".content-ajax").load(route);
        });

       
      

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
           
            var route =  '{{ route('DocenteGesap.VerAnteproyectoJurado') }}' + '/' + idp;
            //location.href="{{route('DocenteGesap.index')}}";
            $(".content-ajax").load(route);
        });
    });
</script>

