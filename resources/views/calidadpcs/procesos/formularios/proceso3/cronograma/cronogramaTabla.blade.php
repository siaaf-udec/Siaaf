<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Cronograma:'])
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaActividades'])
            @slot('columns', [
            '#',
            'Nombre Actividad',
            'Sprint',
            'Recurso',
            ''
            ])
            @endcomponent
        </div>
        <div class="col-md-12">
            <div class="note note-success">
                <h4 class="block">Tener en cuenta!</h4>
                <p> Recuerda que para avanzar deben estar completos los datos de la tabla</p>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">
                    @permission('CALIDADPCS_CREATE_PROJECT')<a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                    @endpermission
                </div>
            </div>
        </div>

        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="row">
    <div class="col-md-12">
    <!-- Modal -->
    <div aria-hidden="true" class="modal fade" id="modal-update-permission" role="dialog" tabindex="-1">
            <div class="">
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'from_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                        <h1>
                            Modificar 
                        </h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                            {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Nombre del Requerimiento:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
                            {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Recurso:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
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
        </div>
        </div>
    </div>
    @endcomponent
</div>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        var table, url, columns;
        table = $('#listaActividades');
        url = "{{route('calidadpcs.procesosCalidad.tablaCronograma')}}" + "/" + {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPC_Nombre_Requerimiento',
                name: 'CPC_Nombre_Requerimiento'
            },
            {
                data: 'CPC_Sprint',
                name: 'CPC_Sprint'
            },
            {
                data: 'CPC_Recurso',
                name: 'CPC_Recurso'
            },
            {
                defaultContent: '<a href="javascript:;" title="Editar" id="myb" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>',
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

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $('#modal-update-permission').modal('toggle');

            $tr = $(this).closest('tr');

            // var dataTable = table.row($tr).data(),
            //     route_edit = '{{ route('permissions.edit') }}'+ '/'+ dataTable.id;

            // $.get( route_edit, function( info ) {
            //     $('input[name="id_edit"]').val(info.data.id);
            //     $('select[name="module_edit"]').val(info.data.module_id);
            //     $('#name_edit').attr('value', info.data.name);
            //     $('#display_name_edit').attr('value', info.data.display_name);
            //     $('#description_edit').val(info.data.description);
            //     $('#modal-update-permission').modal('toggle');
            // });
        });
    });
</script>