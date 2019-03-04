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
              
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
                        @slot('columns', [
                            'Titulo',
                            'Palabras Clave',
                            'Descripción',
                            'Director',
                            'Acciones'
                        ])
                    @endcomponent
          
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('STUDENT_BACK')<a href="javascript:;"
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
       
        table = $('#listaProyectos');
        url = '{{ route('EstudianteGesap.BancoProyectosList') }}';

        columns = [
   
            {data: 'Titulo', name: 'Titulo'},
            {data: 'Palabras', name: 'Palabras'},
            {data: 'Descripcion', name: 'Descripcion'},
            {data: 'Director', name: 'Director'},

             {
                defaultContent: '@permission('ADD_DEVELOPER')<a href="javascript:;" title="Ver Archivos" class="btn btn-simple btn-warning btn-icon Ver"><i class="icon-eye"></i></a>@endpermission' ,
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

        table.on('click', '.Ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('EstudianteGesap.VerProyectoCompleto') }}' + '/' + dataTable.Codigo;
            $(".content-ajax").load(route);

        });
        
        
        
        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
           // var route = '{{ route('EstudianteGesap.index.ajax') }}';

            location.href="{{route('EstudianteGesap.index')}}";

           // $(".content-ajax").load(route);
        });
      
    });
</script>

