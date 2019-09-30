<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Proyectos:'])
        <div class="row">
        <div class="col-md-12">
        <h3>
        Controlar las comunicaciones.
    </h3>
        </div>
    </div>
    <br>
    <br>
    

                        <div class="row">
        <div class="col-md-12">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([[$idProceso],[$infoProyecto]],['id'=>'form_create_proceso_1', 'url' => '/forms']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">

                     {{--   {!! Field:: hidden ('FK_CPP_Id_Proyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}

                        {!! Field:: hidden ('FK_CPP_Id_Proceso', $idProceso) !!}  --}} 

                        {!! Field:: text('Entidades',null,['label'=>'Cantidad de Reuniones con interesados esperadas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                        {!! Field:: text('Entidades',null,['label'=>'Cantidad de Reuniones con interesados realizadas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                        {!! Field:: text('Entidades',null,['label'=>'Cantidad de Reuniones con el equipo esperadas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                        {!! Field:: text('Entidades',null,['label'=>'Cantidad de Reuniones con el equipo realizadas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                        ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                        @permission('CALIDADPCS_CREATE_PROJECT')<a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                            Cancelar
                        </a>
                        {{ Form::submit('Guardar', ['class' => 'btn blue']) }}
                        @endpermission
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
 
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaGestionCalidad')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPC_Nombre_Sprint',
                name: 'CPC_Nombre_Sprint'
            },
            {
                data: 'RequerimientoNombre',
                name: 'RequerimientoNombre'
            },
            {
                data: 'RecursoNombre',
                name: 'RecursoNombre'
            },
            {
                data: 'CPC_Duracion',
                name: 'CPC_Duracion'
            },
            {
                data: 'CPC_Entregable',
                name: 'CPC_Entregable'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Ver los procesos de este Proyecto" ><i class="fa fa-list-ul"></i></a>',
                data: 'action',
                name: 'Etapas',
                title: 'Etapas',
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
        // dataTableServer.init(table, url, columns);
        // table = table.DataTable();

        // $(".create").on('click', function(e) {
        //     e.preventDefault();
        //     var route = '{{ route('calidadpcs.proyectosCalidad.RegistrarProyecto') }}' + '/' +{{Auth::user()->id}};
        //     $(".content-ajax").load(route);
        // });

        // table.on('click', '.verEtapas', function(e) {
        //     e.preventDefault();
        //     $tr = $(this).closest('tr');
        //     var dataTable = table.row($tr).data(),
        //         route_edit = '{{ route('calidadpcs.procesosCalidad.etapas')}}'+'/'+dataTable.PK_CP_Id_Proyecto;
        //     $(".content-ajax").load(route_edit);
        // });

        // table.on('click', '.edit', function(e) {
        //     e.preventDefault();
        //     $tr = $(this).closest('tr');
        //     var dataTable = table.row($tr).data(),
        //         route_edit = '{{ route('calidadpcs.proyectosCalidad.edit')}}'+'/'+ dataTable.PK_CP_Id_Proyecto;
        //     $(".content-ajax").load(route_edit);
        // });

    });
</script> 