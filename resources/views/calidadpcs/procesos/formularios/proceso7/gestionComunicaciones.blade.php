<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Proceso: Planificar la gestión de comunicaciones</h4>
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
            'Interesado',
            'Lugar',
            'Fecha',
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
                            <h3>Agregar Reunion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
 
                                    {!! Field::select('Interesado:',['Equipo scrum'=>'Equipo scrum', 'Product owner'=>'Product owner', 'Stakeholder'=>'Stakeholder' ],null,['name' => 'Interesado' ,'required']) !!}
                                    
                                    {!! Field:: text('Lugar',null,['label'=>'Lugar:', 'max' => '50', 'required', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-map-marker'] ) !!}

                                    {!! Field::text(
                                        'date_time',
                                        ['label' => 'Fecha y hora:', 'class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar']) !!}

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
                            <h3>Editar Reunion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    {!! Field:: hidden ('idReunion')!!}
                                    
                                    {!! Field::select('Interesado:',['Equipo scrum'=>'Equipo scrum', 'Product owner'=>'Product owner', 'Stakeholder'=>'Stakeholder' ],null,['name' => 'Interesado_edit','required']) !!}
                                    
                                    {!! Field:: text('Lugar_edit',null,['label'=>'Lugar:', 'max' => '50','required', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                        ['help' => 'Lugar donde va hacer la reunion.', 'icon' => 'fa fa-map-marker'] ) !!}

                                    {!! Field::text(
                                        'date_time_edit',
                                        ['label' => 'Fecha y hora:','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar']) !!}

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
                        <a href="javascript:;" class="btn btn-success guardarProceso">
                            Continuar <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaGestionComunicacion')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPGC_Interesado',
                name: 'CPGC_Interesado'
            },
            {
                data: 'CPGC_Lugar',
                name: 'CPGC_Lugar'
            },
            {
                data: 'CPGC_Fecha',
                name: 'CPGC_Fecha'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-sm btn-success editar"  title="Editar esta reunion" ><i class="fa fa-pencil-square-o"></i></a> <a href="javascript:;" class="btn btn-sm btn-danger eliminar"  title="Eliminar esta reunion" ><i class="fa fa-trash-o"></i></a>',
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
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        $(".create").on('click', function(e) {
            e.preventDefault();
            $('#modal_create').modal('toggle');
            // actualizarSemanas();
            // $tr = $(this).closest('tr');
        });

        $(".date-time-picker").datetimepicker({
                autoclose: true,
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                isRTL: App.isRTL(),
                format: "dd-mm-yyyy hh:ii",
                fontAwesome: true,
                pickerPosition: (App.isRTL() ? "bottom-left" : "bottom-left")
            });

            $(".pmd-select2").select2({
                width: '100%',
                placeholder: "Selecccionar",
            });

            var createModal = function () {
            return{
                init: function () {
                    console.log($('select[name="module_create"]').val());
                    console.log($('input:text[name="Lugar"]').val());
                    console.log($('input:text[name="date_time"]').val());
                    var route = "{{ route('calidadpcs.procesosCalidad.storeProceso7') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('Interesado', $('select[name="Interesado"]').val());
                    formData.append('Lugar', $('input:text[name="Lugar"]').val());
                    formData.append('date_time', $('input:text[name="date_time"]').val());
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
            Interesado: {required: true },
            Lugar: { required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false},
            date_time: { required: true },
        };
        var formMessage = {
            funcion: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,formMessage,createModal());

        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idReunion"]').val(dataTable.PK_CPGC_Id_Comunicacion);
            $('select[name="Interesado_edit"]').val(dataTable.CPGC_Interesado);
            $('select[name="Interesado_edit"]').trigger('change');
            $("#Lugar_edit").val(dataTable.CPGC_Lugar);
            $("#date_time_edit").val(dataTable.CPGC_Fecha);

            $('#modal_edit').modal('toggle');
        });

        var EditModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateProceso7') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('idReunion',  $('input:hidden[name="idReunion"]').val());
                    formData.append('interesado', $('select[name="Interesado_edit"]').val());
                    formData.append('lugar', $('input:text[name="Lugar_edit"]').val());
                    formData.append('fecha', $('input:text[name="date_time_edit"]').val());

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
            Interesado_edit: {required: true },
            date_time_edit: {required: true },
            Lugar_edit: { required: true, minlength: 3, maxlength: 50, noSpecialCharacters:true, letters:false },
        };
        var message_edit_modal = {
            Lugar_edit: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form_edit_modal,rules_edit_modal,message_edit_modal,EditModal());

        table.on('click', '.eliminar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = "{{route('calidadpcs.procesosCalidad.deleteProceso7')}}"+"/"+ dataTable.PK_CPGC_Id_Comunicacion;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar esta reunion?",
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
                        swal("Cancelado", "No se eliminó ninguna reunion", "error");
                    }
                });
        });

        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso7_1') }}';
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

    });
</script> 