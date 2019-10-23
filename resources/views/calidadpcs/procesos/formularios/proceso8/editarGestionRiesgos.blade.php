<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Gestión de riesgos del proyecto.</h4>
        <br>
        <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="glyphicon glyphicon-plus"></i>Agregar</a>
                </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
            @slot('columns', [
            '#',
            'Riesgo',
            'Caracteristicas',
            'Importancia',
            'Accion',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_create" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Agregar Riesgo</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                    {!! Field:: text('Riesgo',null,['label'=>'Riesgo:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-warning '] ) !!}

                                    {!! Field:: text('Caracteristicas',null,['label'=>'Caracteristicas:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-list-alt'] ) !!}

                                    {!! Field::select('Importancia:',['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5' ],null,['name' => 'Importancia']) !!}
                                    
                                    {!! Field:: text('Accion',null,['label'=>'Accion:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-bolt'] ) !!}
                                    
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
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_edit" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_edit', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Editar Riesgo</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('idRiesgo')!!}

                                    {!! Field:: text('Riesgo_Edit',null,['label'=>'Riesgo:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-warning '] ) !!}

                                    {!! Field:: text('Caracteristicas_Edit',null,['label'=>'Caracteristicas:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-list-alt'] ) !!}

                                    {!! Field::select('Importancia:',['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5' ],null,['name' => 'Importancia_Edit']) !!}
                                    
                                    {!! Field:: text('Accion_Edit',null,['label'=>'Accion:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-bolt'] ) !!}
                                    
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
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaGestionRiesgos')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPGR_Riesgo',
                name: 'CPGR_Riesgo'
            },
            {
                data: 'CPGR_Caracteristicas',
                name: 'CPGR_Caracteristicas'
            },
            {
                data: 'CPGR_Importancia',
                name: 'CPGR_Importancia'
            },
            {
                data: 'CPGR_Accion',
                name: 'CPGR_Accion'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-sm btn-success editar"  title="Editar este Riesgo" ><i class="fa fa-pencil-square-o"></i></a> <a href="javascript:;" class="btn btn-sm btn-danger eliminar"  title="Eliminar este riesgo" ><i class="fa fa-trash-o"></i></a>',
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

        $(".pmd-select2").select2({
                width: '100%',
                placeholder: "Selecccionar",
            });

            $(".create").on('click', function(e) {
            e.preventDefault();
            $('#modal_create').modal('toggle');
             });

            
             var createModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.storeProceso8') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('Riesgo', $('input:text[name="Riesgo"]').val());
                    formData.append('Caracteristicas', $('input:text[name="Caracteristicas"]').val());
                    formData.append('Importancia', $('select[name="Importancia"]').val());
                    formData.append('Accion', $('input:text[name="Accion"]').val());
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
                                $('#modal_create').modal('hide');
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,false,createModal());
        
        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso8_1') }}';
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

        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idRiesgo"]').val(dataTable.PK_CPGR_Id_Riesgo);
            $("#Riesgo_Edit").val(dataTable.CPGR_Riesgo);
            $("#Caracteristicas_Edit").val(dataTable.CPGR_Caracteristicas);
            $('select[name="Importancia_Edit"]').val(dataTable.CPGR_Importancia);
            $('select[name="Importancia_Edit"]').trigger('change');
            $("#Accion_Edit").val(dataTable.CPGR_Accion);

            $('#modal_edit').modal('toggle');
        });

        var EditModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateProceso8') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('idRiesgo',  $('input:hidden[name="idRiesgo"]').val());
                    formData.append('Riesgo', $('input:text[name="Riesgo_Edit"]').val());
                    formData.append('Caracteristica', $('input:text[name="Caracteristicas_Edit"]').val());
                    formData.append('Importancia', $('select[name="Importancia_Edit"]').val());
                    formData.append('Accion', $('input:text[name="Accion_Edit"]').val());

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
                                $('#modal_edit').modal('hide');
                                $('#form_edit')[0].reset(); //Limpia formulario
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

        var form_edit_modal = $('#form_edit');
        var rules_edit_modal = {
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_edit_modal,rules_edit_modal,false,EditModal());

        table.on('click', '.eliminar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = "{{route('calidadpcs.procesosCalidad.deleteProceso8')}}"+"/"+ dataTable.PK_CPGR_Id_Riesgo;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este riesgo?",
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
                        swal("Cancelado", "No se eliminó ningun riesgo", "error");
                    }
                });
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

    });
</script> 