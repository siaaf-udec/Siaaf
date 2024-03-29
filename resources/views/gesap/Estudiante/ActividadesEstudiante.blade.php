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
           
                {!! Form::model ([$Anteproyecto], ['id'=>'form_mct_actividades', 'url' => '/forms'])  !!}
                
            
                <div class="form-body">
                @permission('GESAP_STUDENT_VER_REQ')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon Requerimientos"
                                                       title="Requerimientos">
                            <i class="fa fa-plus">
                            </i>Requerimientos
                        </a>@endpermission    
                   
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaActividades'])
                        @slot('columns', [
                            '#',
                            'Actividad',
                            'Descripción',
                            'CheckList',
                            'Acciones'
                        ])
                    @endcomponent
          
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('GESAP_STUDENT_CANCEL')<a href="javascript:;"
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
        
        idp='{{  $Anteproyecto  }}';
        var table, url, columns;
        table = $('#listaActividades');
        url = '{{ route('EstudianteGesap.VerActividadesList') }}'+'/'+'{{  $Anteproyecto  }}';
    
        
    
        columns = [
            {data: 'Numero', name: 'Numero'},
            {data: 'MCT_Actividad', name: 'MCT_Actividad'},
            {data: 'MCT_Descripcion', name: 'MCT_Descripcion'},
            {data: 'Check', name: 'Check'},
            
            
      
            {
                defaultContent: '@permission('GESAP_STUDENT_VER_ACTIVIDAD')<a href="javascript:;" title="Subir Actividad" class="btn btn-simple btn-warning btn-icon Actividad"><i class="icon-plus"></i></a>@endpermission' ,
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
            var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + dataTable.PK_MCT_IdMctr008 + '/'+ idp;
            //location.href="{{route('AnteproyectosGesap.index')}}";
            $(".content-ajax").load(route);

        });
        
        $('.Requerimientos').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('EstudianteGesap.VerRequerimientos') }}' + '/' + idp;
           $(".content-ajax").load(route);

     //      $(".content-ajax").load(route_ver);
        });

       
      

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
           // var route = '{{ route('EstudianteGesap.index.ajax') }}';

            location.href="{{route('EstudianteGesap.index')}}";

           // $(".content-ajax").load(route);
        });
    });
</script>

