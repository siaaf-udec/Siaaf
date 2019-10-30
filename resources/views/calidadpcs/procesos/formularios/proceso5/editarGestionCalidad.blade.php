<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
    <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Planificar la gestión de la calidad.</h4>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
            @slot('columns', [
            '#',
            'Nombre Sprint',
            'Requerimientos',
            'Responsables',
            'Entrega',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal-create-permission" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Agregar Entrega</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('FK_CPP_Id_Proyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}


                                    {!! Field:: hidden ('PK_CPC_Id_Sprint', null)!!}

                                    {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-tag'] ) !!}

                                    {!! Field:: text('Requerimientos',null,['label'=>'Requerimientos:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-sliders'] ) !!}

                                    {!! Field:: text('Responsables',null,['label'=>'Responsables:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre del sprint.', 'icon' => 'fa fa-users'] ) !!}
                                    
                                    {!! Field:: text('CPC_Entregable',null,['label'=>'Tareas a realizar :',  'max' => '300', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite las tareas que se van a cumplir en el sprint.', 'icon' => 'fa fa-file-text-o']) !!}
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
    <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                        <a href="javascript:;" class="btn btn-success button-cancel">
                            Continuar <i class="fa fa-angle-right"></i>
                        </a>
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
                data: 'CPC_Entregable',
                name: 'CPC_Entregable'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success agregar"  title="Agregar entrega a este sprint" ><i class="fa fa-pencil-square-o"></i></a>',
                data: 'action',
                name: 'Acciones',
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

        table.on('click', '.agregar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('calidadpcs.procesosCalidad.agregarEntrega') }}'+ '/'+ dataTable.PK_CPC_Id_Sprint;

            $.get( route_edit, function( info ) {
                $('input[name="PK_CPC_Id_Sprint"]').val(info.data.PK_CPC_Id_Sprint);
                $('input[name="CPC_Nombre_Sprint"]').val(info.data.CPC_Nombre_Sprint);
                $('input[name="Requerimientos"]').val(info.data.requerimientos);
                $('input[name="Responsables"]').val(info.data.responsables);
                $('input[name="CPC_Entregable"]').val(info.data.CPC_Entregable);
                $('#modal-create-permission').modal('toggle');
            });
        });

        var createModal = function () {
            return{
                init: function () {
                    var id_sprint =  $('input:hidden[name="PK_CPC_Id_Sprint"]').val();
                    var route = '{{ route('calidadpcs.procesosCalidad.updateProceso5') }}'+'/'+ id_sprint;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('CPC_Entregable', $('input:text[name="CPC_Entregable"]').val());
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                // table.ajax.reload();
                                table.ajax.reload();
                                $('#modal-create-permission').modal('hide');
                                $('#form_permissions_update')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_create_modal = $('#form_permissions_update');
        var rules_create_modal = {
            CPC_Entregable: { required: true, minlength: 3, maxlength: 300, noSpecialCharacters:true, letters:false },
        };
        var formMessage = {
            CPC_Entregable: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,formMessage,createModal());
    });

    $(".guardarCosto").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso5') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('FK_CPP_Id_Proyecto', {{$idProyecto}});
                    formData.append('FK_CPP_Id_Proceso', {{$idProceso}});
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function(response, xhr, request) {
                            if (response.data == 422) {
                                xhr = "warning"
                                UIToastr.init(xhr, response.title, response.message);
                            } else {
                                if (request.status === 200 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
                                }
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

</script>